<?php

declare(strict_types=1);

namespace Prompter\Cli;

use Prompter\Formatter\FormatterInterface;
use Prompter\Formatter\PlainTextFormatter;
use Prompter\PromptGenerator;
use Prompter\Template;
use InvalidArgumentException;

/**
 * Orquestador principal de la aplicacion CLI.
 */
final class Application
{
    private PromptGenerator $generator;
    private ConsoleIO $io;
    private FormatterInterface $formatter;

    public function __construct(
        PromptGenerator $generator,
        ?ConsoleIO $io = null,
        ?FormatterInterface $formatter = null
    ) {
        $this->generator = $generator;
        $this->io = $io ?? new ConsoleIO();
        $this->formatter = $formatter ?? new PlainTextFormatter();
    }

    /**
     * Ejecuta la aplicacion con los argumentos dados.
     *
     * @param string[] $argv
     */
    public function run(array $argv): int
    {
        $input = new InputParser($argv);

        if ($input->isInteractive()) {
            return $this->runInteractive();
        }

        return $this->runDirect($input);
    }

    private function runInteractive(): int
    {
        $this->io->writeln("\nGenerador de Prompts IA (modo interactivo)");

        $this->showTemplates();

        $type = $this->selectTemplate();
        if ($type === null) {
            return 1;
        }

        $template = $this->generator->getTemplate($type);
        if ($template === null) {
            $this->io->error("Template '$type' no encontrado");
            return 1;
        }

        $params = $this->askParams($template->getRequired());

        return $this->generateAndDisplay($type, $params);
    }

    private function runDirect(InputParser $input): int
    {
        $type = $input->getTemplateType();
        if ($type === null) {
            $this->io->error('Debe especificar un tipo de template');
            return 1;
        }

        return $this->generateAndDisplay($type, $input->getParams());
    }

    private function generateAndDisplay(string $type, array $params): int
    {
        try {
            $prompt = $this->generator->generate($type, $params);
            $this->io->title('PROMPT GENERADO');
            $this->io->writeln($this->formatter->format($prompt));
            $this->io->writeln();
            return 0;
        } catch (InvalidArgumentException $e) {
            $this->io->error($e->getMessage());
            return 1;
        }
    }

    private function showTemplates(): void
    {
        $this->io->section('TEMPLATES DISPONIBLES');

        $i = 1;
        foreach ($this->generator->getTemplates() as $key => $template) {
            $this->io->writeln("[$i] $key - " . $template->getDescription());
            $i++;
        }

        $this->io->writeln();
    }

    private function selectTemplate(): ?string
    {
        $keys = $this->generator->listTemplates();

        for ($attempts = 0; $attempts < 10; $attempts++) {
            $input = $this->io->ask('Selecciona un template (numero o nombre)');

            if ($input === '') {
                continue;
            }

            // Por numero
            if (is_numeric($input)) {
                $index = (int) $input - 1;
                if (isset($keys[$index])) {
                    return $keys[$index];
                }
            }

            // Por nombre
            if ($this->generator->getTemplate($input) !== null) {
                return $input;
            }

            $this->io->writeln('Opcion invalida. Intenta nuevamente.');
        }

        $this->io->error('Demasiados intentos invalidos');
        return null;
    }

    /**
     * @param string[] $required
     * @return array<string, string>
     */
    private function askParams(array $required): array
    {
        $params = [];

        $this->io->section('INGRESO DE DATOS');

        foreach ($required as $field) {
            $value = '';
            while ($value === '') {
                $value = $this->io->ask("  $field");
                if ($value === '') {
                    $this->io->writeln("  El campo '$field' es requerido.");
                }
            }
            $params[$field] = $value;
        }

        return $params;
    }
}
