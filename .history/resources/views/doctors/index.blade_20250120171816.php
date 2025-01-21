@extends('layouts.app')

@section('content')
<h1>Doctors</h1>
<a href="{{ route('doctors.create') }}" class="btn btn-primary">Add Doctor</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Subjects</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($doctors as $doctor)
        <tr>
            <td>{{ $doctor->id }}</td>
            <td>{{ $doctor->name }}</td>
            <td>{{ $doctor->email }}</td>
            <td>{{ $doctor->department->name }}</td>
            <td>
                @foreach ($doctor->subjects as $subject)
                {{ $subject->name }},
                @endforeach
            </td>
            <td>
                <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
