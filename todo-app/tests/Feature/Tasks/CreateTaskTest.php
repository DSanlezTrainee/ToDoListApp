<?php

use App\Models\User;
use App\Models\Task;


beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});


it('can create a task', function () {
    $response = $this->post('/tasks', [
        'title' => 'New Task',
        'description' => 'Optional description',
        'priority' => 'high',
    ]);

    $response->assertRedirect();
    $task = Task::where('title', 'New Task')->first();
    dump($task->toArray());
    expect($task)->not->toBeNull();
});
