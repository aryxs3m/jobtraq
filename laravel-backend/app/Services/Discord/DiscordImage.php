<?php

namespace App\Services\Discord;

class DiscordImage
{
    private string $url;
    private ?string $proxy_url = null;
    private ?int $width = null;
    private ?int $height = null;

    public static function make(): DiscordImage
    {
        return new DiscordImage();
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): DiscordImage
    {
        $this->url = $url;

        return $this;
    }

    public function getProxyUrl(): ?string
    {
        return $this->proxy_url;
    }

    public function setProxyUrl(?string $proxy_url): DiscordImage
    {
        $this->proxy_url = $proxy_url;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): DiscordImage
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): DiscordImage
    {
        $this->height = $height;

        return $this;
    }

    public function build(): array
    {
        return [
            'url' => $this->url,
            'proxy_url' => $this->proxy_url,
            'width' => $this->width,
            'height' => $this->height,
        ];
    }
}
