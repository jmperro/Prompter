<?php

declare(strict_types=1);

return [
    'description' => 'Diseno de sistemas escalables + implementacion',
    'required' => ['producto', 'escala', 'stack'],
    'template' => <<<'PROMPT'
Actua como un arquitecto de sistemas experimentado.

Producto:
{{producto}}

Escala esperada:
{{escala}}

Stack:
{{stack}}

Disena un sistema escalable y luego implementa la version minima de produccion.

Entrega:
- Arquitectura
- Estructura de componentes
- Flujo de datos
- Diseno de API
- Esquema de base de datos
- Estrategia de cache
- Codigo de implementacion
PROMPT
];
