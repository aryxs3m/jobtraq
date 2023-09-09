<?php

namespace App\Services\Discord;

class DiscordFooter
{
    private string $text;
    private ?string $icon_url = null;
    private ?string $proxy_icon_url = null;

    public static function make(): DiscordFooter
    {
        return new DiscordFooter();
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): DiscordFooter
    {
        $this->text = $text;

        return $this;
    }

    public function getIconUrl(): ?string
    {
        return $this->icon_url;
    }

    public function setIconUrl(?string $icon_url): DiscordFooter
    {
        $this->icon_url = $icon_url;

        return $this;
    }

    public function getProxyIconUrl(): ?string
    {
        return $this->proxy_icon_url;
    }

    public function setProxyIconUrl(?string $proxy_icon_url): DiscordFooter
    {
        $this->proxy_icon_url = $proxy_icon_url;

        return $this;
    }

    public function build(): array
    {
        return [
            'text' => $this->text,
            'icon_url' => $this->icon_url,
            'proxy_icon_url' => $this->proxy_icon_url,
        ];
    }
}
