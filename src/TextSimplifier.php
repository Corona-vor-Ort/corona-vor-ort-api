<?php declare(strict_types=1);

namespace App;

use PhpScience\TextRank\TextRankFacade;
use PhpScience\TextRank\Tool\StopWords\German;

class TextSimplifier
{
    public function summarize(string $input): string
    {
        return implode(PHP_EOL, $this->getAlgo()->summarizeTextBasic($input));
    }

    public function highlights(string $input): string
    {
        return implode(PHP_EOL, $this->getAlgo()->getHighlights($input));
    }

    public function keywords(string $input): array
    {
        return $this->getAlgo()->getOnlyKeyWords($input);
    }

    protected function getAlgo(): TextRankFacade
    {
        $api = new TextRankFacade();
        $api->setStopWords(new German());

        return $api;
    }
}
