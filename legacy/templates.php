<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 1. Función - Nivel Producción
    |--------------------------------------------------------------------------
    */
    'function' => [
        'description' => 'Desarrollo de funciones listas para producción',
        'required' => ['contexto', 'requerimientos', 'lenguaje', 'restricciones'],
        'template' => <<<'PROMPT'
Actúa como un ingeniero de software senior.

Contexto:
{{contexto}}

Requerimientos:
{{requerimientos}}

Lenguaje:
{{lenguaje}}

Restricciones:
{{restricciones}}

Antes de escribir código:
- Analiza requisitos
- Identifica casos límite
- Define arquitectura
- Formula un plan

Entrega:
- Resumen de la arquitectura
- Estructura de carpetas
- Flujo de datos
- Implementación completa
- Manejo de casos límite
- Gestión de errores
- Evaluación de rendimiento
PROMPT
    ],

    /*
    |--------------------------------------------------------------------------
    | 2. Aplicación completa (MVP escalable)
    |--------------------------------------------------------------------------
    */
    'app' => [
        'description' => 'Desarrollo de aplicación completa tipo MVP',
        'required' => ['idea', 'stack', 'usuarios', 'restricciones'],
        'template' => <<<'PROMPT'
Actúa como ingeniero full-stack senior.

Idea:
{{idea}}

Stack:
{{stack}}

Usuarios objetivo:
{{usuarios}}

Restricciones:
{{restricciones}}

Diseña primero la arquitectura y luego implementa un MVP escalable.

Entrega:
- Arquitectura
- Estructura de carpetas
- Esquema de base de datos
- Endpoints API
- Estructura de la UI
- Código completo
PROMPT
    ],

    /*
    |--------------------------------------------------------------------------
    | 3. Análisis + Refactorización
    |--------------------------------------------------------------------------
    */
    'refactor' => [
        'description' => 'Análisis de código y refactorización',
        'required' => ['codigo', 'contexto', 'objetivo'],
        'template' => <<<'PROMPT'
Actúa como un ingeniero senior analizando un repositorio.

Código:
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
- Código duplicado
- Cuellos de botella de rendimiento
- Riesgos de mantenibilidad

Entrega:
- Resumen de la arquitectura
- Áreas problemáticas
- Estrategias de refactorización
- Arquitectura y código mejorados
PROMPT
    ],

    /*
    |--------------------------------------------------------------------------
    | 4. Debugging - Producción
    |--------------------------------------------------------------------------
    */
    'debug' => [
        'description' => 'Análisis y resolución de errores en producción',
        'required' => ['codigo', 'error', 'entorno'],
        'template' => <<<'PROMPT'
Actúa como un ingeniero senior resolviendo errores en producción.

Código:
{{codigo}}

Error:
{{error}}

Entorno:
{{entorno}}

Proceso:
- Analiza el código cuidadosamente
- Piensa paso a paso
- Encuentra la causa raíz
- Proporciona soluciones robustas

Considera casos límite y rendimiento.

Entrega:
- Explicación de la causa del problema
- Esquema de reparación
- Código listo para producción
PROMPT
    ],

    /*
    |--------------------------------------------------------------------------
    | 5. System Design + Implementación
    |--------------------------------------------------------------------------
    */
    'system_design' => [
        'description' => 'Diseño de sistemas escalables + implementación',
        'required' => ['producto', 'escala', 'stack'],
        'template' => <<<'PROMPT'
Actúa como un arquitecto de sistemas experimentado.

Producto:
{{producto}}

Escala esperada:
{{escala}}

Stack:
{{stack}}

Diseña un sistema escalable y luego implementa la versión mínima de producción.

Entrega:
- Arquitectura
- Estructura de componentes
- Flujo de datos
- Diseño de API
- Esquema de base de datos
- Estrategia de caché
- Código de implementación
PROMPT
    ],

    /*
    |--------------------------------------------------------------------------
    | 6. Optimización de rendimiento
    |--------------------------------------------------------------------------
    */
    'optimize' => [
        'description' => 'Optimización de performance',
        'required' => ['codigo', 'contexto', 'constraints'],
        'template' => <<<'PROMPT'
Actúa como un ingeniero de rendimiento.

Código:
{{codigo}}

Contexto:
{{contexto}}

Restricciones:
{{constraints}}

Optimiza para:
- Velocidad
- Uso de memoria
- Escalabilidad

Identifica:
- Cuellos de botella
- Lógica ineficiente
- Renderizado innecesario

Entrega:
- Descripción de mejoras
- Código optimizado
PROMPT
    ],

    /*
    |--------------------------------------------------------------------------
    | 7. Refactor arquitectónico
    |--------------------------------------------------------------------------
    */
    'architecture' => [
        'description' => 'Reestructuración arquitectónica',
        'required' => ['codigo', 'objetivo'],
        'template' => <<<'PROMPT'
Actúa como un ingeniero de nivel staff.

Código:
{{codigo}}

Objetivo:
{{objetivo}}

Refactoriza:
- Separación de preocupaciones
- Aumentar modularidad
- Reducir acoplamiento

Restricción:
- Mantener el comportamiento sin cambios

Entrega:
- Nueva estructura de carpetas
- Explicación de la arquitectura
- Código refactorizado
PROMPT
    ],

    /*
    |--------------------------------------------------------------------------
    | 8. Multi-agente
    |--------------------------------------------------------------------------
    */
    'multi_agent' => [
        'description' => 'Simulación de equipo multi-agente',
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
2. Implementación (Ingeniero)
3. Revisión (Revisor)
4. Versión final optimizada (Optimizador)
PROMPT
    ],

    /*
    |--------------------------------------------------------------------------
    | 9. UI Component - Producción
    |--------------------------------------------------------------------------
    */
    'ui_component' => [
        'description' => 'Componentes UI reutilizables',
        'required' => ['componente', 'framework', 'requisitos'],
        'template' => <<<'PROMPT'
Actúa como un ingeniero frontend senior.

Componente:
{{componente}}

Framework:
{{framework}}

Requisitos:
{{requisitos}}

Considera:
- Estado de carga
- Casos límite
- Diseño responsivo
- Accesibilidad

Entrega:
- Arquitectura del componente
- Diseño de props
- Implementación completa
PROMPT
    ],

    /*
    |--------------------------------------------------------------------------
    | 10. API Backend - Producción
    |--------------------------------------------------------------------------
    */
    'api' => [
        'description' => 'Diseño de APIs listas para producción',
        'required' => ['recurso', 'acciones', 'stack'],
        'template' => <<<'PROMPT'
Actúa como un ingeniero backend experimentado.

Recurso:
{{recurso}}

Acciones:
{{acciones}}

Stack:
{{stack}}

Diseña y desarrolla una API limpia y lista para producción.

Incluye:
- Validación
- Manejo de errores
- Arquitectura clara

Entrega:
- Diseño de rutas
- Validación
- Lógica del controlador
- Implementación completa
PROMPT
    ],

];