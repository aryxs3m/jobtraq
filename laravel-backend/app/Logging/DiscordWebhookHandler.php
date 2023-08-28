<?php

namespace App\Logging;

use App\Services\Discord\DiscordEmbed;
use App\Services\Discord\DiscordField;
use App\Services\Discord\DiscordWebhook;
use JetBrains\PhpStorm\NoReturn;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Level;
use Monolog\LogRecord;

class DiscordWebhookHandler extends AbstractProcessingHandler
{
    private string $webhook_url;

    /**
     * @return string
     */
    public function getWebhookUrl(): string
    {
        return $this->webhook_url;
    }

    /**
     * @param string $webhook_url
     * @return DiscordWebhookHandler
     */
    public function setWebhookUrl(string $webhook_url): DiscordWebhookHandler
    {
        $this->webhook_url = $webhook_url;

        return $this;
    }

    #[NoReturn] protected function write(LogRecord $record): void
    {
        $discordEmbed = DiscordEmbed::make()
            ->setTitle($record->level->name)
            ->setColor($this->getColorByLevel($record->level->value))
            ->setDescription($record->message);

        foreach ($record->context as $key => $value) {
            $discordEmbed->addField(
                DiscordField::make()
                ->setName($key)
                ->setValue($value)
                ->setInline(true)
                ->build()
            );
        }

        DiscordWebhook::make()
            ->setUsername(config('app.name'))
            ->setAvatarUrl('https://jobtraq.hu/assets/favicons/apple-icon-180x180.png')
            ->addEmbed($discordEmbed->build())
            ->send($this->webhook_url);
    }

    private function getColorByLevel(int $level): string
    {
        return match ($level) {
            Level::Debug->value => 'c4c4c4',
            Level::Notice->value => 'eaff00',
            Level::Warning->value => 'ffae00',
            Level::Error->value => '9634e0',
            Level::Alert->value => 'ff0a85',
            Level::Critical->value => 'c71a3c',
            Level::Emergency->value => 'ff0000',
            default => '32a852',
        };
    }
}
