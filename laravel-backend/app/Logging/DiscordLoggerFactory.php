<?php

namespace App\Logging;

use Monolog\Logger;

class DiscordLoggerFactory
{
    public function __invoke(array $config): Logger
    {
        $handler = new DiscordWebhookHandler();
        $handler->setWebhookUrl($config['webhook_url']);

        return new Logger('discord', [$handler]);
    }
}
