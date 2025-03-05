@extends('layouts.app')

@section('title', $subject->name)

@section('content')
<div class="container">
    <h2>{{ $subject->name }}</h2>
    <p><strong>{{ __('messages.subject_code') }}:</strong> {{ $subject->code }}</p>
    <p><strong>{{ __('messages.department') }}:</strong> {{ $subject->department->name ?? 'N/A' }}</p>
    <p><strong>{{ __('messages.semesters') }}:</strong> {{ $subject->semesters->pluck('name')->join(', ') ?: 'N/A' }}</p>
    <p><strong>{{ __('messages.hours_count') }}:</strong> {{ $subject->hours }}</p>
    <p><strong>{{ __('messages.academic_years') }}:</strong> {{ $subject->academicYears->pluck('year')->join(', ') ?: 'N/A' }}</p>
    <p><strong>{{ __('messages.doctors') }}:</strong> {{ $subject->doctors->pluck('name')->join(', ') ?: 'N/A' }}</p>
    <p><strong>{{ __('messages.students_count') }}:</strong> {{ $subject->students_count }}</p>

    @if(Auth::guard('admin')->check() || Auth::guard('doctor')->check())
        <a href="{{ route('all.student.subject', $subject->id) }}" class="btn btn-primary">{{ __('messages.students') }}</a>
    @endif
    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">{{ __('messages.back') }}</a>

    <hr>

    <!-- Lectures Section -->
    <h3>{{ __('messages.lectures') }}</h3>

    @role('Doctor', 'doctor')
        <form action="{{ route('lectures.store') }}" method="POST">
            @csrf
            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
            <input type="text" name="name" class="form-control" placeholder="Lecture Name" required>
            <button type="submit" class="btn btn-primary mt-2">{{ __('messages.add_lecture') }}</button>
        </form>
    @endrole

    @if ($subject->lectures->count() > 0)
        <ul class="list-group mt-3">
            @foreach ($subject->lectures as $lecture)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $lecture->name }}</span>

                    <div>
                        @role('Doctor', 'doctor')
                            <button class="btn btn-sm btn-success add-task-btn" data-lecture-id="{{ $lecture->id }}">{{ __('messages.add_task') }}</button>
                            <a href="{{ route('lectures.edit', $lecture->id) }}" class="btn btn-sm btn-warning">{{ __('messages.edit') }}</a>
                            <form action="{{ route('lectures.destroy', $lecture->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">{{ __('messages.delete') }}</button>
                            </form>
                        @endrole
                    </div>
                </li>

                <!-- Hidden Task Form -->
                <li class="list-group-item task-form d-none" id="task-form-{{ $lecture->id }}">
                    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lecture_id" value="{{ $lecture->id }}">
                        <input type="file" name="file" class="form-control mt-2" required>
                        <input type="date" name="deadline" class="form-control mt-2" required>
                        <button type="submit" class="btn btn-sm btn-primary mt-2">{{ __('messages.upload_task') }}</button>
                    </form>
                </li>

                <!-- Display Tasks -->
                <div class="d-flex flex-wrap gap-3">
                    @foreach ($lecture->tasks as $task)
                        @php
                            $filePath = asset('lectures-tasks/' . $task->name);
                            $fileExtension = pathinfo($task->name, PATHINFO_EXTENSION);
                        @endphp

                        <div class="card p-3 shadow-sm" style="width: 250px;">
                            <div class="text-center">
                                @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ $filePath }}" alt="Task Image" class="img-fluid rounded mb-2" style="max-height: 150px;">
                                @elseif (in_array(strtolower($fileExtension), ['mp4', 'mkv']))
                                    <video controls class="w-100 rounded mb-2" style="max-height: 150px;">
                                        <source src="{{ $filePath }}" type="video/{{ $fileExtension }}">
                                        Your browser does not support the video tag.
                                    </video>
                                @elseif (in_array(strtolower($fileExtension), ['mp3', 'wav']))
                                    <audio controls class="w-100 mb-2">
                                        <source src="{{ $filePath }}" type="audio/{{ $fileExtension }}">
                                        Your browser does not support the audio tag.
                                    </audio>
                                @else
                                    <p class="text-muted">File: {{ $task->name }}</p>
                                @endif
                            </div>

                            <p class="mb-1"><strong>Deadline:</strong> {{ $task->deadline }}</p>

                            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                                @role('Student', 'web')
                                    <!-- Upload Answer -->
                                    <form action="{{ route('task-answers.store') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
                                        @csrf
                                        <input type="hidden" name="task_id" value="{{ $task->id }}">

                                        <div class="input-group">
                                            <input type="file" name="answer_file" class="form-control form-control-sm" required>
                                            <button type="submit" class="btn btn-success btn-sm">{{ __('messages.upload') }}</button>
                                        </div>
                                    </form>
                                @endrole

                                <a href="{{ $filePath }}" download class="btn btn-sm btn-primary">{{ __('messages.download') }}</a>

                                @role('Doctor', 'doctor')
                                    <a href="{{ route('task-answers.show', $task->id) }}" class="btn btn-sm btn-warning">{{ __('messages.students_answers') }}</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">{{ __('messages.delete') }}</button>
                                    </form>
                                @endrole
                            </div>

                        </div>
                    @endforeach
                </div>
            @endforeach
        </ul>
    @else
        <p>{{ __('messages.not_found')  .' '. __('messages.lectures')}}</p>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.add-task-btn').forEach(button => {
            button.addEventListener('click', function () {
                let lectureId = this.getAttribute('data-lecture-id');
                let taskForm = document.getElementById('task-form-' + lectureId);
                taskForm.classList.toggle('d-none');
            });
        });
    });
</script>
@endsection
