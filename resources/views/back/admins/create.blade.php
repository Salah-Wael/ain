@extends('layouts.app')

@section('title', 'Create Admin')

@section('content')
    <h2>{{ __('messages.create') }} {{ __('messages.admin') }}</h2>

    <form action="{{ route('back.admins.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('messages.name') }}</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">{{ __('messages.email') }}</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="roles">{{ __('messages.assign') }} {{ __('messages.roles') }}</label>
            <select name="roleArray[]" class="form-control" multiple>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.create') }} {{ __('messages.admin') }}</button>
    </form>
@endsection
