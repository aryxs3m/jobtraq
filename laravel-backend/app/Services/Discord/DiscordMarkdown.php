<?php

namespace App\Services\Discord;

class DiscordMarkdown
{
    private string $output = '';

    public static function build(): DiscordMarkdown
    {
        return new DiscordMarkdown();
    }

    public function bold(string $text): static
    {
        $this->output .= sprintf('**%s**', $text);

        return $this;
    }

    public function italic(string $text): static
    {
        $this->output .= sprintf('*%s*', $text);

        return $this;
    }

    public function underline(string $text): static
    {
        $this->output .= sprintf('__%s__', $text);

        return $this;
    }

    public function strikethrough(string $text): static
    {
        $this->output .= sprintf('~~%s~~', $text);

        return $this;
    }

    public function newline(): static
    {
        $this->output .= "\n";

        return $this;
    }

    public function text(string $text): static
    {
        $this->output .= $text;

        return $this;
    }

    public function toString(): string
    {
        return $this->output;
    }
}
