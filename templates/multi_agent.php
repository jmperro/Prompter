<?php

declare(strict_types=1);

return [
    'description' => 'Simulacion de equipo multi-agente',
    'required' => ['problema', 'contexto', 'stack'],
    'template' => <<<'PROMPT'
Simula 4 roles:
- Arquitecto
- Ingeniero
- Revisor
- Optimizador

Problema:
{{problema}}

Contexto:
{{contexto}}

Stack:
{{stack}}

Entrega:
1. Arquitectura (Arquitecto)
2. Implementacion (Ingeniero)
3. Revision (Revisor)
4. Version final optimizada (Optimizador)
PROMPT
];
