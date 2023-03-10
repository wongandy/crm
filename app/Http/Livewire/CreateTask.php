<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\Team;
use App\Models\Project;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Notifications\TaskAssignedNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateTask extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public Task $task;
    public $teams;
    public $members;
    public $projects;
    public $upload;

    protected $rules = [
        'task.title' => ['required', 'string', 'max:255'],
        'task.description' => ['required', 'string'],
        'task.deadline' => ['required', 'date'],
        'task.status' => ['required'],
        'task.project_id' => ['required'],
        'task.team_id' => ['required_with:task.project_id'],
        'task.user_id' => ['required_with:task.team_id'],
        'task.created_by' => ['required'],
        'upload' => ['nullable'],
    ];

    protected $messages = [
        'task.team_id.required_with' => 'The assigned team field is required.',
        'task.user_id.required_with' => 'The assigned member field is required.',
    ];

    public function mount()
    {
        $this->task = new Task();
        $this->teams = collect();
        $this->members = collect();
        $this->projects = Project::pluck('title', 'id');
        $this->task->status = 'open';
        $this->task->project_id = '';
        $this->task->created_by = auth()->user()->id;
    }

    public function render()
    {
        return view('livewire.create-task');
    }

    public function storeTask()
    {
        $this->authorize('create tasks');

        $this->validate();

        $this->task->save();

        if ($this->upload) {
            $this->task->addMedia($this->upload)->toMediaCollection();
        }

        $this->task->user->notify(new TaskAssignedNotification($this->task));
        
        return to_route('tasks.index');
    }


    public function updatedTaskProjectId($id)
    {
        $this->teams = Project::find($id)->teams->pluck('name', 'id');
        $this->task->team_id = '';
        $this->task->user_id = '';
    }

    public function updatedTaskTeamId($id)
    {
        $this->members = Team::find($id)->members->pluck('name', 'id');
        $this->task->user_id = '';
    }
}
