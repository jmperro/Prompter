<?php

class PromptGenerator
{
    private array $templates;

    public function __construct(array $templates)
    {
        $this->templates = $templates;
    }

    public function generate(string $type, array $params): string
    {
        if (!isset($this->templates[$type])) {
            throw new Exception("Template '$type' no existe");
        }

        $templateData = $this->templates[$type];

        // Validar parámetros requeridos
        foreach ($templateData['required'] as $field) {
            if (!isset($params[$field])) {
                throw new Exception("Falta parámetro requerido: $field");
            }
        }

        $output = $templateData['template'];

        // Reemplazo de variables
        foreach ($params as $key => $value) {
            $output = str_replace('{{' . $key . '}}', $value, $output);
        }

        // Limpiar variables no reemplazadas
        $output = preg_replace('/{{\s*[\w]+\s*}}/', '', $output);

        return trim($output);
    }

    public function listTemplates(): array
    {
        return array_keys($this->templates);
    }
}