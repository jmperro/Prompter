<?php

declare(strict_types=1);

return [
    'description' => 'Componentes UI reutilizables',
    'required' => ['componente', 'framework', 'requisitos'],
    'template' => <<<'PROMPT'
Actua como un ingeniero frontend senior.

Componente:
{{componente}}

Framework:
{{framework}}

Requisitos:
{{requisitos}}

Considera:
- Estado de carga
- Casos limite
- Diseno responsivo
- Accesibilidad

Entrega:
- Arquitectura del componente
- Diseno de props
- Implementacion completa
PROMPT
];
