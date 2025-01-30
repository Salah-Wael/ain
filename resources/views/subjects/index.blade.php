@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Subjects</h2>
    @role('Super-Admin', 'admin')
        <a href="{{ route('subjects.create') }}" class="btn btn-primary mb-3">Create New Subject</a>
    @endrole
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Department</th>
                <th>Semester</th>
                <th>Academic Year</th>
                @role('Super-Admin', 'admin')<th>Actions</th>@endrole
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->code }}</td>
                    <td>{{ $subject->department->name }}</td>
                    <td>{{ $subject->semester->name }}</td>
                    <td>{{ $subject->academicYear->year }}</td>
                    @role('Super-Admin', 'admin')
                    <td>
                        <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this subject?')">Delete</button>
                        </form>
                    </td>
                    @endrole
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
