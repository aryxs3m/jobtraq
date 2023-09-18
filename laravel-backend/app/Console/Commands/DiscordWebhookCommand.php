<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Services\WebhookReportService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\ProgressBar;

class DiscordWebhookCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jtq:discord-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends webhooks to Discord';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle()
    {
        /** @var WebhookReportService $webhookReportService */
        $webhookReportService = app(WebhookReportService::class);

        $subscriptions = Subscription::query()
            ->where('type', '=', 'discord')
            ->get();

        $progressBar = new ProgressBar($this->output, $subscriptions->count());
        $count = 0;
        foreach ($subscriptions as $subscription) {
            $webhookReportService->send($subscription->settings['webhook_url']);
            $progressBar->advance();
            ++$count;

            if (0 === $count % 59) {
                sleep(1);
            }
        }

        $progressBar->finish();
    }
}
