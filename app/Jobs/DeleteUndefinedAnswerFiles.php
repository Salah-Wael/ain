<?php

namespace App\Jobs;

use App\Models\TaskAnswer;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteUndefinedAnswerFiles implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $validPaths = array_flip(TaskAnswer::pluck('path')->toArray()); // تحويل المسارات إلى خريطة للبحث الأسرع
        $directory = public_path('task-answers'); // تحديد مجلد التخزين

        if (File::exists($directory)) {
            $files = File::files($directory); // جلب جميع الملفات داخل المجلد

            // تصفية الملفات غير المسجلة في قاعدة البيانات
            $filesToDelete = array_filter($files, function ($file) use ($validPaths) {
                return !isset($validPaths['task-answers/' . $file->getFilename()]);
            });

            // حذف الملفات غير المسجلة دفعة واحدة
            File::delete(array_map(fn($file) => $file->getPathname(), $filesToDelete));
        }
    }
}
