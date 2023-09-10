<?php

namespace Admin\Controllers;

use App\Models\JobPosition;
use App\Models\User;
use Tests\TestCase;

class JobPositionsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanCreateNewSimpleJobPosition(): void
    {
        $user = $this->createAdministratorUser();
        $this->actingAs($user)->post('/job-positions', [
            'name' => 'senior',
            'keywords' => 'test1,test2',
            'hidden_in_statistics' => 0,
        ]);

        $this->assertDatabaseHas(JobPosition::class, [
            'name' => 'senior',
            'hidden_in_statistics' => 0,
            'job_position_id' => null,
        ]);
    }

    public function testCanCreateNewParentChildJobPosition(): void
    {
        $user = $this->createAdministratorUser();

        /** @var JobPosition $jobPosition */
        $jobPosition = JobPosition::factory()->create();

        $this->actingAs($user)->post('/job-positions', [
            'name' => 'child',
            'job_position_id' => $jobPosition->id,
            'keywords' => 'test3,test4',
            'hidden_in_statistics' => 1,
        ]);

        $this->assertDatabaseHas(JobPosition::class, [
            'name' => $jobPosition->name,
            'hidden_in_statistics' => $jobPosition->hidden_in_statistics,
            'job_position_id' => null,
        ]);

        $this->assertDatabaseHas(JobPosition::class, [
            'name' => 'child',
            'hidden_in_statistics' => 1,
            'job_position_id' => $jobPosition->id,
        ]);
    }

    public function testCanEditJobPosition(): void
    {
        $user = $this->createAdministratorUser();

        /** @var JobPosition $jobPosition */
        $jobPosition = JobPosition::factory()->create();

        $response = $this->actingAs($user)->get("/job-positions/{$jobPosition->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($jobPosition->name);

        $this->actingAs($user)->put("/job-positions/{$jobPosition->id}", [
            'name' => 'overwritten name',
            'keywords' => 'overwritten keyword',
            'hidden_in_statistics' => 0,
        ]);

        $this->assertDatabaseHas(JobPosition::class, [
            'name' => 'overwritten name',
            'keywords' => $this->castAsJson(['overwritten keyword']),
        ]);
    }

    public function testCanShowJobPositions(): void
    {
        $user = $this->createAdministratorUser();

        /** @var JobPosition $jobPosition */
        $jobPosition = JobPosition::factory()->create();

        $response = $this->actingAs($user)->get('/job-positions', [
            'Accept' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'draw' => 0,
        ]);
        $response->assertJsonIsArray('data');
        $response->assertSeeText($jobPosition->id);
    }

    public function testCanDeleteJobPositions(): void
    {
        $user = $this->createAdministratorUser();

        /** @var JobPosition $jobPosition */
        $jobPosition = JobPosition::factory()->create();

        $response = $this->actingAs($user)->delete('/job-positions/'.$jobPosition->id);
        $response->assertStatus(302);

        $this->assertDatabaseMissing(JobPosition::class, [
            'name' => $jobPosition->name,
        ]);
    }
}
