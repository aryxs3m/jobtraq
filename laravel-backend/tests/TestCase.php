<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected function createAdministratorUser(): User
    {
        $user = User::factory()->create();
        $user->assignRole('Adminisztrátor');

        return $user;
    }
}
