<?php

namespace App\Http\Controllers\Api;

use App\FileManager;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskAnswerController extends Controller
{
    use FileManager;

    const ANSWER_PATH = 'task-answers';
    const TASK_PATH = 'lectures-tasks';

    public function getStudentAnswers()
    {
        $student = User::with('subjects.lectures.tasks.answers')->find(Auth::id());
        $student['task_path'] = self::TASK_PATH;
        $student['answer_path'] = self::ANSWER_PATH;

        return sendResponse($student, 'Tasks and Answers fetched successfully.');
    }


    /**
     * تخزين الإجابة على المهمة
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'answer_file' => 'required|file|max:10000',
        ]);


        $task = Task::find($request->task_id);

        $path = $this->uploadFile($request->file('answer_file'), 'task-answers');

        if ($path) {
            TaskAnswer::updateOrCreate(
                [
                    'task_id' => $request->task_id,
                    'student_id' => Auth::user()->id,
                ],
                [
                    'path' => $path,
                ]
            );
            return sendResponse([], 'Answer uploaded successfully.');
        }
        return sendError('', 'Try again later please.');
    }

    /**
     * تحميل الإجابة
     */
    public function download(TaskAnswer $taskAnswer)
    {
        if (!Storage::disk('public')->exists($taskAnswer->path)) {
            return sendError('File not found.');
        }

        return Storage::disk('public')->download($taskAnswer->path);
    }
}
