@extends('back.master')

@section('title', 'Create Admin')

@section('content')
    <h2>Create Admin</h2>

    <form action="{{ route('back.admins.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="roles">Assign Roles</label>
            <select name="roleArray[]" class="form-control" multiple>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Admin</button>
    </form>
@endsection
