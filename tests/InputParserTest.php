<?php

declare(strict_types=1);

namespace Prompter\Tests;

use PHPUnit\Framework\TestCase;
use Prompter\Cli\InputParser;

final class InputParserTest extends TestCase
{
    public function testInteractiveModeWithNoArgs(): void
    {
        $parser = new InputParser(['cli.php']);

        $this->assertTrue($parser->isInteractive());
        $this->assertNull($parser->getTemplateType());
        $this->assertSame([], $parser->getParams());
    }

    public function testDirectModeWithTemplateOnly(): void
    {
        $parser = new InputParser(['cli.php', 'api']);

        $this->assertFalse($parser->isInteractive());
        $this->assertSame('api', $parser->getTemplateType());
        $this->assertSame([], $parser->getParams());
    }

    public function testDirectModeWithParams(): void
    {
        $parser = new InputParser(['cli.php', 'api', 'recurso=users', 'acciones=CRUD', 'stack=PHP']);

        $this->assertFalse($parser->isInteractive());
        $this->assertSame('api', $parser->getTemplateType());
        $this->assertSame([
            'recurso' => 'users',
            'acciones' => 'CRUD',
            'stack' => 'PHP',
        ], $parser->getParams());
    }

    public function testParamsWithEqualsInValue(): void
    {
        $parser = new InputParser(['cli.php', 'debug', 'error=x=1 failed']);

        $this->assertSame(['error' => 'x=1 failed'], $parser->getParams());
    }

    public function testMalformedArgsAreIgnored(): void
    {
        $parser = new InputParser(['cli.php', 'api', 'noequals', 'valid=yes']);

        $this->assertSame(['valid' => 'yes'], $parser->getParams());
    }
}
