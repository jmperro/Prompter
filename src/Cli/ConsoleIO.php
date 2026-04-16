<?php

declare(strict_types=1);

namespace Prompter\Cli;

/**
 * Encapsula la entrada/salida de consola.
 */
final class ConsoleIO
{
    /** @var resource */
    private $input;

    /** @var resource */
    private $output;

    /**
     * @param resource $input
     * @param resource $output
     */
    public function __construct($input = null, $output = null)
    {
        $this->input = $input ?? STDIN;
        $this->output = $output ?? STDOUT;
    }

    /**
     * Muestra un mensaje en consola.
     */
    public function write(string $message): void
    {
        fwrite($this->output, $message);
    }

    /**
     * Muestra un mensaje con salto de linea.
     */
    public function writeln(string $message = ''): void
    {
        $this->write($message . "\n");
    }

    /**
     * Hace una pregunta y retorna la respuesta del usuario.
     */
    public function ask(string $question): string
    {
        $this->write($question . ': ');
        $line = fgets($this->input);

        return $line !== false ? trim($line) : '';
    }

    /**
     * Muestra un mensaje de error.
     */
    public function error(string $message): void
    {
        $this->writeln("Error: $message");
    }

    /**
     * Muestra un titulo con separadores.
     */
    public function title(string $title): void
    {
        $line = str_repeat('=', strlen($title) + 6);
        $this->writeln();
        $this->writeln($line);
        $this->writeln("   $title");
        $this->writeln($line);
        $this->writeln();
    }

    /**
     * Muestra una seccion con encabezado.
     */
    public function section(string $title): void
    {
        $this->writeln("\n=== " . strtoupper($title) . " ===\n");
    }
}
