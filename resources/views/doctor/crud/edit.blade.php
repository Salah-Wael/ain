@extends('layouts.app')

@section('title', __('messages.edit') . ' ' . __('messages.doctor'))

@section('content')
<div class="container">
    <h2>{{ __('messages.edit') }} {{ __('messages.doctor') }}</h2>
    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- To indicate this is a PUT request -->

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('messages.name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $doctor->name) }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $doctor->email) }}">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('messages.password') }}</label>
            <input type="password" class="form-control" id="password" name="password">
            <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="department_id" class="form-label">{{ __('messages.department') }}</label>
            <select class="form-select" id="department_id" name="department_id" required>
                <option value="" disabled>{{ __('messages.select') . ' ' . __('messages.department') }}</option>

                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ old('department_id', $doctor->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="subjects" class="form-label">{{ __('messages.subjects') }}</label>
            <select class="form-select" id="subjects" name="subjects[]" multiple required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}"
                        {{ in_array($subject->id, old('subjects', $doctor->subjects->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Hold down Ctrl (Windows) or Command (Mac) to select multiple subjects.</small>
            @error('subjects')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
    </form>
</div>
@endsection
