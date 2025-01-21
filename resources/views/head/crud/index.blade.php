@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Heads of Departments</h2>
    <a href="{{ route('head_of_departments.create') }}" class="btn btn-primary mb-3">Add Head of Department</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($headsOfDepartments as $head)
                <tr>
                    <td>{{ $head->id }}</td>
                    <td>{{ $head->name }}</td>
                    <td>{{ $head->email }}</td>
                    <td>{{ $head->department->name }}</td>
                    <td>
                        <a href="{{ route('head_of_departments.edit', $head->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('head_of_departments.destroy', $head->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
