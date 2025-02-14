@extends('layouts.app')

@section('title', __('messages.create') . ' ' . __('messages.head_of_department'))

@section('content')
<div class="container">
    <h2>{{ __('messages.create') }} {{ __('messages.head_of_department') }}</h2>
    <form action="{{ route('head_of_departments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('messages.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email') }}</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('messages.password') }}</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="department_id" class="form-label">{{ __('messages.department') }}</label>
            <select name="department_id" id="department_id" class="form-select" required>
                <option value="">{{ __('messages.select') }} {{ __('messages.department') }}</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.create') }}</button>
    </form>
</div>
@endsection
