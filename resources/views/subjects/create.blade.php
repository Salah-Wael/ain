@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Subject</h2>
    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Subject Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Subject Code</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" required>
            @error('code')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="department_id" class="form-label">Department</label>
            <select name="department_id" id="department_id" class="form-select" required>
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Semesters</label>
            <div class="d-flex flex-wrap">
                @foreach($semesters as $semester)
                    <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" name="semester_id[]" id="semester_{{ $semester->id }}"
                            value="{{ $semester->id }}" {{ in_array($semester->id, old('semester_id', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="semester_{{ $semester->id }}">
                            {{ $semester->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('semester_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Academic Years</label>
            <div class="d-flex flex-wrap">
                @foreach($academicYears as $academicYear)
                    <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" name="academic_year_id[]" id="academic_year_{{ $academicYear->id }}"
                            value="{{ $academicYear->id }}" {{ in_array($academicYear->id, old('academic_year_id', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="academic_year_{{ $academicYear->id }}">
                            {{ $academicYear->year }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('academic_year_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Doctors</label>
            <div class="d-flex flex-wrap">
                @foreach($doctors as $doctor)
                    <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" name="doctor_id[]" id="doctor_{{ $doctor->id }}"
                            value="{{ $doctor->id }}" {{ in_array($doctor->id, old('doctor_id', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="doctor_{{ $doctor->id }}">
                            {{ $doctor->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('doctor_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Subject</button>
    </form>
</div>
@endsection
