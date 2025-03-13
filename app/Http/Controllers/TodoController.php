<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index(): View
    {
        $title = "Todo List";
        $todos = Auth::user()->todos()->with('user')->get()->sortByDesc("created_at");
        // $todos = Todo::where("user_id", Auth::user()->id)->get();

        return view("todo.index", compact("title", "todos"));
    }

    public function add(): View
    {
        $title = "Add Todo";
        return view("todo.add", compact("title"));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string|min:3|max:255",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data["user_id"] = Auth::user()->id;

        Todo::create($data);

        return redirect()->route("todo.index")->with("success", "Todo created successfully");
    }

    public function delete($id): RedirectResponse
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect()->route("todo.index")->with("success", "Todo deleted successfully");
    }

    public function edit($id): View
    {
        $title = "Edit Todo";
        $todo = Todo::findOrFail($id);

        return view("todo.edit", compact("title", "todo"));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string|min:3|max:255",
            "status" => "required|string|in:pending,on_progress,completed",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $todo = Todo::findOrFail($id);
        $todo->update($data);

        return redirect()->route("todo.index")->with("success", "Todo updated successfully");
    }
}
