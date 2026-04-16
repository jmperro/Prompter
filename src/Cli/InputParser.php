<?php

declare(strict_types=1);

namespace Prompter\Cli;

/**
 * Parsea los argumentos de linea de comandos.
 */
final class InputParser
{
    private ?string $templateType = null;

    /** @var array<string, string> */
    private array $params = [];

    private bool $isInteractive;

    /**
     * @param string[] $argv
     */
    public function __construct(array $argv)
    {
        $this->isInteractive = count($argv) <= 1;

        if (!$this->isInteractive) {
            $this->templateType = $argv[1];
            $this->parseParams(array_slice($argv, 2));
        }
    }

    public function isInteractive(): bool
    {
        return $this->isInteractive;
    }

    public function getTemplateType(): ?string
    {
        return $this->templateType;
    }

    /**
     * @return array<string, string>
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param string[] $args
     */
    private function parseParams(array $args): void
    {
        foreach ($args as $arg) {
            if (strpos($arg, '=') === false) {
                continue;
            }

            [$key, $value] = explode('=', $arg, 2);
            $key = trim($key);
            $value = trim($value);

            if ($key !== '') {
                $this->params[$key] = $value;
            }
        }
    }
}
