<?php

declare(strict_types=1);

return [
    'description' => 'Diseno de APIs listas para produccion',
    'required' => ['recurso', 'acciones', 'stack'],
    'template' => <<<'PROMPT'
Actua como un ingeniero backend experimentado.

Recurso:
{{recurso}}

Acciones:
{{acciones}}

Stack:
{{stack}}

Disena y desarrolla una API limpia y lista para produccion.

Incluye:
- Validacion
- Manejo de errores
- Arquitectura clara

Entrega:
- Diseno de rutas
- Validacion
- Logica del controlador
- Implementacion completa
PROMPT
];
