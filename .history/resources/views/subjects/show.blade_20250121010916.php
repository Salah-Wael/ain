@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Subject Details</h2>
    <p><strong>Name:</strong> {{ $subject->name }}</p>
    <p><strong>Code:</strong> {{ $subject->code }}</p>
    <p><strong>Department:</strong> {{ $subject->department->name }}</p>
    <p><strong>Semester:</strong> {{ $subject->semester->name }}</p>
    <p><strong>Academic Year:</strong> {{ $subject->academicYear->year }}</p>

    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
