<?php

namespace App\Command;
use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class UpdateCitiesFromCsvCommand extends Command
{
    protected static $defaultName = 'app:update-cities-csv';

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
        $url = "https://www.suche-postleitzahl.org/download_files/public/zuordnung_plz_ort_landkreis.csv";

        if ($input->getOption('url')) {
            $url = $input->getOption('url');
        }

        $data = $this->parseCsvToArray($url);

        var_dump($data);

        $io->success('CSV from remote opened successfully');

        return 0;
    }

    private function parseCsvToArray($url) {
        $csv_arr = [];
        $i = 0;
        $file = fopen ( $url, "r");
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($data);
            if($i == 0) {
                $header = $data;
            } else {
                foreach($data as $key => $column) {
                    $row[$header[$key]] = $column;
                }
                $csv_arr[] = $row;
            }
            $i ++;
        }
        fclose($file);
        return $csv_arr;
    }

    private function addCountryToDatabase($name, $locale) {
        $entityManager = $this->getDoctrine()->getManager();
        $country = new Country();
        $country->setName($name);
        $country->setLocale($locale);
        $entityManager->persist($country);
        $entityManager->flush();
    }
}
