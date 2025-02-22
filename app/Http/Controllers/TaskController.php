<?php

namespace App\Http\Controllers;

use App\FileManager;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    use FileManager;
    const TASK_PATH = 'lectures-tasks';
    /**
     * Display a listing of the tasks.
     */
    public function showStudentsAnswers($task_id)
    {
        $task = Task::with('answers.student')
        ->findOrFail($task_id);

        return view('subjects.task-answers.show-students-answers', compact('task'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:51200|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/jpeg,image/png,video/mp4,video/x-matroska,audio/mpeg,audio/wav',
            'deadline' => 'required|date|after:now',
            'lecture_id' => 'required|exists:lectures,id',
        ]);

        $path = $this->uploadFile($request->file('file'), 'lectures-tasks');

        if($path){
            Task::create([
                'name' => $path,
                'deadline' => $validated['deadline'],
                'lecture_id' => $validated['lecture_id'],
            ]);

            return redirect()->back()->with(['success' => __('messages.task_created')]);
        }
        return redirect()->back()->with(['error' => __('messages.try_again')]);
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'deadline' => 'required|date',
        ]);

        $task->update($validated);

        return view('tasks.show', compact('task'));
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        if($this->deleteFile('lectures-tasks/'. $task->name)){
            $task->delete();
            return redirect()->back()->with(['success' => __('messages.task_deleted')]);
        }
        else{
            return redirect()->back()->with(['error' => __('messages.task_delete_error')]);
        }
    }
}
