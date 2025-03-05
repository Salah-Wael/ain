@extends('layouts.app')

@section('title', __('messages.department'))
@section('content')
<div class="container">
    <h2>{{ __('messages.department') }}: {{ $department->name }}</h2>
    <p><strong>{{ __('messages.abbreviation') }}:</strong> {{ $department->abbreviation }}</p>
    <a href="{{ route('departments.index') }}" class="btn btn-secondary">{{ __('messages.back') }}</a>
</div>
@endsection
