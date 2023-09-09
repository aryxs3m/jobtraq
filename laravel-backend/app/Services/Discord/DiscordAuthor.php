<?php

namespace App\Services\Discord;

class DiscordAuthor
{
    private string $name;
    private ?string $url = null;
    private ?string $icon_url = null;
    private ?string $proxy_icon_url = null;

    public static function make(): DiscordAuthor
    {
        return new DiscordAuthor();
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DiscordFooter
     */
    public function setName(string $name): DiscordAuthor
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): DiscordAuthor
    {
        $this->url = $url;

        return $this;
    }

    public function getIconUrl(): ?string
    {
        return $this->icon_url;
    }

    /**
     * @return DiscordFooter
     */
    public function setIconUrl(?string $icon_url): DiscordAuthor
    {
        $this->icon_url = $icon_url;

        return $this;
    }

    public function getProxyIconUrl(): ?string
    {
        return $this->proxy_icon_url;
    }

    /**
     * @return DiscordFooter
     */
    public function setProxyIconUrl(?string $proxy_icon_url): DiscordAuthor
    {
        $this->proxy_icon_url = $proxy_icon_url;

        return $this;
    }

    public function build(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'icon_url' => $this->icon_url,
            'proxy_icon_url' => $this->proxy_icon_url,
        ];
    }
}
