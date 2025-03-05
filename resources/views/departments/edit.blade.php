@extends('layouts.app')

@section('title', __('messages.edit') . ' ' . __('messages.department'))
@section('content')
<div class="container">
    <h2>{{ __('messages.edit') }} {{ __('messages.department') }}</h2>
    <form action="{{ route('departments.update', $department) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label>{{ __('messages.name') }}</label>
            <input type="text" name="name" value="{{ $department->name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>{{ __('messages.abbreviation') }}</label>
            <input type="text" name="abbreviation" value="{{ $department->abbreviation }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
    </form>
</div>
@endsection
