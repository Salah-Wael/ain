@extends('layouts.app')

@section('title', 'Edit Admin')

@section('content')
    <h2>Edit Admin</h2>

    <form action="{{ route('back.admins.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
        </div>

        <div class="form-group">
            <label for="roles">Assign Roles</label>
            <select name="roleArray[]" class="form-control" multiple>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" @if($admin->roles->pluck('name')->contains($role->name)) selected @endif>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Admin</button>
    </form>
@endsection
