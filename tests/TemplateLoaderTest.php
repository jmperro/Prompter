<?php

declare(strict_types=1);

namespace Prompter\Tests;

use PHPUnit\Framework\TestCase;
use Prompter\TemplateLoader;
use RuntimeException;

final class TemplateLoaderTest extends TestCase
{
    public function testLoadAllFromTemplatesDirectory(): void
    {
        $loader = new TemplateLoader(__DIR__ . '/../templates');
        $templates = $loader->loadAll();

        $this->assertNotEmpty($templates);
        $this->assertArrayHasKey('api', $templates);
        $this->assertArrayHasKey('function', $templates);
        $this->assertArrayHasKey('refactor', $templates);
        $this->assertArrayHasKey('debug', $templates);
        $this->assertArrayHasKey('app', $templates);
        $this->assertArrayHasKey('system_design', $templates);
        $this->assertArrayHasKey('optimize', $templates);
        $this->assertArrayHasKey('architecture', $templates);
        $this->assertArrayHasKey('multi_agent', $templates);
        $this->assertArrayHasKey('ui_component', $templates);
        $this->assertCount(10, $templates);
    }

    public function testInvalidDirectoryThrowsException(): void
    {
        $this->expectException(RuntimeException::class);
        new TemplateLoader('/ruta/inexistente');
    }

    public function testLoadedTemplateHasCorrectStructure(): void
    {
        $loader = new TemplateLoader(__DIR__ . '/../templates');
        $templates = $loader->loadAll();

        $api = $templates['api'];
        $this->assertSame('api', $api->getKey());
        $this->assertNotEmpty($api->getDescription());
        $this->assertNotEmpty($api->getRequired());
        $this->assertNotEmpty($api->getBody());
        $this->assertContains('recurso', $api->getRequired());
    }
}
