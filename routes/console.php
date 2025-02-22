<?php

use App\Jobs\DeleteUndefinedAnswerFiles;
use App\Models\TaskAnswer;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::job(new DeleteUndefinedAnswerFiles)->weekly();
