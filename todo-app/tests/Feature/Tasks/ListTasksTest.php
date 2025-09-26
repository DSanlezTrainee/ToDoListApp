<?php

use App\Models\User;
use App\Models\Task;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('can list tasks', function () {
    Task::factory()->create([
        'user_id' => $this->user->id,
        'title' => 'Teste'
    ]);

    $response = $this->get('/tasks');

    $tasks = Task::where('user_id', $this->user->id)->get();
    dump($tasks->toArray());

    $response->assertStatus(200);
    $response->assertSee('Teste');
});
