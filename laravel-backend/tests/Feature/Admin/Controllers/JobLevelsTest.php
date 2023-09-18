<?php

namespace Admin\Controllers;

use App\Models\JobLevel;
use Tests\TestCase;

class JobLevelsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanCreateNewJobLevel(): void
    {
        $user = $this->createAdministratorUser();
        $this->actingAs($user)->post('/job-levels', [
            'name' => 'joblevel name',
            'keywords' => 'test1,test2',
        ]);

        $this->assertDatabaseHas(JobLevel::class, [
            'name' => 'joblevel name',
        ]);
    }

    public function testCanEditJobLevel(): void
    {
        $user = $this->createAdministratorUser();

        /** @var JobLevel $jobLevel */
        $jobLevel = JobLevel::factory()->create();

        $response = $this->actingAs($user)->get("/job-levels/{$jobLevel->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($jobLevel->name);

        $this->actingAs($user)->put("/job-levels/{$jobLevel->id}", [
            'name' => 'overwritten job level name',
            'keywords' => 'custom keyword',
        ]);

        $this->assertDatabaseHas(JobLevel::class, [
            'name' => 'overwritten job level name',
            'keywords' => $this->castAsJson(['custom keyword']),
        ]);
    }

    public function testCanShowJobLevels(): void
    {
        $user = $this->createAdministratorUser();

        /** @var JobLevel $jobLevel */
        $jobLevel = JobLevel::factory()->create();

        $response = $this->actingAs($user)->get('/job-levels', [
            'Accept' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'draw' => 0,
        ]);
        $response->assertJsonIsArray('data');
        $response->assertSeeText($jobLevel->id);
    }

    public function testCanDeleteJobLevel(): void
    {
        $user = $this->createAdministratorUser();

        /** @var JobLevel $jobLevel */
        $jobLevel = JobLevel::factory()->create();

        $response = $this->actingAs($user)->delete('/job-levels/'.$jobLevel->id);
        $response->assertStatus(302);

        $this->assertDatabaseMissing(JobLevel::class, [
            'name' => $jobLevel->name,
        ]);
    }
}
