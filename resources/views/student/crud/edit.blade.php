@extends('layouts.app')

@section('title', __('messages.edit') . ' ' . __('messages.student'))

@section('content')
<div class="container">
    <h2>{{ __('messages.edit') }} {{ __('messages.student') }}</h2>
    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('messages.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $student->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email') }}</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $student->email }}">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('messages.password') }}</label>
            <input type="password" name="password" id="password" class="form-control">
            <small class="form-text text-muted">Leave blank to keep the current password.</small>
        </div>
        <div class="mb-3">
            <label for="department_id" class="form-label">{{ __('messages.department') }}</label>
            <select name="department_id" id="department_id" class="form-control" required>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $student->department_id == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
    </form>
</div>
@endsection
