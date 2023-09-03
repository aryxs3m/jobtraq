<?php

namespace Admin\Controllers;

use App\Models\Country;
use App\Models\Location;
use App\Models\User;
use Tests\TestCase;

class LocationsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanCreateNewLocation(): void
    {
        $user = User::factory()->make();

        /** @var Country $country */
        $country = Country::factory()->create();

        $this->actingAs($user)->post('/data/locations', [
            'location' => 'Teszt hely',
            'country' => $country->id,
        ]);

        $this->assertDatabaseHas(Location::class, [
            'location' => 'Teszt hely',
            'country_id' => $country->id,
        ]);
    }

    public function testCanEditLocation(): void
    {
        $user = User::factory()->make();

        /** @var Location $location */
        $location = Location::factory()->create();

        $response = $this->actingAs($user)->get("/data/locations/{$location->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($location->name);

        $this->actingAs($user)->put("/data/locations/{$location->id}", [
            'location' => 'Teszt átírt',
        ]);

        $this->assertDatabaseHas(Location::class, [
            'location' => 'Teszt átírt',
        ]);
    }

    public function testCanShowLocations(): void
    {
        $user = User::factory()->make();

        /** @var Location $location */
        $location = Location::factory()->create();

        $response = $this->actingAs($user)->get('/data/locations', [
            'Accept' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'draw' => 0,
        ]);
        $response->assertJsonIsArray('data');
        $response->assertSeeText($location->id);
    }

    public function testCanDeleteLocation(): void
    {
        $user = User::factory()->make();

        /** @var Location $location */
        $location = Location::factory()->create();

        $response = $this->actingAs($user)->delete('/data/locations/'.$location->id);
        $response->assertStatus(302);

        $this->assertDatabaseMissing(Location::class, [
            'location' => $location->name,
        ]);
    }
}
