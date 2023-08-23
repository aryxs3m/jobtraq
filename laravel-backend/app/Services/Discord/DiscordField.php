<?php

namespace App\Services\Discord;

class DiscordField
{
    private string $name;
    private string $value;
    private bool $inline = false;

    public static function make(): DiscordField
    {
        return new DiscordField();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): DiscordField
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): DiscordField
    {
        $this->value = $value;

        return $this;
    }

    public function isInline(): bool
    {
        return $this->inline;
    }

    public function setInline(bool $inline): DiscordField
    {
        $this->inline = $inline;

        return $this;
    }

    public function build(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'inline' => $this->inline,
        ];
    }
}
