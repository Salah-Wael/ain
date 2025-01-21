@extends('back.master')

@section('title', 'Create Permission')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Create Permission</h2>
            <a href="{{ route('back.permissions.index') }}" class="btn btn-primary" style="background-color: #696CFF">Show All Permissions</a>
        </div>

        <form action="{{ route('back.permissions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Permission Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <label for="guard_name" class="form-label">Guard Name</label>
            @foreach ($guardsArray as $guard)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="guard_name" value="{{ $guard }}" id="guard_name_{{ $guard }}" required>
                    <label class="form-check-label" for="guard_name_{{ $guard }}">
                        @if($guard == 'web')
                                    User
                        @elseif ($guard == 'head')
                            Head Of Department
                        @else
                        {{ disp }}
                            {{ ucwords($guard) }}
                        @endif
                    </label>
                </div>
            @endforeach

            <div class="form-group col-12 mt-2">
                <div class="row">
                    @forelse ($roles as $role)
                        <div class="col-md-6">
                            <div class="form-check form-check-primary mt-1">
                                <input class="form-check-input" type="checkbox"
                                    name="roleArray[{{ $role->name }}]"
                                    id="formCheckcolor{{ $role->name }}">
                                <label class="form-check-label"
                                    for="formCheckcolor{{ $role->name }}">{{ displayRole($role->name) }}</label>
                            </div>
                        </div>
                    @empty
                        <p>No roles found.</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary" style="background-color: #696CFF">Create Permission</button>
                <a href="{{ route('back.permissions.index') }}" class="btn btn-secondary" style="margin-left: 10px;">Cancel</a>
            </div>

        </form>
    </div>
@endsection
