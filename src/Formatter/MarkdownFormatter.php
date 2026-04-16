<?php

declare(strict_types=1);

namespace Prompter\Formatter;

final class MarkdownFormatter implements FormatterInterface
{
    public function format(string $prompt): string
    {
        return "```\n" . $prompt . "\n```";
    }
}
