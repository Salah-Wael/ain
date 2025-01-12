@extends('back.master')

@section('title', 'Admins List')

@section('content')
    <h2>Admins List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('back.admins.create') }}" class="btn btn-primary">Create Admin</a>

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        @forelse ($admin->roles as $role)
                            <span class="badge bg-primary">{{ displayRole($role->name) }}</span>
                        @empty

                        @endforelse
                    </td>



                    <td>
                        <a href="{{ route('back.admins.edit', $admin->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('back.admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
