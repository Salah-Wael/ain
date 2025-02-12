@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $subject->name }}</h2>
    <p><strong>Code:</strong> {{ $subject->code }}</p>
    <p><strong>Department:</strong> {{ $subject->department->name }}</p>
    <p><strong>Semester:</strong> {{ $subject->semester->name }}</p>
    <p><strong>Hours:</strong> {{ $subject->hours }}</p>
    <p><strong>Academic Year:</strong> {{ $subject->academicYear->year }}</p>

    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to List</a>

    <hr>

    <!-- Lectures Section -->
    <h3>Lectures</h3>

    @role('Doctor', 'doctor')
        <form action="{{ route('lectures.store') }}" method="POST">
            @csrf
            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
            <input type="text" name="name" class="form-control" placeholder="Lecture Name" required>
            <button type="submit" class="btn btn-primary mt-2">Add Lecture</button>
        </form>
    @endrole

    @if ($subject->lectures->count() > 0)
        <ul class="list-group mt-3">
            @foreach ($subject->lectures as $lecture)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $lecture->name }}</span>

                    <div>
                        @role('Doctor', 'doctor')
                            <button class="btn btn-sm btn-success add-task-btn" data-lecture-id="{{ $lecture->id }}">add Task</button>
                            <a href="{{ route('lectures.edit', $lecture->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('lectures.destroy', $lecture->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endrole
                    </div>
                </li>

                <!-- Hidden Task Form (Initially Hidden) -->
                <li class="list-group-item task-form d-none" id="task-form-{{ $lecture->id }}">
                    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lecture_id" value="{{ $lecture->id }}">
                        <input type="file" name="file" class="form-control mt-2" required>
                        <input type="date" name="deadline" class="form-control mt-2" required>
                        <button type="submit" class="btn btn-sm btn-primary mt-2">Upload Task</button>
                    </form>
                </li>

                <!-- Display Tasks Inside Each Lecture -->
                <div class="d-flex flex-wrap gap-3">
                    @foreach ($lecture->tasks as $task)

                        @php
                            $filePath = asset('lectures-tasks/' . $task->name); // Adjust based on storage
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
                                    <!-- Upload Answer Section -->
                                    <form action="{{  route('task-answers.store') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
                                        @csrf
                                        <input type="hidden" name="task_id" value="{{ $task->id }}">

                                        <!-- Custom File Input -->
                                        <div class="input-group">
                                            <input type="file" name="answer_file" class="form-control form-control-sm" required>
                                            <button type="submit" class="btn btn-success btn-sm">Upload</button>
                                        </div>
                                    </form>
                                @endrole

                                <!-- Download Button -->
                                <a href="{{ $filePath }}" download class="btn btn-sm btn-primary">Download</a>

                                @role('Doctor', 'doctor')
                                    <!-- Delete Task Button -->
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endrole
                            </div>

                        </div>

                    @endforeach
                </div>
            @endforeach
        </ul>
    @else
        <p>No lectures available.</p>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Show the task form when clicking "+"
        document.querySelectorAll('.add-task-btn').forEach(button => {
            button.addEventListener('click', function () {
                let lectureId = this.getAttribute('data-lecture-id');
                let taskForm = document.getElementById('task-form-' + lectureId);

                if (taskForm.classList.contains('d-none')) {
                    taskForm.classList.remove('d-none');
                } else {
                    taskForm.classList.add('d-none');
                }
            });
        });
    });
</script>
@endsection
