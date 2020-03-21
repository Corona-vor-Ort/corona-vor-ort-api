<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CountyRepository;
use App\Repository\MeldungRepository;
use App\Entity\Meldung;
use App\Entity\Meldungsreferenz;
use DateTime;
use DateTimeInterface;

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
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(CountyRepository $countyRepo, MeldungRepository $meldungRepo, EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->countyRepo = $countyRepo;
        $this->meldungRepo = $meldungRepo;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setDescription('Add a short description for your command');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $client = HttpClient::create();
        $content = $client->request('GET', 'https://warnung.bund.de/bbk.mowas/gefahrendurchsagen.json')->toArray();
        
        foreach ($content as $entry) {
            if ($this->meldungRepo->findByBbkIdentifier($entry['identifier']) !== null) {
                continue;
            }

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
                $meldung->addLinkCounty($county);
            }
            
            $this->entityManager->persist($meldung);
            $this->entityManager->flush();
            
            if (array_key_exists('references', $entryWWWW)) {
                $origin = $this->meldungRepo->findByBbkIdentifier($entry['identifier']);
                
                foreach(explode(",", str_replace(" ", ",", $entry['references'])) as $ref) {
                    $meldungsreferenz = new Meldungsreferenz();
                    $meldungsreferenz->setOrigin($origin);
                    $meldungsreferenz->setTarget($this->meldungRepo->findByBbkIdentifier($ref));
                    $this->entityManager->persist($meldungsreferenz);
                    $this->entityManager->flush();
                }
            }
        }

        $io->success('successfully updated database.');
        return 0;
    }
}
