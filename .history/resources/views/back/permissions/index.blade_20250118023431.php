@extends('back.master')

@section('title', 'Permissions List')

@section('content')
    <div class="container mt-5">
        <h2>Permissions</h2>
        <a href="{{ route('back.permissions.create') }}" class="btn btn-primary mb-4" style="background-color: #696CFF">Create Permission</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Permission</th>
                    <th>Roles</th>
                    <th>Guard</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ displayPermission($permission->name) }}</td>
                        <td>
                            @foreach ($permission->roles as $role)
                                <span class="badge bg-primary">{{ displayRole($role->name) }}</span>
                            @endforeach
                        </td>
                        @if($permission->guard_name != 'web')
                                    User
                                @elseif ($guard == 'head')
                                    Head Of Department
                                @else
                                    {{ ucwords($guard) }}
                                @endif
                        <td>{{  ? ucwords($permission->guard_name) : 'Student' }}</td>
                        <td>
                            <a href="{{ route('back.permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('back.permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
