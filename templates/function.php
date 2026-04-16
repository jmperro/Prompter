<?php

declare(strict_types=1);

return [
    'description' => 'Desarrollo de funciones listas para produccion',
    'required' => ['contexto', 'requerimientos', 'lenguaje', 'restricciones'],
    'template' => <<<'PROMPT'
Actua como un ingeniero de software senior.

Contexto:
{{contexto}}

Requerimientos:
{{requerimientos}}

Lenguaje:
{{lenguaje}}

Restricciones:
{{restricciones}}

Antes de escribir codigo:
- Analiza requisitos
- Identifica casos limite
- Define arquitectura
- Formula un plan

Entrega:
- Resumen de la arquitectura
- Estructura de carpetas
- Flujo de datos
- Implementacion completa
- Manejo de casos limite
- Gestion de errores
- Evaluacion de rendimiento
PROMPT
];
