<?php

require 'PromptGenerator.php';

$templates = require 'templates.php';
$generator = new PromptGenerator($templates);

/**
 * Leer input desde consola
 */
function ask(string $question): string
{
    echo $question . ": ";
    return trim(fgets(STDIN));
}

/**
 * Mostrar templates disponibles
 */
function showTemplates(array $templates): void
{
    echo "\n=== TEMPLATES DISPONIBLES ===\n\n";

    $i = 1;
    foreach ($templates as $key => $tpl) {
        echo "[$i] $key - " . ($tpl['description'] ?? '') . "\n";
        $i++;
    }

    echo "\n";
}

/**
 * Seleccionar template
 */
function selectTemplate(array $templates): string
{
    $keys = array_keys($templates);

    while (true) {
        $input = ask("Selecciona un template (número o nombre)");

        // Por número
        if (is_numeric($input)) {
            $index = (int)$input - 1;
            if (isset($keys[$index])) {
                return $keys[$index];
            }
        }

        // Por nombre
        if (isset($templates[$input])) {
            return $input;
        }

        echo "❌ Opción inválida. Intenta nuevamente.\n";
    }
}

/**
 * Pedir parámetros dinámicamente
 */
function askParams(array $required): array
{
    $params = [];

    echo "\n=== INGRESO DE DATOS ===\n\n";

    foreach ($required as $field) {
        $value = ask("→ $field");
        $params[$field] = $value;
    }

    return $params;
}

/**
 * ============================
 * MODO INTERACTIVO
 * ============================
 */
if ($argc === 1) {

    echo "\n🧠 Generador de Prompts IA (modo interactivo)\n";

    showTemplates($templates);

    $type = selectTemplate($templates);

    $required = $templates[$type]['required'] ?? [];

    $params = askParams($required);

    try {
        $prompt = $generator->generate($type, $params);

        echo "\n==============================\n";
        echo "      PROMPT GENERADO\n";
        echo "==============================\n\n";
        echo $prompt . "\n\n";

    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "\n";
    }

    exit;
}

/**
 * ============================
 * MODO CLI DIRECTO
 * ============================
 * Ej: php cli.php api recurso=users acciones=CRUD stack="PHP"
 */
$type = $argv[1];

$params = [];

foreach (array_slice($argv, 2) as $arg) {
    if (strpos($arg, '=') !== false) {
        [$key, $value] = explode('=', $arg, 2);
        $params[$key] = $value;
    }
}

try {
    $prompt = $generator->generate($type, $params);

    echo "\n--- PROMPT GENERADO ---\n\n";
    echo $prompt . "\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}