<?php

namespace Admin\Controllers;

use App\Models\JobPosition;
use App\Models\JobStack;
use App\Models\User;
use Tests\TestCase;

class JobStacksTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function testCanCreateNewJobStack(): void
    {
        $user = User::factory()->make();
        $this->actingAs($user)->post('/job-stacks', [
            'name' => 'jobstack',
            'keywords' => 'test1,test2',
        ]);

        $this->assertDatabaseHas(JobStack::class, [
            'name' => 'jobstack',
        ]);
    }

    public function testCanCreateNewDefaultPositionJobStack(): void
    {
        $user = User::factory()->make();

        /** @var JobPosition $jobPosition */
        $jobPosition = JobPosition::factory()->create();

        $this->actingAs($user)->post('/job-stacks', [
            'name' => 'jobstack',
            'keywords' => 'test1,test2',
            'job_position' => $jobPosition->id,
        ]);

        $this->assertDatabaseHas(JobStack::class, [
            'name' => 'jobstack',
            'job_position_id' => $jobPosition->id,
        ]);
    }

    public function testCanEditJobStack(): void
    {
        $user = User::factory()->make();

        /** @var JobStack $jobStack */
        $jobStack = JobStack::factory()->create();

        $response = $this->actingAs($user)->get("/job-stacks/{$jobStack->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($jobStack->name);

        $this->actingAs($user)->put("/job-stacks/{$jobStack->id}", [
            'name' => 'overwritten name',
            'keywords' => 'overwritten keyword',
        ]);

        $this->assertDatabaseHas(JobStack::class, [
            'name' => 'overwritten name',
            'keywords' => $this->castAsJson(['overwritten keyword']),
        ]);
    }

    public function testCanShowJobStacks(): void
    {
        $user = User::factory()->make();

        /** @var JobStack $jobStack */
        $jobStack = JobStack::factory()->create();

        $response = $this->actingAs($user)->get('/job-stacks', [
            'Accept' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'draw' => 0,
        ]);
        $response->assertJsonIsArray('data');
        $response->assertSeeText($jobStack->id);
    }

    public function testCanDeleteJobStack(): void
    {
        $user = User::factory()->make();

        /** @var JobStack $jobStack */
        $jobStack = JobStack::factory()->create();

        $response = $this->actingAs($user)->delete('/job-stacks/'.$jobStack->id);
        $response->assertStatus(302);

        $this->assertDatabaseMissing(JobStack::class, [
            'name' => $jobStack->name,
        ]);
    }
}
