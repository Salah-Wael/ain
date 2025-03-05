@extends('layouts.app')

@section('title', 'Admins List')

@section('content')
    <h2>{{ __('messages.list') }}{{ __('messages.admins') }}</h2>

    <a href="{{ route('back.admins.create') }}" class="btn btn-primary">{{ __('messages.create') }} {{ __('messages.admin') }}</a>

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.roles') }}</th>
                <th>{{ __('messages.actions') }}</th>
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
                        <a href="{{ route('back.admins.edit', $admin->id) }}" class="btn btn-info">{{ __('messages.edit') }}</a>
                        <form action="{{ route('back.admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">{{ __('messages.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
