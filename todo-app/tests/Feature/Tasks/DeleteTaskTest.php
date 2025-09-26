<?php

use App\Models\User;
use App\Models\Task;


beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('can delete a task', function () {
    $task = Task::factory()->create(['user_id' => $this->user->id]);

    $response = $this->delete("/tasks/{$task->id}");

    $response->assertRedirect();

    $deletedTask = Task::find($task->id);
    if ($deletedTask) {
        dump($deletedTask->toArray());
    }
    expect($deletedTask)->toBeNull();
});
