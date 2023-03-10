<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Enums\Task\Statuses;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view tasks');

        $tasks = Task::with('project', 'team', 'user')->latest()->paginate();
        
        return view('tasks.index', compact('tasks'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create tasks');

        $projects = Project::pluck('title', 'id');

        return view('tasks.create', compact('projects'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize('create tasks');

        return view('tasks.edit', compact('task'));
    }
}
