<?php

namespace App\Services;

use App\Models\Location;
use App\Services\Discord\DiscordAuthor;
use App\Services\Discord\DiscordEmbed;
use App\Services\Discord\DiscordField;
use App\Services\Discord\DiscordMarkdown;
use App\Services\Discord\DiscordProvider;
use App\Services\Discord\DiscordWebhook;
use App\Services\Report\DiffReporter;
use App\Services\Report\HomepageReporter;
use Carbon\Carbon;

class WebhookReportService
{
    private DiffReporter $diffReporter;

    public function __construct(DiffReporter $diffReporter)
    {
        $this->diffReporter = $diffReporter;
    }

    public function send(string $webhookUrl): void
    {
        $firstReporter = HomepageReporter::make()
            ->setCountryId(Location::LOCATION_HUNGARY)
            ->setFilterDate(Carbon::yesterday());

        $secondReporter = HomepageReporter::make()
            ->setCountryId(Location::LOCATION_HUNGARY)
            ->setFilterDate(Carbon::today());

        $diff = $this->diffReporter->diff(
            $firstReporter,
            $secondReporter
        );

        $discordEmbed = DiscordEmbed::make()
            ->setTitle(Carbon::now()->locale('hu')->isoFormat('YYYY MMMM Do').' riport')
            ->setDescription(
                DiscordMarkdown::build()
                    ->text('Változások a ')->bold('tegnapi')->text(' naphoz képest.')
                    ->toString()
            )
            ->setUrl('https://jobtraq.hu/report/'.Carbon::now()->format('Y-m-d'))
            ->setColor('000000')
            ->setAuthor(
                DiscordAuthor::make()
                    ->setName('JobTraq')
                    ->setUrl('https://jobtraq.hu')
                    ->setIconUrl('https://jobtraq.hu/assets/favicons/apple-icon-60x60.png')
                    ->build()
            )
            ->setProvider(
                DiscordProvider::make()
                    ->setName('JobTraq')
                    ->setUrl('https://jobtraq.hu')
                    ->build()
            );

        foreach ($diff['pieChartPositions'] as $position => $diffValues) {
            $discordEmbed
                ->addField(
                    DiscordField::make()
                        ->setName($position)
                        ->setValue($this->shortDiff($diffValues, 'állás'))
                        ->setInline(true)
                        ->build()
                );
        }

        foreach ($diff['treeMapStacks'] as $stack => $diffValues) {
            $discordEmbed
                ->addField(
                    DiscordField::make()
                        ->setName($stack)
                        ->setValue($this->shortDiff($diffValues, 'állás'))
                        ->setInline(true)
                        ->build()
                );
        }

        $discordTopListEmbed = DiscordEmbed::make()
            ->setTitle(Carbon::now()->locale('hu')->isoFormat('YYYY MMMM Do').' stack népszerűség lista')
            ->setDescription(
                DiscordMarkdown::build()
                    ->text('A ')->bold('legkeresettebb')->text(' stackek listája.')
                    ->toString()
            )
            ->setColor('000000')
            ->setAuthor(
                DiscordAuthor::make()
                    ->setName('JobTraq')
                    ->setUrl('https://jobtraq.hu')
                    ->setIconUrl('https://jobtraq.hu/assets/favicons/apple-icon-60x60.png')
                    ->build()
            )
            ->setProvider(
                DiscordProvider::make()
                    ->setName('JobTraq')
                    ->setUrl('https://jobtraq.hu')
                    ->build()
            );

        $count = 1;
        foreach ($secondReporter->getJobsCountByStack() as $item) {
            $discordTopListEmbed->addField(
                DiscordField::make()
                    ->setName(sprintf('%s. %s', $count, $item->name))
                    ->setValue(sprintf('%s állás', $item->value))
                    ->build()
            );
            ++$count;

            if ($count > 5) {
                break;
            }
        }

        DiscordWebhook::make()
            ->setUsername('JobTraq')
            ->setAvatarUrl('https://jobtraq.hu/assets/favicons/apple-icon-180x180.png')
            ->addEmbed($discordEmbed->build())
            ->addEmbed($discordTopListEmbed->build())
            ->send($webhookUrl);
    }

    private function shortDiff(array $diffValue, string $label = ''): string
    {
        $diff = $diffValue['second'] - $diffValue['first'];
        $diffPrepend = '';

        if ($diff > 0) {
            $diffPrepend = '+';
        }

        if (!empty($label)) {
            $label = " {$label}";
        }

        return sprintf('%s%s%s', $diffPrepend, $diff, $label);
    }
}
