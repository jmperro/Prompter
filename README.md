# Prompter - Generador de Prompts para IA

Herramienta CLI en PHP para generar prompts estructurados y profesionales dirigidos a modelos de IA. Incluye 10 templates predefinidos orientados a tareas comunes de ingenieria de software.

---

## Tabla de Contenidos

- [Inicio Rapido](#inicio-rapido)
- [Arquitectura](#arquitectura)
- [Flujo de Datos](#flujo-de-datos)
- [Templates Disponibles](#templates-disponibles)
- [Uso](#uso)
- [Analisis Tecnico](#analisis-tecnico)
- [Estrategias de Refactorizacion](#estrategias-de-refactorizacion)
- [Arquitectura Mejorada Propuesta](#arquitectura-mejorada-propuesta)

---

## Inicio Rapido

```bash
# Requisitos: PHP 7.4+ y Composer

# Instalar dependencias
composer install

# Modo interactivo
php bin/prompter

# Modo directo
php bin/prompter api recurso=users acciones=CRUD stack="PHP"
```

---

## Arquitectura

### Estructura actual

```
Prompter/
├── bin/
│   └── prompter                       # Punto de entrada CLI
├── src/
│   ├── Cli/
│   │   ├── Application.php            # Orquestador CLI
│   │   ├── ConsoleIO.php              # Entrada/salida de consola
│   │   └── InputParser.php            # Parsing de argumentos
│   ├── Formatter/
│   │   ├── FormatterInterface.php     # Contrato de formateo
│   │   ├── MarkdownFormatter.php      # Salida en markdown
│   │   └── PlainTextFormatter.php     # Salida en texto plano
│   ├── PromptGenerator.php            # Motor de generacion
│   ├── Template.php                   # Value object de template
│   └── TemplateLoader.php             # Carga templates desde archivos
├── templates/                         # Un archivo por template (10)
├── tests/                             # Tests unitarios (PHPUnit)
├── composer.json                      # Autoloading PSR-4
└── phpunit.xml                        # Configuracion de tests
```

### Archivos legacy (version original)

```
├── cli.php                # Punto de entrada original (reemplazado por bin/prompter)
├── PromptGenerator.php    # Motor original (reemplazado por src/PromptGenerator.php)
└── templates.php          # Templates monolitico (reemplazado por templates/)
```

### Diagrama de componentes

```
┌─────────────────┐
│  bin/prompter   │  Punto de entrada
└────────┬────────┘
         │
┌────────▼────────┐
│  Cli\Application │  Orquesta el flujo
└────────┬────────┘
         │
    ┌────┼────────────────┐
    ▼    ▼                ▼
┌──────┐ ┌─────────┐ ┌───────────┐
│Input │ │ConsoleIO│ │ Formatter │
│Parser│ │         │ │(Interface)│
└──────┘ └─────────┘ └───────────┘
              │
     ┌────────▼────────┐
     │ PromptGenerator │  Validacion + sustitucion
     └────────┬────────┘
              │
    ┌─────────┼─────────┐
    ▼         ▼         ▼
┌────────┐ ┌────────┐ ┌──────────┐
│Template│ │Template│ │templates/│
│(Value  │ │ Loader │ │ *.php    │
│ Object)│ │        │ │          │
└────────┘ └────────┘ └──────────┘
```

### Responsabilidades

| Componente | Responsabilidad |
|---|---|
| `bin/prompter` | Punto de entrada, bootstrap de autoloading y dependencias |
| `Cli\Application` | Orquestacion del flujo interactivo y directo |
| `Cli\ConsoleIO` | Abstraccion de entrada/salida de consola (testeable) |
| `Cli\InputParser` | Parsing de argumentos CLI (`argv`) |
| `PromptGenerator` | Validacion de parametros, sustitucion de variables `{{var}}` |
| `Template` | Value object inmutable con validacion de estructura |
| `TemplateLoader` | Carga templates individuales desde directorio |
| `Formatter\*` | Formateo de salida (texto plano, markdown) |

---

## Flujo de Datos

### Modo Interactivo (`php bin/prompter`)

```
Usuario ejecuta bin/prompter sin argumentos
        │
        ▼
Application->showTemplates() → Muestra los 10 templates
        │
        ▼
Application->selectTemplate() → Usuario elige por numero o nombre
        │
        ▼
Application->askParams() → Solicita cada campo (valida no vacio)
        │
        ▼
PromptGenerator->generate($type, $params)
        │
        ├── 1. Valida que el template exista
        ├── 2. Valida parametros requeridos (array_diff)
        ├── 3. strtr() sustituye todas las {{variable}} de una vez
        └── 4. trim() y retorna string
        │
        ▼
Imprime prompt generado en consola
```

### Modo Directo (`php bin/prompter <template> key=value ...`)

```
InputParser parsea argv:
  argv[1] = tipo de template
  argv[2..n] = pares key=value
        │
        ▼
PromptGenerator->generate($type, $params)
        │
        ▼
Imprime prompt generado
```

---

## Templates Disponibles

| # | Clave | Descripcion | Campos requeridos |
|---|---|---|---|
| 1 | `function` | Funciones listas para produccion | `contexto`, `requerimientos`, `lenguaje`, `restricciones` |
| 2 | `app` | MVP escalable | `idea`, `stack`, `usuarios`, `restricciones` |
| 3 | `refactor` | Analisis y refactorizacion | `codigo`, `contexto`, `objetivo` |
| 4 | `debug` | Resolucion de errores en produccion | `codigo`, `error`, `entorno` |
| 5 | `system_design` | Diseno de sistemas escalables | `producto`, `escala`, `stack` |
| 6 | `optimize` | Optimizacion de rendimiento | `codigo`, `contexto`, `constraints` |
| 7 | `architecture` | Reestructuracion arquitectonica | `codigo`, `objetivo` |
| 8 | `multi_agent` | Simulacion de equipo multi-agente | `problema`, `contexto`, `stack` |
| 9 | `ui_component` | Componentes UI reutilizables | `componente`, `framework`, `requisitos` |
| 10 | `api` | APIs listas para produccion | `recurso`, `acciones`, `stack` |

---

## Uso

### Modo interactivo

```bash
php bin/prompter
```

Ejemplo de sesion:

```
Generador de Prompts IA (modo interactivo)

=== TEMPLATES DISPONIBLES ===

[1] function - Desarrollo de funciones listas para producción
[2] app - Desarrollo de aplicación completa tipo MVP
...
[10] api - Diseño de APIs listas para producción

Selecciona un template (número o nombre): 10

=== INGRESO DE DATOS ===

→ recurso: users
→ acciones: CRUD
→ stack: Laravel + MySQL

==============================
      PROMPT GENERADO
==============================

Actúa como un ingeniero backend experimentado.
...
```

### Modo directo

```bash
php bin/prompter function \
  contexto="Sistema de autenticacion" \
  requerimientos="Login seguro con JWT" \
  lenguaje="PHP 8.2" \
  restricciones="Sin dependencias externas"
```

---

## Analisis Tecnico

### Problemas resueltos en la refactorizacion

| Problema original | Solucion aplicada |
|---|---|
| Funciones globales en `cli.php` | Encapsuladas en `Cli\Application`, `Cli\ConsoleIO`, `Cli\InputParser` |
| Acoplamiento CLI + presentacion | Separacion en `InputParser` (entrada), `ConsoleIO` (I/O), `Application` (orquestacion) |
| Templates como array monolitico | Divididos en archivos individuales bajo `templates/`, cargados por `TemplateLoader` |
| Sin autoloading | Composer con PSR-4 (`Prompter\\` → `src/`) |
| Bloque try/catch duplicado | Unificado en `Application::generateAndDisplay()` |
| `str_replace()` en bucle | Reemplazado por `strtr()` (una sola pasada) |
| `preg_replace()` innecesario | Eliminado: la validacion previa garantiza que todos los parametros existen |
| Sin tests | 20 tests unitarios con PHPUnit (Template, PromptGenerator, InputParser, TemplateLoader) |
| Sin tipado estricto | `declare(strict_types=1)` en todos los archivos |
| Sin validacion de entrada | Campos vacios se rechazan en modo interactivo; args malformados se ignoran con limpieza |
| Paths relativos en require | Autoloading via Composer; `__DIR__` en el entry point |
| Mezcla espanol/ingles en campos | Normalizado a espanol (`constraints` → `restricciones`) |

### Oportunidades futuras

1. **Sistema de plugins** para agregar templates sin modificar el core.
2. **Templates con secciones condicionales** (`{{#if var}}...{{/if}}`).
3. **Exportar prompts** a archivo o clipboard.
4. **Interfaz web** opcional usando un micro-framework como Slim.
5. **Template inheritance** para reutilizar secciones comunes entre templates.

---

## Tests

```bash
# Ejecutar todos los tests
vendor/bin/phpunit

# Ejecutar un test especifico
vendor/bin/phpunit tests/PromptGeneratorTest.php
```

Cobertura actual: 20 tests, 47 assertions.

| Suite | Tests | Cubre |
|---|---|---|
| `TemplateTest` | 4 | Validacion del value object |
| `PromptGeneratorTest` | 8 | Generacion, validacion, registro |
| `InputParserTest` | 5 | Parsing de argumentos CLI |
| `TemplateLoaderTest` | 3 | Carga de templates desde archivos |

## Agregar un nuevo template

Crear un archivo `templates/<nombre>.php`:

```php
<?php

declare(strict_types=1);

return [
    'description' => 'Descripcion del template',
    'required' => ['campo1', 'campo2'],
    'template' => <<<'PROMPT'
Actua como ...

Campo 1:
{{campo1}}

Campo 2:
{{campo2}}

Entrega:
- ...
PROMPT
];
```

El `TemplateLoader` lo detecta automaticamente al ejecutar `bin/prompter`.

---

## Requisitos

- PHP >= 7.4
- Composer
- Acceso a terminal/consola

## Licencia

Este proyecto es de uso interno.
