<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $tasks = Task::where('user_id', $user->id);

        // Por padrão, mostrar apenas tasks pendentes, a menos que o filtro seja explicitamente 'complete'
        if ($request->filled('status')) {
            if (strtolower($request->status) === 'complete') {
                $tasks->where('is_completed', true);
            } elseif (strtolower($request->status) === 'pending') {
                $tasks->where('is_completed', false);
            }
        } /*else {
            $tasks->where('is_completed', false);
        }*/

        if ($request->filled('priority')) {
            $tasks->where('priority', 'like', '%' . $request->priority . '%');
        }

        if ($request->filled('due_date')) {
            $tasks->whereDate('due_date', $request->due_date);
        }

        $orderedTasks = $tasks->orderByRaw("is_completed ASC")
            ->orderByRaw("CASE WHEN due_date IS NULL THEN 1 ELSE 0 END, due_date ASC")
            ->orderByRaw("CASE priority WHEN 'high' THEN 1 WHEN 'medium' THEN 2 WHEN 'low' THEN 3 ELSE 4 END ASC")
            ->paginate(6);

        return Inertia::render('Tasks/Index', [
            'tasks' => $orderedTasks,
            'filters' => $request->only(['status', 'priority', 'due_date']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Tasks/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'is_completed' => 'boolean',
                'due_date' => 'nullable|date',
                'priority' => 'required|in:low,medium,high',
            ]);

            $user = Auth::user();

            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'priority' => $request->priority,
                'user_id' => $user->id,
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        } catch (QueryException $e) {
            return redirect()->route('tasks.index')->with('error', 'Error creating task in the database.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        try {
            return Inertia::render('Tasks/Show', [
                'task' => $task,
            ]);
        } catch (AuthorizationException $e) {
            return redirect()->route('tasks.index')->with('error', 'You do not have permission to view this task.');
        } catch (QueryException $e) {
            return redirect()->route('tasks.index')->with('error', 'Error accessing the database.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        try {
            return Inertia::render('Tasks/Edit', [
                'task' => $task,
            ]);
        } catch (AuthorizationException $e) {
            return redirect()->route('tasks.index')->withErrors('You do not have permission to edit this task.');
        } catch (QueryException $e) {
            return redirect()->route('tasks.index')->withErrors('Error accessing the database.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'is_completed' => 'boolean',
                'due_date' => 'nullable|date',
                'priority' => 'nullable|in:low,medium,high',
            ]);

            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'is_completed' => $request->boolean('is_completed'),
                'due_date' => $request->due_date,
                'priority' => $request->priority,
            ]);

            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        } catch (AuthorizationException $e) {
            return redirect()->route('tasks.index')->withErrors('You do not have permission to update this task.');
        } catch (QueryException $e) {
            return redirect()->route('tasks.index')->withErrors('Error updating the task in the database.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return redirect()->back()->with('success', 'Tarefa eliminada com sucesso.');
        } catch (AuthorizationException $e) {
            return redirect()->route('tasks.index')->withErrors('Não tem permissão para eliminar esta tarefa.');
        } catch (QueryException $e) {
            return redirect()->route('tasks.index')->withErrors('Erro ao eliminar a tarefa na base de dados.');
        }
    }
}
