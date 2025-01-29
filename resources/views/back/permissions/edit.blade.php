@extends('layouts.app')

@section('title', 'Edit Permission')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Edit Permission</h2>
            <a href="{{ route('back.permissions.index') }}" class="btn btn-primary" style="background-color: #696CFF">Show All Permissions</a>
        </div>

        <form action="{{ route('back.permissions.update', $permission->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Use PUT method for updating the permission -->

            <div class="mb-3">
                <label for="name" class="form-label">Permission Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name',displayPermission($permission->name)) }}" required>
            </div>

            <label for="guard_name" class="form-label">Guard Name</label>
            @foreach ($guardsArray as $guard)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="guard_name" value="{{ $guard }}" id="guard_name_{{ $guard }}"
                        @if($permission->guard_name == $guard) checked @endif required>
                    <label class="form-check-label" for="guard_name_{{ $guard }}">
                        @if($guard == 'web')
                            Student
                        @elseif ($guard == 'head')
                            Head Of Department
                        @else
                            {{ ucwords($guard) }}
                        @endif
                    </label>
                </div>
            @endforeach

            <div class="mt-3">
                <button type="submit" class="btn btn-primary" style="background-color: #696CFF">Update Permission</button>
                <a href="{{ route('back.permissions.index') }}" class="btn btn-secondary" style="margin-left: 10px;">Cancel</a>
            </div>
        </form>
    </div>
@endsection
