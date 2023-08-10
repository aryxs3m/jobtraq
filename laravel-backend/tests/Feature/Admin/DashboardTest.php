<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanGetDashboard(): void
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user)->get('/');

        $response->assertSee('Dashboard');
        $response->assertSee('Szép napot!');
        $response->assertSee('Mai álláshirdetés');
        $response->assertSee('Összes álláshirdetés');
        $response->assertSee('Nem használt álláshirdetés');
    }
}
