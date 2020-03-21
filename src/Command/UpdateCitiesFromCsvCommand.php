<?php declare(strict_types=1);

namespace App\Command;

use App\Defaults\DatabaseIds;
use App\Entity\City;
use App\Entity\CityTranslation;
use App\Entity\Country;
use App\Entity\County;
use App\Entity\CountyTranslation;
use App\Entity\Locale;
use App\Entity\State;
use App\Entity\StateTranslation;
use App\Repository\CountryRepository;
use App\Repository\LocaleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class UpdateCitiesFromCsvCommand extends Command
{
    protected static $defaultName = 'app:update-cities-csv';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CountryRepository
     */
    private $countries;

    /**
     * @var LocaleRepository
     */
    private $locales;

    public function __construct(
        EntityManagerInterface $entityManager,
        CountryRepository $countries,
        LocaleRepository $locales
    ) {
        parent::__construct(null);
        $this->entityManager = $entityManager;
        $this->countries = $countries;
        $this->locales = $locales;
    }

    protected function configure()
    {
        $this
            ->setDescription('Fetches Data from https://www.suche-postleitzahl.org/download_files/public/zuordnung_plz_ort_landkreis.csv and adds it to database.')
            ->addOption('url', null, InputOption::VALUE_NONE, 'URL to CSV-File to fetch data from')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $url = 'https://www.suche-postleitzahl.org/download_files/public/zuordnung_plz_ort_landkreis.csv';

        if ($input->getOption('url')) {
            $url = $input->getOption('url');
        }

        foreach ($this->iterateItems($url) as $item) {
            $state = $this->findStateByName($item['bundesland']) ?? $this->createState($item['bundesland']);
            $county = $this->findCountyByName($item['landkreis'], $state) ?? $this->createCounty($item['landkreis'], $state);
            $city = $this->findCityByAgs($item['ags'], $county) ?? $this->createCity($item['ort'], $item['ags'], $item['osm_id'], $county);

            $io->table(array_keys($item), [$item]);
        }

        return 0;
    }

    protected function findStateByName(string $name): ?State
    {
        $dql = <<<DQL
SELECT s
FROM App\Entity\State s
INNER JOIN s.translations st
WHERE st.locale_id = :localeId AND st.name = :name AND s.country_id = :countryId
DQL;
        $country = $this->getCountry();
        $locale = $this->getLocale();

        $query = $this->entityManager
            ->createQuery($dql)
            ->setMaxResults(1)
            ->setParameter('countryId', Uuid::fromString($country->getId())->getBytes())
            ->setParameter('localeId', Uuid::fromString($locale->getId())->getBytes())
            ->setParameter('name', $name);

        $result = $query->getResult();

        return current($result) ?: null;
    }

    protected function createState(string $name): State
    {
        $country = $this->getCountry();
        $locale = $this->getLocale();

        $state = new State();
        $state->setCountry($country);
        $state->setCreatedAt(date_create());

        $stateTranslation = new StateTranslation();
        $stateTranslation->setName($name);
        $stateTranslation->setLocale($locale);
        $stateTranslation->setState($state);
        $stateTranslation->setCreatedAt(date_create());

        $this->entityManager->persist($state);
        $this->entityManager->persist($stateTranslation);
        $this->entityManager->flush();
        $this->entityManager->clear();

        return $state;
    }

    protected function findCountyByName(string $name, State $state): ?County
    {
        $dql = <<<DQL
SELECT c
FROM App\Entity\County c
INNER JOIN c.translations ct
WHERE ct.locale_id = :localeId AND ct.name = :name AND c.country_id = :countryId AND c.state_id = :stateId
DQL;
        $country = $this->getCountry();
        $locale = $this->getLocale();

        $query = $this->entityManager
            ->createQuery($dql)
            ->setMaxResults(1)
            ->setParameter('countryId', Uuid::fromString($country->getId())->getBytes())
            ->setParameter('localeId', Uuid::fromString($locale->getId())->getBytes())
            ->setParameter('stateId', Uuid::fromString($state->getId())->getBytes())
            ->setParameter('name', $name);

        $result = $query->getResult();

        return current($result) ?: null;
    }

    protected function createCounty(string $name, State $state): County
    {
        $country = $this->getCountry();
        $locale = $this->getLocale();

        $county = new County();
        $county->setCountry($country);
        $county->setState($state);
        $county->setCreatedAt(date_create());

        $countyTranslation = new CountyTranslation();
        $countyTranslation->setName($name);
        $countyTranslation->setLocale($locale);
        $countyTranslation->setCounty($county);
        $countyTranslation->setCreatedAt(date_create());

        $this->entityManager->persist($county);
        $this->entityManager->persist($countyTranslation);
        $this->entityManager->flush();
        $this->entityManager->clear();

        return $county;
    }

    protected function findCityByAgs(string $ags, County $county): ?City
    {
        $dql = <<<DQL
SELECT c
FROM App\Entity\City c
WHERE c.ags = :ags AND c.county_id = :countyId
DQL;
        $locale = $this->getLocale();

        $query = $this->entityManager
            ->createQuery($dql)
            ->setMaxResults(1)
            ->setParameter('countyId', Uuid::fromString($county->getId())->getBytes())
            ->setParameter('ags', $ags);

        $result = $query->getResult();

        return current($result) ?: null;
    }

    protected function createCity(string $name, string $ags, string $osm, County $county): City
    {
        $locale = $this->getLocale();

        $city = new City();
        $city->setCounty($county);
        $city->setAgs($ags);
        $city->setOsm($osm);
        $city->setCreatedAt(date_create());

        $cityTranslation = new CityTranslation();
        $cityTranslation->setName($name);
        $cityTranslation->setLocale($locale);
        $cityTranslation->setCity($city);
        $cityTranslation->setCreatedAt(date_create());

        $this->entityManager->persist($city);
        $this->entityManager->persist($cityTranslation);
        $this->entityManager->flush();
        $this->entityManager->clear();

        return $city;
    }

    protected function iterateItems(string $url): \Generator
    {
        $file = fopen ( $url, 'r');
        $header = null;

        while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {
            if ($header === null) {
                $header = $data;
                continue;
            }

            yield array_combine($header, $data);
        }

        fclose($file);
    }

    protected function getCountry(): Country
    {
        return $this->countries->find(DatabaseIds::COUNTRY_DE);
    }

    protected function getLocale(): Locale
    {
        return $this->locales->find(DatabaseIds::LOCALE_DE_DE);
    }
}
