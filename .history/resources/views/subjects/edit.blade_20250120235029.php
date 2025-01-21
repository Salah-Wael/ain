@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Subject</h2>
    <form action="{{ route('subjects.update', $subject) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Subject Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $subject->name) }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="code" class="form-label">Subject Code</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $subject->code) }}" required>
            @error('code')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="department_id" class="form-label">Department</label>
            <select class="form-select" id="department_id" name="department_id" required>
                <option value="" disabled>Select a department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ $subject->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </select>
            @error('department_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="semester_id" class="form-label">Semester</label>
            <select class="form-select" id="semester_id" name="semester_id" required>
                <option value="" disabled>Select a semester</option>
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ $subject->semester_id == $semester->id ? 'selected' : '' }}>{{ $semester->name }}</option>
                @endforeach
            </select>
            @error('semester_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
