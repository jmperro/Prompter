<?php

declare(strict_types=1);

namespace Prompter;

use InvalidArgumentException;

/**
 * Motor de generacion de prompts.
 * Valida parametros y realiza sustitucion de variables {{var}}.
 */
final class PromptGenerator
{
    /** @var array<string, Template> */
    private array $templates = [];

    /**
     * Registra un template en el generador.
     */
    public function register(Template $template): void
    {
        $this->templates[$template->getKey()] = $template;
    }

    /**
     * Registra multiples templates a la vez.
     *
     * @param Template[] $templates
     */
    public function registerAll(array $templates): void
    {
        foreach ($templates as $template) {
            $this->register($template);
        }
    }

    /**
     * Genera un prompt a partir de un template y parametros.
     *
     * @param array<string, string> $params
     * @throws InvalidArgumentException
     */
    public function generate(string $type, array $params): string
    {
        if (!isset($this->templates[$type])) {
            throw new InvalidArgumentException("Template '$type' no existe");
        }

        $template = $this->templates[$type];

        // Validar parametros requeridos
        $missing = array_diff($template->getRequired(), array_keys($params));
        if ($missing !== []) {
            throw new InvalidArgumentException(
                'Faltan parametros requeridos: ' . implode(', ', $missing)
            );
        }

        // Sustitucion de variables con strtr (mas eficiente que str_replace en bucle)
        $replacements = [];
        foreach ($params as $key => $value) {
            $replacements['{{' . $key . '}}'] = $value;
        }

        return trim(strtr($template->getBody(), $replacements));
    }

    /**
     * Retorna las claves de todos los templates registrados.
     *
     * @return string[]
     */
    public function listTemplates(): array
    {
        return array_keys($this->templates);
    }

    /**
     * Retorna un template por su clave.
     */
    public function getTemplate(string $key): ?Template
    {
        return $this->templates[$key] ?? null;
    }

    /**
     * Retorna todos los templates registrados.
     *
     * @return array<string, Template>
     */
    public function getTemplates(): array
    {
        return $this->templates;
    }
}
