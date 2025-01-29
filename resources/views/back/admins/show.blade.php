@extends('layouts.app')

@section('title', 'Admin Details')

@section('content')
    <h2>Admin Details</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $admin->name }}</p>
            <p><strong>Email:</strong> {{ $admin->email }}</p>
            <p><strong>Roles:</strong> {{ $admin->roles->pluck('name')->implode(', ') }}</p>
        </div>
    </div>

    <a href="{{ route('back.admins.index') }}" class="btn btn-secondary">Back</a>
@endsection
