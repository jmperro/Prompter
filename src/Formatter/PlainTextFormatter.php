<?php

declare(strict_types=1);

namespace Prompter\Formatter;

final class PlainTextFormatter implements FormatterInterface
{
    public function format(string $prompt): string
    {
        return $prompt;
    }
}
