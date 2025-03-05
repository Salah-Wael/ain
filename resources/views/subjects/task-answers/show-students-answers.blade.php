@extends('layouts.app') {{-- Adjust based on your layout --}}


@section('title', trans('messages.task_answers'))
@section('content')
<div class="container">
    <h2>{{ trans('messages.task_answers_for') }}: {{ $task->name }}</h2>

    @if ($task->answers->isEmpty())
        <p class="alert alert-warning">{{ trans('messages.no_answers_uploaded') }}</p>
    @else
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>{{ trans('messages.student_id') }}</th>
                    <th>{{ trans('messages.student_name') }}</th>
                    <th>{{ trans('messages.uploaded_file') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($task->answers as $answer)
                    <tr>
                        <td>{{ $answer->student->id }}</td>
                        <td>{{ $answer->student->name }}</td>
                        <td>
                            @php
                                $filePath = asset('task-answers/' . $answer->path);
                                $fileExtension = pathinfo($answer->path, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png']))
                                <img src="{{ $filePath }}" alt="{{ trans('messages.uploaded_image') }}" width="100">
                            @elseif (in_array(strtolower($fileExtension), ['pdf', 'doc', 'docx']))
                                <a href="{{ $filePath }}" target="_blank" class="btn btn-success btn-sm">
                                    {{ trans('messages.view_file') }}
                                </a>
                                <a href="{{ $filePath }}" download class="btn btn-sm btn-primary">
                                    {{ __('messages.download') }}
                                </a>
                            @else
                                <span class="text-danger">{{ trans('messages.unsupported_file_type') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
