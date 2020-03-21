<?php declare(strict_types=1);

namespace App\Command;

use App\Entity\Country;
use App\Entity\City;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
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
        $url = 'https://www.suche-postleitzahl.org/download_files/public/zuordnung_plz_ort_landkreis.csv';

        if ($input->getOption('url')) {
            $url = $input->getOption('url');
        }

        foreach ($this->iterateItems($url) as $item) {
            $io->table(array_keys($item), [$item]);
        }
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
}
