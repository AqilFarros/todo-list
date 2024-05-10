<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todo = Todo::where('user_id', Auth::user()->id)->latest()->get();

        return view('pages.todo.index', compact('todo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => 'required',
        ]);

        try {
            Todo::create([
                'user_id' => Auth::user()->id,
                'task' => $request->task
            ]);

            return redirect()->back();
        } catch (\Exception $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $todo = Todo::findOrFail($id);

        if ($todo->status == "Todo") {
            $todo->update([
                'status' => 'In Progress'
            ]);
        } else {
            $todo->update([
                'status' => 'Todo'
            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::findOrFail($id);

        $todo->delete();

        return redirect()->back();
    }
}
