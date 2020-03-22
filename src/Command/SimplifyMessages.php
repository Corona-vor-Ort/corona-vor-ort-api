<?php declare(strict_types=1);

namespace App\Command;

use App\TextSimplifier;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SimplifyMessages extends Command
{
    protected static $defaultName = 'app:simplify-messages';

    /**
     * @var TextSimplifier
     */
    private $textSimplifier;

    public function __construct(TextSimplifier $textSimplifier)
    {
        parent::__construct(null);
        $this->textSimplifier = $textSimplifier;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $content = <<<TEXT
Das Bundesministerium für Gesundheit informiert:
Das neuartige Coronavirus, das die Krankheit Covid-19 auslöst, hat das öffentliche Leben in Deutschland stark eingeschränkt. Die aktuellen Maßnahmen bedeuten eine eingeschränkte Bewegungsfreiheit jedes Einzelnen und eine starke wirtschaftliche Belastung. Diese Maßnahmen sind jedoch wichtig und erforderlich. Durch sie wird ein starkes Ansteigen der Infektionen verhindert. Ein zu starkes Ansteigen würde Krankenhäuser und Arztpraxen überlasten. Eine bestmögliche Versorgung der Infizierten wäre dann nicht mehr möglich. Das könnte zu vermehrten Todesfällen führen.
Das Coronavirus wird vorrangig durch Tröpfcheninfektion übertragen. Nach aktuellem Wissenstand dauert es zwischen einem und 14 Tagen, bis Krankheitszeichen auftreten. Anzeichen für die Erkrankung können Fieber und Husten sein, seltener auch Schnupfen, Kurzatmigkeit, Muskel- und Gelenkschmerzen sowie Halsschmerzen und Kopfschmerzen. In den meisten Fällen ist der Verlauf leicht bis milde. Doch es gibt schwere Verläufe. In solchen Fällen kann es notwendig sein, die Patienten zu beatmen. Manchmal führt die Erkrankung auch zum Tod.
TEXT;

        $output->writeln($this->textSimplifier->summarize($content));

        return 0;
    }
}
