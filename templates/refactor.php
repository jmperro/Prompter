<?php

declare(strict_types=1);

return [
    'description' => 'Analisis de codigo y refactorizacion',
    'required' => ['codigo', 'contexto', 'objetivo'],
    'template' => <<<'PROMPT'
Actua como un ingeniero senior analizando un repositorio.

Codigo:
{{codigo}}

Contexto:
{{contexto}}

Objetivo:
{{objetivo}}

Analiza:
- Arquitectura
- Flujo de datos

Identifica:
- Problemas estructurales
- Codigo duplicado
- Cuellos de botella de rendimiento
- Riesgos de mantenibilidad

Entrega:
- Resumen de la arquitectura
- Areas problematicas
- Estrategias de refactorizacion
- Arquitectura y codigo mejorados
PROMPT
];
