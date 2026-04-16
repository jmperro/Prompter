<?php

declare(strict_types=1);

return [
    'description' => 'Optimizacion de rendimiento',
    'required' => ['codigo', 'contexto', 'restricciones'],
    'template' => <<<'PROMPT'
Actua como un ingeniero de rendimiento.

Codigo:
{{codigo}}

Contexto:
{{contexto}}

Restricciones:
{{restricciones}}

Optimiza para:
- Velocidad
- Uso de memoria
- Escalabilidad

Identifica:
- Cuellos de botella
- Logica ineficiente
- Renderizado innecesario

Entrega:
- Descripcion de mejoras
- Codigo optimizado
PROMPT
];
