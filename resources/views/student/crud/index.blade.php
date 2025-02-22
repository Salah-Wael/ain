@extends('layouts.app')

@section('title', __('messages.list') . ' ' . __('messages.students'))

@section('content')
<div class="container">
    <h2>{{ __('messages.list') }} {{ __('messages.students') }}</h2>
    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">{{ __('messages.add') }} {{ __('messages.student') }}</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('messages.student_id') }}</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.department') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->department->name }}</td>
                <td>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">{{ __('messages.edit') }}</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">{{ __('messages.delete') }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
