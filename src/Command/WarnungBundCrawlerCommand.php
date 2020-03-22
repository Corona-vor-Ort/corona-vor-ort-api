<?php declare(strict_types=1);

namespace App\Command;

use App\Defaults\DatabaseIds;
use App\Entity\Locale;
use App\Entity\Meldung;
use App\Entity\MeldungKeyword;
use App\Entity\MeldungKeywordTranslation;
use App\Entity\MeldungLink;
use App\Entity\Meldungsreferenz;
use App\Repository\CountyRepository;
use App\Repository\MeldungKeywordRepository;
use App\Repository\MeldungLinkRepository;
use App\Repository\MeldungRepository;
use App\TextSimplifier;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

class WarnungBundCrawlerCommand extends Command
{
    protected static $defaultName = 'warnung-bund-crawler';

    /**
     * @var CountyRepository
     */
    protected $countyRepo;

    /**
     * @var MeldungRepository
     */
    protected $meldungRepo;

    /**
     * @var MeldungLinkRepository
     */
    protected $meldungLinkRepo;

    /**
     * @var MeldungKeywordRepository
     */
    private $meldungKeywordRepo;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @var TextSimplifier
     */
    private $textSimplifier;

    /**
     * @var resource
     */
    protected $curl;

    public function __construct(
        CountyRepository $countyRepo,
        MeldungRepository $meldungRepo,
        MeldungLinkRepository $meldungLinkRepo,
        MeldungKeywordRepository $meldungKeywordRepo,
        EntityManagerInterface $entityManager,
        TextSimplifier $textSimplifier
    ) {
        parent::__construct();
        $this->countyRepo = $countyRepo;
        $this->meldungRepo = $meldungRepo;
        $this->meldungLinkRepo = $meldungLinkRepo;
        $this->entityManager = $entityManager;
        $this->meldungKeywordRepo = $meldungKeywordRepo;
        $this->textSimplifier = $textSimplifier;
        $this->httpClient = HttpClient::create();
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_VERBOSE, 0);
        curl_setopt($this->curl, CURLOPT_HEADER, true);
        curl_setopt($this->curl, CURLOPT_NOBODY, true);
    }

    protected function configure()
    {
        $this->setDescription('Add a short description for your command');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->parseBbkJson();

        $io->success('successfully updated database.');
        return 0;
    }

    protected function parseBbkJson()
    {
        foreach ($this->getBbkData() as $entry) {
            if ($this->meldungRepo->findByBbkIdentifier($entry['identifier']) == null && $this->relatedToCovid19($entry)) {
                $meldung = $this->addMeldungForBbkEntry($entry);
                $this->addMeldungReferencesForBbkEntry($entry);
                $this->findLinksInText($meldung, $meldung->getDescription());
                $this->findLinksInText($meldung, $meldung->getMoreInformationLink());
                $this->findKeywordsInText($meldung, $meldung->getDescription());
                $this->findKeywordsInText($meldung, $meldung->getAreaDescription());
                $this->findKeywordsInText($meldung, $meldung->getHeadline());
            }
        }
    }

    protected function getBbkData()
    {
        return $content = $this->httpClient->request('GET', 'https://warnung.bund.de/bbk.mowas/gefahrendurchsagen.json')->toArray();
    }

    protected function relatedToCovid19($entry)
    {
        $keywords = json_decode(file_get_contents("res" . DIRECTORY_SEPARATOR . "coronaKeywords.json"));
        $regex = "/.*(" . implode("|", $keywords) . ").*/";
        return (
            preg_match($regex, strtolower($entry['info'][0]['headline']))
            || preg_match($regex, strtolower($entry['info'][0]['description']))
            || (array_key_exists('instruction', $entry['info'][0]) ? preg_match($regex, strtolower($entry['info'][0]['instruction'])) : false)
        );
    }

    protected function addMeldungForBbkEntry($entry)
    {
        $meldung = new Meldung();
        $meldung->setBbkIdentifier($entry['identifier']);
        $meldung->setSent(DateTime::createFromFormat(DateTimeInterface::ATOM, $entry['sent']));
        $meldung->setMessageType($entry['msgType']);
        $meldung->setHeadline($entry['info'][0]['headline']);
        $meldung->setDescription($entry['info'][0]['description']);
        if (array_key_exists('instruction', $entry['info'][0])) {
            $meldung->setInstruction($entry['info'][0]['instruction']);
        }
        if (array_key_exists('web', $entry['info'][0])) {
            $meldung->setMoreInformationLink($entry['info'][0]['web']);
        }
        if (array_key_exists('contact', $entry['info'][0])) {
            $meldung->setContact($entry['info'][0]['contact']);
        }
        $meldung->setAreaDescription($entry['info'][0]['area'][0]['areaDesc']);
        $meldung->setSeverity(array('Minor' => 0, 'Severe' => 1, 'Extreme' => 2)[$entry['info'][0]['severity']]);
        $meldung->setLanguage($entry['info'][0]['language']);

        foreach($entry['info'][0]['parameter'] as $parameter) {
            if ($parameter['valueName'] == "sender_langname") {
                $meldung->setMeldendeStelle($parameter['value']);
                break;
            }
        }

        foreach ($entry['info'][0]['area'][0]['geocode'] as $county_arn) {
            $county = $this->countyRepo->findByArn(substr($county_arn['value'], 0, 5));
            if ($county !== null) {
                $meldung->addLinkCounty($county);
            }
        }

        $this->entityManager->persist($meldung);
        $this->entityManager->flush();

        return $meldung;
    }

    protected function addMeldungReferencesForBbkEntry($entry)
    {
        if (array_key_exists('references', $entry)) {
            $origin = $this->meldungRepo->findByBbkIdentifier($entry['identifier']);

            foreach(explode(",", str_replace(" ", ",", $entry['references'])) as $ref) {
                $target = $this->meldungRepo->findByBbkIdentifier($ref);
                if ($target !== null) {
                    $meldungsreferenz = new Meldungsreferenz();
                    $meldungsreferenz->setOrigin($origin);
                    $meldungsreferenz->setTarget($target);
                    $this->entityManager->persist($meldungsreferenz);
                    $this->entityManager->flush();
                }
            }
        }
    }

    /**
     * @param Meldung $meldung
     * @param string $text
     */
    protected function findLinksInText($meldung, $text)
    {
        if (empty($text)) {
            return;
        }
        $linkCheck = '/((https?:\/\/)?(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0}[a-z0-9])(:?\d*)\/?([a-z_\/0-9\-#\+\,.]*)\??([\w\=\&\.]*)/i';
        $linkMatches = [];
        $result = preg_match_all($linkCheck, $text, $linkMatches);
        if ($result > 0) {
            foreach ($linkMatches[0] as $link) {
                if (!empty($link)) {
                    curl_setopt($this->curl, CURLOPT_URL, $link);
                    curl_exec($this->curl);
                    $error = curl_errno($this->curl);
                    $status = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

                    if ($error !== 0 || $status === 0 || $status === 404) {
                        continue;
                    }

                    if (!is_object($this->meldungLinkRepo->findByLinkForMeldung($link, $meldung))) {
                        $meldungLink = new MeldungLink();
                        $meldungLink->setMeldung($meldung);
                        $meldungLink->setLink($link);
                        $this->entityManager->persist($meldungLink);
                        $this->entityManager->flush();
                    }
                }
            }
        }
    }

    protected function findKeywordsInText(Meldung $meldung, string $text): void
    {
        // TODO don't expect German data

        if (empty($text)) {
            return;
        }

        foreach ($this->textSimplifier->keywords($text) as $keyword => $weight) {
            if ($weight < 0.1) {
                continue;
            }

            $meldungKeyword = $this->meldungKeywordRepo->findByName((string) $keyword, DatabaseIds::LOCALE_DE_DE);

            if ($meldungKeyword === null) {
                $translation = new MeldungKeywordTranslation();
                $translation->setName((string) $keyword);
                $translation->setLocale($this->entityManager->find(Locale::class, DatabaseIds::LOCALE_DE_DE));
                $translation->setCreatedAt(date_create());

                $meldungKeyword = new MeldungKeyword();
                $meldungKeyword->addTranslation($translation);
                $meldungKeyword->setCreatedAt(date_create());

                $this->entityManager->persist($meldungKeyword);
                $this->entityManager->persist($translation);
            }

            $meldung->addKeyword($meldungKeyword);
            $this->entityManager->persist($meldungKeyword);
        }

        $this->entityManager->flush();
    }
}
