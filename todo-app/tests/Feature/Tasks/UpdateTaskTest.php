<?php

use App\Models\User;
use App\Models\Task;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('can update a task', function () {
    $task = Task::factory()->create(['user_id' => $this->user->id]);

    $response = $this->put("/tasks/{$task->id}", [
        'title' => 'Updated',
        'description' => $task->description,
        'priority' => $task->priority,
    ]);

    $response->assertRedirect();
    expect(Task::find($task->id)->title)->toBe('Updated');
});
