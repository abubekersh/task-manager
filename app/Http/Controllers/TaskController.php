<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filter == "completed") {
            $tasks = Task::where('is_completed', '=', '1')->orderBy('is_completed')->orderByDesc('created_at')->paginate(4);
        } elseif ($request->filter == "pending") {
            $tasks = Task::where('is_completed', '=', '0')->orderBy('is_completed')->orderByDesc('created_at')->paginate(4);
        } elseif ($request->filter == "due") {
            $tasks = Task::where('due_date', '<=', now())->where('is_completed', '=', '0')->orderBy('is_completed')->orderByDesc('created_at')->paginate(4);
        } else {
            $tasks = Task::where('id', '>', '1')->orderBy('is_completed')->orderByDesc('created_at')->paginate(4);
        }
        return view('tasks.index', ['tasks' => $tasks, 'filter' => $request->filter]);
    }
    public function create()
    {
        return view('tasks.create');
    }
    public function store(Request $request)
    {
        $task = $request->validate([
            'title' => 'required|string|max:255|min:5',
            'description' => 'max:500',
            'due_date' => 'date'
        ]);
        Task::create($task);
        return redirect('/')->with('success', 'Task Created!');;
    }
    public function edit(int $task)
    {

        return view('tasks.edit', ['task' => Task::find($task)]);
    }
    public function update(Request $request)
    {
        $task = $request->validate([
            'title' => 'required|string|max:255|min:5',
            'description' => 'max:500',
            'due_date' => 'date'
        ]);
        $t = Task::find($request->id);
        $t->title = $task['title'];
        $t->description = $task['description'];
        $t->due_date = $task['due_date'];
        $t->save();
        return redirect('/')->with('success', 'Task updated!');
    }
    public function destroy(int $task)
    {
        Task::destroy($task);
        return redirect('/')->with('success', 'Task Deleted!');;
    }
    public function complete(int $task)
    {
        $task = Task::find($task);
        $task->is_completed = true;
        $task->save();
        return redirect('/')->with('success', 'Task marked as complete!');;
    }
}
