<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function test_redirect_to_login_when_not_authenticated(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_can_logon_with_valid_credentials(): void
    {
        // User from seeder
        $response = $this->post('/login', [
            'email' => 'test@jobtraq.hu',
            'password' => 'test-user-123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_cannot_logon_with_invalid_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'invalid@invalid.com',
            'password' => 'invalid',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    public function test_can_logout(): void
    {
        $this->test_can_logon_with_valid_credentials();

        $request = $this->post('/logout');
        $request->assertStatus(302);

        $response = $this->get('/');
        $response->assertRedirect('/login');
    }
}
