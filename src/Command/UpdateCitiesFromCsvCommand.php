<?php

namespace App\Command;

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

        $csv_arr = [];
        $row = 0;
        $file = fopen ( $url, "r");
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($data);
            if($row == 0) {
                $header = $data;
            } else {
                $csv_arr[] = $data;
            }
            $row ++;
        }
        fclose($file);

        $io->success('CSV from remote opened successfully');

        return 0;
    }
}
