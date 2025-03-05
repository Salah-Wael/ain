@extends('layouts.app')


@section('title', __('messages.edit') . ' ' . __('messages.subject'))
@section('content')
<div class="container">
    <h2>{{ __('messages.edit') }} {{ __('messages.subject') }}</h2>
    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('messages.subject_name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $subject->name) }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">{{ __('messages.subject_code') }}</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $subject->code) }}" required>
            @error('code')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="department_id" class="form-label">{{ __('messages.department') }}</label>
            <select name="department_id" id="department_id" class="form-select" required>
                <option value="">{{ __('messages.select') . ' ' . __('messages.department') }}</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id', $subject->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.semesters') }}</label>
            <div class="d-flex flex-wrap">
                @foreach($semesters as $semester)
                    <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" name="semester_id[]" value="{{ $semester->id }}"
                            {{ in_array($semester->id, old('semester_id', $subject->semesters->pluck('id')->toArray())) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $semester->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('semester_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.academic_years') }}</label>
            <div class="d-flex flex-wrap">
                @foreach($academicYears as $academicYear)
                    <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" name="academic_year_id[]" value="{{ $academicYear->id }}"
                            {{ in_array($academicYear->id, old('academic_year_id', $subject->academicYears->pluck('id')->toArray())) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $academicYear->year }}</label>
                    </div>
                @endforeach
            </div>
            @error('academic_year_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.doctors') }}</label>
            <div class="d-flex flex-wrap">
                @foreach($doctors as $doctor)
                    <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" name="doctor_id[]" value="{{ $doctor->id }}"
                            {{ in_array($doctor->id, old('doctor_id', $subject->doctors->pluck('id')->toArray())) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $doctor->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('doctor_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
    </form>
</div>
@endsection
