<?php

declare(strict_types=1);

namespace Prompter;

use InvalidArgumentException;

/**
 * Value object que representa un template de prompt.
 */
final class Template
{
    /** @var string[] */
    private array $required;

    /**
     * @param string[] $required
     */
    public function __construct(
        private string $key,
        private string $description,
        array $required,
        private string $body
    ) {
        if (empty($this->key)) {
            throw new InvalidArgumentException('La clave del template no puede estar vacia');
        }

        if (empty($this->body)) {
            throw new InvalidArgumentException("El template '{$this->key}' tiene un body vacio");
        }

        $this->required = array_values($required);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string[]
     */
    public function getRequired(): array
    {
        return $this->required;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
