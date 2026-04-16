<?php

declare(strict_types=1);

namespace Prompter\Formatter;

interface FormatterInterface
{
    /**
     * Formatea el prompt generado para su salida.
     */
    public function format(string $prompt): string;
}
