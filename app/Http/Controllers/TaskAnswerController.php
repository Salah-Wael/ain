<?php

namespace App\Http\Controllers;

use App\FileManager;
use App\Models\Task;
use App\Models\TaskAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskAnswerController extends Controller
{
    use FileManager;
    const ANSWER_PATH = 'task-answers';
    const TASK_PATH = 'lectures-tasks';
    /**
     * تخزين الإجابة على المهمة
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'answer_file' => 'required|file|max:2048', // الحد الأقصى 2MB
        ]);

        $answer = TaskAnswer::firstWhere([
            'task_id' => $request->task_id,
            'student_id' => Auth::id(),
        ]);

        if ($answer) {
            if ($this->deleteFile('task-answers/' . $answer->path)) {
                $answer->delete();
            } else {
                return redirect()->back()->with(['error' => 'Error deleting the previous Answer.']);
            }
        }

        $task = Task::find($request->task_id);

        $path = $this->uploadFile($request->file('answer_file'), 'task-answers');

        if ($path) {
            TaskAnswer::create([
                'task_id' => $task->id,
                'student_id' => Auth::user()->id,
                'path' => $path,
            ]);
            return redirect()->back()->with(['success' => 'Answer uploaded successfully.']);
        }
        return redirect()->back()->with(['error' => 'Try again later please.']);
    }
}
