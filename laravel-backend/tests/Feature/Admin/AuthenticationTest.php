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

    public function testRedirectToLoginWhenNotAuthenticated(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testCanLogonWithValidCredentials(): void
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

    public function testCannotLogonWithInvalidCredentials(): void
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

    public function testCanLogout(): void
    {
        $this->testCanLogonWithValidCredentials();

        $request = $this->post('/logout');
        $request->assertStatus(302);

        $response = $this->get('/');
        $response->assertRedirect('/login');
    }
}
