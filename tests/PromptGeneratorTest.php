<?php

declare(strict_types=1);

namespace Prompter\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Prompter\PromptGenerator;
use Prompter\Template;

final class PromptGeneratorTest extends TestCase
{
    private PromptGenerator $generator;

    protected function setUp(): void
    {
        $this->generator = new PromptGenerator();
        $this->generator->register(new Template(
            'greeting',
            'Template de saludo',
            ['nombre', 'idioma'],
            'Hola {{nombre}}, responde en {{idioma}}.'
        ));
    }

    public function testGenerateWithValidParams(): void
    {
        $result = $this->generator->generate('greeting', [
            'nombre' => 'Juan',
            'idioma' => 'espanol',
        ]);

        $this->assertSame('Hola Juan, responde en espanol.', $result);
    }

    public function testGenerateWithMissingParamThrows(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Faltan parametros requeridos: idioma');

        $this->generator->generate('greeting', ['nombre' => 'Juan']);
    }

    public function testGenerateWithInvalidTemplateThrows(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Template 'inexistente' no existe");

        $this->generator->generate('inexistente', []);
    }

    public function testGenerateWithExtraParamsIgnoresThem(): void
    {
        $result = $this->generator->generate('greeting', [
            'nombre' => 'Ana',
            'idioma' => 'ingles',
            'extra' => 'ignorado',
        ]);

        $this->assertSame('Hola Ana, responde en ingles.', $result);
    }

    public function testListTemplates(): void
    {
        $this->assertSame(['greeting'], $this->generator->listTemplates());
    }

    public function testRegisterAll(): void
    {
        $generator = new PromptGenerator();
        $generator->registerAll([
            new Template('a', 'Desc A', [], 'Body A'),
            new Template('b', 'Desc B', [], 'Body B'),
        ]);

        $this->assertSame(['a', 'b'], $generator->listTemplates());
    }

    public function testGetTemplate(): void
    {
        $template = $this->generator->getTemplate('greeting');
        $this->assertNotNull($template);
        $this->assertSame('greeting', $template->getKey());
    }

    public function testGetTemplateReturnsNullForMissing(): void
    {
        $this->assertNull($this->generator->getTemplate('nope'));
    }
}
