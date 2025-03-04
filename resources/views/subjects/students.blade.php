@extends('layouts.app')

@section('title', __('messages.list') . ' ' . __('messages.students'))

@section('content')
<div class="container">
    <h2>{{ __('messages.list') }} {{ __('messages.students') }}</h2>
    {{-- <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">{{ __('messages.add') }} {{ __('messages.student') }}</a> --}}

    <table class="table table-bordered">
        <caption class="fw-bold text-center p-2 bg-light rounded-top" style="caption-side: top;">{{ $subject->name }}</caption>
        <thead>
            <tr>
                <th>{{ __('messages.student_id') }}</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.department') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subject->students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->department->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
