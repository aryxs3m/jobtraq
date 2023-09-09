<?php

namespace App\Services\Discord;

class DiscordProvider
{
    private ?string $name = null;
    private ?string $url = null;

    public static function make(): DiscordProvider
    {
        return new DiscordProvider();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): DiscordProvider
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): DiscordProvider
    {
        $this->url = $url;

        return $this;
    }

    public function build(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
        ];
    }
}
