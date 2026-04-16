<?php

declare(strict_types=1);

return [
    'description' => 'Analisis y resolucion de errores en produccion',
    'required' => ['codigo', 'error', 'entorno'],
    'template' => <<<'PROMPT'
Actua como un ingeniero senior resolviendo errores en produccion.

Codigo:
{{codigo}}

Error:
{{error}}

Entorno:
{{entorno}}

Proceso:
- Analiza el codigo cuidadosamente
- Piensa paso a paso
- Encuentra la causa raiz
- Proporciona soluciones robustas

Considera casos limite y rendimiento.

Entrega:
- Explicacion de la causa del problema
- Esquema de reparacion
- Codigo listo para produccion
PROMPT
];
