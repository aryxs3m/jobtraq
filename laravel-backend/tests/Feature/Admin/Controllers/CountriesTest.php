<?php

namespace Admin\Controllers;

use App\Models\Country;
use App\Models\User;
use Tests\TestCase;

class CountriesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanCreateNewCountry(): void
    {
        $user = User::factory()->make();
        $this->actingAs($user)->post('/data/countries', [
            'name' => 'Teszt Ország',
        ]);

        $this->assertDatabaseHas(Country::class, [
            'name' => 'Teszt Ország',
        ]);
    }

    public function testCanEditCountry(): void
    {
        $user = User::factory()->make();

        /** @var Country $country */
        $country = Country::factory()->create();

        $response = $this->actingAs($user)->get("/data/countries/{$country->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($country->name);

        $this->actingAs($user)->put("/data/countries/{$country->id}", [
            'name' => 'Teszt átírt',
        ]);

        $this->assertDatabaseHas(Country::class, [
            'name' => 'Teszt átírt',
        ]);
    }

    public function testCanShowCountries(): void
    {
        $user = User::factory()->make();

        /** @var Country $country */
        $country = Country::factory()->create();

        $response = $this->actingAs($user)->get('/data/countries', [
            'Accept' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'draw' => 0,
        ]);
        $response->assertJsonIsArray('data');
        $response->assertSeeText($country->id);
    }

    public function testCanDeleteCountry(): void
    {
        $user = User::factory()->make();

        /** @var Country $country */
        $country = Country::factory()->create();

        $response = $this->actingAs($user)->delete('/data/countries/'.$country->id);
        $response->assertStatus(302);

        $this->assertDatabaseMissing(Country::class, [
            'name' => $country->name,
        ]);
    }
}
