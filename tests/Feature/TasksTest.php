<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function testOnlyLoggedInUsersCanSeeTheTasks()
    {
        $response = $this->get('/task')->assertRedirect('/login');
    }

    public function testAuthenticatedUsersCanSeeTheTasks()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('/task/create')->assertOk();
    }

    public function testTaskCanBeAdded()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->post('/task/store', [
            'task' => 'test task'
        ]);

        $this->assertCount(1, Task::all());
    }

    public function testValidateTaskSetAsCompleted()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'iscompleted' => false
        ]);

        $this->actingAs($user);
        $response = $this->get('/task/' . $task->id . '/change-completed', []);

        $data = json_decode($response->getContent(), true);
        $this->assertCount(1, Task::all());
        $this->assertTrue($data['success']);

        $updatedTask = Task::find($task->id);

        $this->assertTrue($updatedTask->isCompleted());
    }

    public function testValidateTaskSetAsNotCompleted()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'iscompleted' => true
        ]);

        $this->actingAs($user);
        $response = $this->get('/task/' . $task->id . '/change-completed', []);

        $data = json_decode($response->getContent(), true);
        $this->assertCount(1, Task::all());
        $this->assertTrue($data['success']);

        $updatedTask = Task::find($task->id);

        $this->assertFalse($updatedTask->isCompleted());
    }
}
