<?php

declare(strict_types=1);

return [
    'description' => 'Reestructuracion arquitectonica',
    'required' => ['codigo', 'objetivo'],
    'template' => <<<'PROMPT'
Actua como un ingeniero de nivel staff.

Codigo:
{{codigo}}

Objetivo:
{{objetivo}}

Refactoriza:
- Separacion de preocupaciones
- Aumentar modularidad
- Reducir acoplamiento

Restriccion:
- Mantener el comportamiento sin cambios

Entrega:
- Nueva estructura de carpetas
- Explicacion de la arquitectura
- Codigo refactorizado
PROMPT
];
