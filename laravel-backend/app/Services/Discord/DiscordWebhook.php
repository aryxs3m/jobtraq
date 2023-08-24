<?php

namespace App\Services\Discord;

use Illuminate\Support\Facades\Http;

class DiscordWebhook
{
    private string $content = '';
    private ?string $username = null;
    private ?string $avatar_url = null;
    private bool $tts = false;
    private array $embeds = [];
    private ?string $thread_name = null;

    public static function make(): DiscordWebhook
    {
        return new DiscordWebhook();
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): DiscordWebhook
    {
        $this->content = $content;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): DiscordWebhook
    {
        $this->username = $username;

        return $this;
    }

    public function getAvatarUrl(): string
    {
        return $this->avatar_url;
    }

    public function setAvatarUrl(string $avatar_url): DiscordWebhook
    {
        $this->avatar_url = $avatar_url;

        return $this;
    }

    public function isTts(): bool
    {
        return $this->tts;
    }

    public function setTts(bool $tts): DiscordWebhook
    {
        $this->tts = $tts;

        return $this;
    }

    public function getEmbeds(): array
    {
        return $this->embeds;
    }

    public function setEmbeds(array $embeds): DiscordWebhook
    {
        $this->embeds = $embeds;

        return $this;
    }

    /**
     * @return $this
     */
    public function addEmbed(array $embed): DiscordWebhook
    {
        $this->embeds[] = $embed;

        return $this;
    }

    public function getThreadName(): string
    {
        return $this->thread_name;
    }

    public function setThreadName(string $thread_name): DiscordWebhook
    {
        $this->thread_name = $thread_name;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function build(): array
    {
        if (count($this->embeds) > 10) {
            throw new \Exception('Up to 10 embed objects allowed.');
        }

        return [
            'content' => $this->content,
            'username' => $this->username,
            'avatar_url' => $this->avatar_url,
            'tts' => $this->tts,
            'embeds' => $this->embeds,
            'thread_name' => $this->thread_name,
        ];
    }

    /**
     * @throws \Exception
     */
    public function send(string $url): void
    {
        Http::post($url, $this->build());
    }
}
