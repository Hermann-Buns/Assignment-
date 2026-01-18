<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return view('todos', [
            'todos' => Todo::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255'
        ]);

        Todo::create([
            'task' => $request->task
        ]);

        return redirect('/');
    }

    public function edit($id)
    {
        $todo = Todo::findOrFail($id);
        return view('edit', ['todo' => $todo]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'task' => 'required|string|max:255'
        ]);

        $todo = Todo::findOrFail($id);
        $todo->update([
            'task' => $request->task
        ]);

        return redirect('/');
    }

    public function destroy($id)
    {
        Todo::destroy($id);
        return redirect('/');
    }

    public function toggleComplete($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update([
            'completed' => !$todo->completed
        ]);
        return redirect('/');
    }
}
