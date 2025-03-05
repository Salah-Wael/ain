@extends('layouts.app')

@section('title', __('messages.add') . ' ' . __('messages.department'))
@section('content')
<div class="container">
    <h2>{{ __('messages.add') }} {{ __('messages.department') }}</h2>
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>{{ __('messages.name') }}</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>{{ __('messages.abbreviation') }}</label>
            <input type="text" name="abbreviation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">{{ __('messages.save') }}</button>
    </form>
</div>
@endsection
