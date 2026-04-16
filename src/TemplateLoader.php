<?php

declare(strict_types=1);

namespace Prompter;

use RuntimeException;

/**
 * Carga templates desde archivos individuales en un directorio.
 */
final class TemplateLoader
{
    private string $directory;

    public function __construct(string $directory)
    {
        if (!is_dir($directory)) {
            throw new RuntimeException("El directorio de templates no existe: $directory");
        }

        $this->directory = rtrim($directory, '/\\');
    }

    /**
     * Carga todos los templates del directorio.
     *
     * @return Template[]
     */
    public function loadAll(): array
    {
        $templates = [];
        $files = glob($this->directory . '/*.php');

        if ($files === false) {
            return $templates;
        }

        foreach ($files as $file) {
            $template = $this->loadFile($file);
            if ($template !== null) {
                $templates[$template->getKey()] = $template;
            }
        }

        return $templates;
    }

    private function loadFile(string $file): ?Template
    {
        $data = require $file;

        if (!is_array($data)) {
            return null;
        }

        $key = basename($file, '.php');

        return new Template(
            $key,
            $data['description'] ?? '',
            $data['required'] ?? [],
            $data['template'] ?? ''
        );
    }
}
