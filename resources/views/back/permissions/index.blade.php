@extends('layouts.app')

@section('title', __('messages.permissions') )

@section('content')
    <div class="container mt-5">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2>Permissions</h2>
        <a href="{{ route('back.permissions.create') }}" class="btn btn-primary mb-4" style="background-color: #696CFF">Create Permission</a>

        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('messages.permission') }}</th>
                    <th>{{ __('messages.roles') }}</th>
                    <th>{{ __('messages.guard_name') }}</th>
                    <th>{{ __('messages.actions') }}</th>
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
                        @if($permission->guard_name == 'web')
                                    <td>
                                        Student
                                    </td>
                                @elseif ($permission->guard_name == 'head')
                                    <td>
                                        Head Of Department
                                    </td>
                                @else
                                    <td>
                                        {{ ucwords($permission->guard_name) }}
                                    </td>
                                @endif
                        <td>
                            <form action="{{ route('back.permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">{{ __('messages.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
