<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectRecap;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectReviewTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $project;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test user
        $this->user = User::factory()->create();

        // Create test project
        $this->project = Project::factory()->create();
    }

    /** @test */
    public function it_can_create_project_review_for_current_period()
    {
        // Mock current time to specific date
        Carbon::setTestNow(Carbon::create(2024, 2, 15));

        $this->actingAs($this->user);

        $response = $this->post(route('project.review'), [
            'project_id' => $this->project->id,
            'complexity' => 'medium',
            'number_of_panel' => 10,
            'comic_name' => 'Test Comic',
            'message' => 'Test message'
        ]);

        // Assert recap was created with correct period (February)
        $this->assertDatabaseHas('project_recaps', [
            'user_id' => $this->user->id,
            'periode' => 'February',
            'total_project' => 1,
            'total_panel' => 10
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    /** @test */
    public function it_can_update_existing_recap_for_same_period()
    {
        Carbon::setTestNow(Carbon::create(2024, 2, 15));

        $this->actingAs($this->user);

        // Create initial recap
        ProjectRecap::create([
            'user_id' => $this->user->id,
            'total_project' => 5,
            'total_panel' => 50,
            'periode' => 'February'
        ]);

        $response = $this->post(route('project.review'), [
            'project_id' => $this->project->id,
            'complexity' => 'medium',
            'number_of_panel' => 10,
            'comic_name' => 'Test Comic',
            'message' => 'Test message'
        ]);

        // Assert recap was updated
        $this->assertDatabaseHas('project_recaps', [
            'user_id' => $this->user->id,
            'periode' => 'February',
            'total_project' => 6, // 5 + 1
            'total_panel' => 60 // 50 + 10
        ]);
    }

    /** @test */
    public function it_creates_new_recap_for_different_period()
    {
        // First create a recap for February
        Carbon::setTestNow(Carbon::create(2024, 2, 15));

        $this->actingAs($this->user);

        $this->post(route('project.review'), [
            'project_id' => $this->project->id,
            'complexity' => 'medium',
            'number_of_panel' => 10,
            'comic_name' => 'Test Comic',
            'message' => 'Test message'
        ]);

        // Then create a recap for March
        Carbon::setTestNow(Carbon::create(2024, 3, 15));

        $response = $this->post(route('project.review'), [
            'project_id' => $this->project->id,
            'complexity' => 'medium',
            'number_of_panel' => 20,
            'comic_name' => 'Test Comic 2',
            'message' => 'Test message 2'
        ]);

        // Assert both recaps exist
        $this->assertDatabaseHas('project_recap', [
            'user_id' => $this->user->id,
            'periode' => 'February',
            'total_project' => 1,
            'total_panel' => 10
        ]);

        $this->assertDatabaseHas('project_recap', [
            'user_id' => $this->user->id,
            'periode' => 'March',
            'total_project' => 1,
            'total_panel' => 20
        ]);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('project.review'), [
            'project_id' => '',
            'complexity' => '',
            'number_of_panel' => 'not-a-number',
        ]);

        $response->assertSessionHasErrors(['project_id', 'complexity']);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow(); // Clear mock time
        parent::tearDown();
    }
}
