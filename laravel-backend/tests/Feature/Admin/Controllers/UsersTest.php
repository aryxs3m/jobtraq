<?php

namespace Admin\Controllers;

use App\Models\User;
use Tests\TestCase;

class UsersTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanCreateNewUser(): void
    {
        $user = $this->createAdministratorUser();
        $this->actingAs($user)->post('/users', [
            'name' => 'PHPUnit User',
            'email' => 'phpunit@jobtraq.hu',
            'password' => 'PHPUnitPass[123]',
            'roles' => [
                'Adminisztrátor',
            ],
        ]);

        $this->assertDatabaseHas(User::class, [
            'name' => 'PHPUnit User',
            'email' => 'phpunit@jobtraq.hu',
        ]);

        $newUser = User::whereEmail('phpunit@jobtraq.hu')->firstOrFail();
        $response = $this->actingAs($newUser)->get('/');
        $response->assertSee('PHPUnit User');
    }

    public function testCanEditUser(): void
    {
        $user = $this->createAdministratorUser();

        /** @var User $editedUser */
        $editedUser = User::factory()->create();

        $response = $this->actingAs($user)->get("/users/{$editedUser->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($editedUser->name);

        $this->actingAs($user)->put("/users/{$editedUser->id}", [
            'name' => 'PHPUnit Renamed User',
            'email' => 'phpunit2@jobtraq.hu',
            'roles' => [
                'Adminisztrátor',
            ],
        ]);

        $this->assertDatabaseHas(User::class, [
            'name' => 'PHPUnit Renamed User',
            'email' => 'phpunit2@jobtraq.hu',
        ]);
    }

    public function testCanShowUsers(): void
    {
        $user = $this->createAdministratorUser();

        /** @var User $checkedUser */
        $checkedUser = User::factory()->create();

        $response = $this->actingAs($user)->get('/users', [
            'Accept' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'draw' => 0,
        ]);
        $response->assertJsonIsArray('data');
        $response->assertSeeText($checkedUser->id);
    }

    public function testCanDeleteUser(): void
    {
        $user = $this->createAdministratorUser();

        /** @var User $deletedUser */
        $deletedUser = User::factory()->create();

        $response = $this->actingAs($user)->delete('/users/'.$deletedUser->id);
        $response->assertStatus(302);

        $this->assertDatabaseMissing(User::class, [
            'name' => $deletedUser->name,
        ]);
    }
}
