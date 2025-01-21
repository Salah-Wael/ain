@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Subject Details</h2>
    <div class="card">
        <div class="card-header">
            <h3>{{ $subject->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Code:</strong> {{ $subject->code }}</p>
            <p><strong>Department:</strong> {{ $subject->department->name }}</p>
            <p><strong>Semester:</strong> {{ $subject->semester->name }}</p>
            <p><strong>Created At:</strong> {{ $subject->created_at->format('d M Y, h:i A') }}</p>
            <p><strong>Last Updated:</strong> {{ $subject->updated_at->format('d M Y, h:i A') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
