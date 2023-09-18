<?php

namespace Tests\Unit;

use App\Services\Report\DiffReporter;
use App\Services\WebhookReportService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Mockery\MockInterface;
use Tests\TestCase;

class WebhookReportServiceTest extends TestCase
{
    public function testCanSendWebhookReport()
    {
        $this->instance(
            DiffReporter::class,
            \Mockery::mock(DiffReporter::class, function (MockInterface $mock) {
                $mock
                    ->shouldReceive('diff')
                    ->andReturn([
                        'pieChartPositions' => [
                            'support' => [
                                'first' => 1,
                                'second' => null,
                            ],
                        ],
                        'treeMapStacks' => [],
                        'positionSalaries' => [
                            'backend' => [
                                'medior' => [
                                    'first' => 900000,
                                    'second' => null,
                                ],
                                'senior' => [
                                    'first' => 1700000,
                                    'second' => 925000,
                                ],
                            ],
                            'php' => [
                                'medior' => [
                                    'first' => 900000,
                                    'second' => null,
                                ],
                            ],
                        ],
                    ]);
            })
        );

        Http::fake([
            'fake.jobtraq.hu/webhook/*' => Http::response([
                'success' => true,
                200,
            ]),
        ]);

        /** @var WebhookReportService $webhookReporter */
        $webhookReporter = app(WebhookReportService::class);
        $webhookReporter->send('https://fake.jobtraq.hu/webhook/1');

        $userAgent = sprintf('%s %s (%s)',
            config('app.name'),
            config('app.env'),
            config('app.url'),
        );

        Http::assertSent(function (Request $request) use ($userAgent) {
            return
                'https://fake.jobtraq.hu/webhook/1' === $request->url()
                && $request->hasHeader('Content-Type', 'application/json')
                && $request->hasHeader('User-Agent', $userAgent);
        });
    }
}
