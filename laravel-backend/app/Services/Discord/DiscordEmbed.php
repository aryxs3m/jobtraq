<?php

namespace App\Services\Discord;

class DiscordEmbed
{
    private ?string $title = null;
    private ?string $type = null;
    private ?string $description = null;
    private ?string $url = null;
    private ?int $color = null;
    private array $fields = [];
    private ?array $footer = null;
    private ?array $author = null;
    private ?array $image = null;
    private ?array $thumbnail = null;
    private ?array $video = null;
    private ?array $provider = null;

    public static function make(): DiscordEmbed
    {
        return new DiscordEmbed();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): DiscordEmbed
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): DiscordEmbed
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): DiscordEmbed
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): DiscordEmbed
    {
        $this->url = $url;

        return $this;
    }

    public function getColor(): ?int
    {
        return $this->color;
    }

    public function setColor(string $hexColor): DiscordEmbed
    {
        $this->color = hexdec($hexColor);

        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function setFields(array $fields): DiscordEmbed
    {
        $this->fields = $fields;

        return $this;
    }

    public function addField(array $field): DiscordEmbed
    {
        $this->fields[] = $field;

        return $this;
    }

    public function getFooter(): ?array
    {
        return $this->footer;
    }

    public function setFooter(?array $footer): DiscordEmbed
    {
        $this->footer = $footer;

        return $this;
    }

    public function getAuthor(): ?array
    {
        return $this->author;
    }

    public function setAuthor(?array $author): DiscordEmbed
    {
        $this->author = $author;

        return $this;
    }

    public function getImage(): ?array
    {
        return $this->image;
    }

    public function setImage(?array $image): DiscordEmbed
    {
        $this->image = $image;

        return $this;
    }

    public function getThumbnail(): ?array
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?array $thumbnail): DiscordEmbed
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getVideo(): ?array
    {
        return $this->video;
    }

    public function setVideo(?array $video): DiscordEmbed
    {
        $this->video = $video;

        return $this;
    }

    public function getProvider(): ?array
    {
        return $this->provider;
    }

    public function setProvider(?array $provider): DiscordEmbed
    {
        $this->provider = $provider;

        return $this;
    }

    public function build(): array
    {
        return [
            'title' => $this->title,
            'type' => $this->type,
            'description' => $this->description,
            'url' => $this->url,
            'color' => $this->color,
            'fields' => $this->fields,
            'footer' => $this->footer,
            'author' => $this->author,
            'image' => $this->image,
            'thumbnail' => $this->thumbnail,
            'video' => $this->video,
            'provider' => $this->provider,
        ];
    }
}
