<?php

declare(strict_types=1);

namespace Prompter\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Prompter\Template;

final class TemplateTest extends TestCase
{
    public function testCreateValidTemplate(): void
    {
        $template = new Template('test', 'Descripcion', ['campo1', 'campo2'], 'Body {{campo1}} {{campo2}}');

        $this->assertSame('test', $template->getKey());
        $this->assertSame('Descripcion', $template->getDescription());
        $this->assertSame(['campo1', 'campo2'], $template->getRequired());
        $this->assertSame('Body {{campo1}} {{campo2}}', $template->getBody());
    }

    public function testEmptyKeyThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Template('', 'Desc', [], 'Body');
    }

    public function testEmptyBodyThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Template('key', 'Desc', [], '');
    }

    public function testEmptyDescriptionIsAllowed(): void
    {
        $template = new Template('key', '', [], 'Body');
        $this->assertSame('', $template->getDescription());
    }
}
