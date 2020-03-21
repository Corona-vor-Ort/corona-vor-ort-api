<?php declare(strict_types=1);

namespace App;

use PhpScience\TextRank\TextRankFacade;
use PhpScience\TextRank\Tool\StopWords\German;

class TextSimplifier
{
    public function summarize(string $input): string
    {
        $api = new TextRankFacade();
        $stopWords = new German();
        $api->setStopWords($stopWords);

        // TODO decide what to do
        $result = $api->getOnlyKeyWords($input);

        $result = $api->getHighlights($input);

        return implode(PHP_EOL, $api->summarizeTextBasic($input));
    }
}
