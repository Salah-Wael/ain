@extends('layouts.app')

@section('title', __('messages.create') .' '. __('messages.permission'))

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ __('messages.create') .' '. __('messages.permission')}}</h2>
            <a href="{{ route('back.permissions.index') }}" class="btn btn-primary" style="background-color: #696CFF">{{ __('messages.list').' '.__('messages.permissions') }}</a>
        </div>

        {{-- Display Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('back.permissions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('messages.name') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
                {{-- Show specific error for 'name' --}}
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-12 mt-2">
                <div class="row">
                    @forelse ($roles as $role)
                        <div class="col-md-6">
                            <div class="form-check form-check-primary mt-1">
                                <input class="form-check-input @error('roleArray') is-invalid @enderror" type="checkbox"
                                    name="roleArray[{{ $role->guard_name }}]"
                                    id="formCheckcolor{{ $role->id }}"
                                    {{ old("roleArray.$role->guard_name") ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="formCheckcolor{{ $role->id }}">{{ displayRole($role->name) }}</label>
                            </div>
                        </div>
                    @empty
                        <p>{{ __('messages.not_found') }}</p>
                    @endforelse
                </div>
                {{-- Show specific error for 'roleArray' --}}
                @error('roleArray')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary" style="background-color: #696CFF">{{ __('messages.create') }}</button>
                <a href="{{ route('back.permissions.index') }}" class="btn btn-secondary" style="margin-left: 10px;">{{ __('messages.cancel') }}</a>
            </div>
        </form>
    </div>
@endsection
