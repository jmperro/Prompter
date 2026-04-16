<?php

declare(strict_types=1);

return [
    'description' => 'Desarrollo de aplicacion completa tipo MVP',
    'required' => ['idea', 'stack', 'usuarios', 'restricciones'],
    'template' => <<<'PROMPT'
Actua como ingeniero full-stack senior.

Idea:
{{idea}}

Stack:
{{stack}}

Usuarios objetivo:
{{usuarios}}

Restricciones:
{{restricciones}}

Disena primero la arquitectura y luego implementa un MVP escalable.

Entrega:
- Arquitectura
- Estructura de carpetas
- Esquema de base de datos
- Endpoints API
- Estructura de la UI
- Codigo completo
PROMPT
];
