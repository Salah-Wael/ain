@extends('layouts.app')

@section('title', __('messages.list') . ' ' . __('messages.subjects'))

@section('content')
<div class="container">
    <h2>{{ __('messages.list') }} {{ __('messages.subjects') }}</h2>

    @hasanyrole('Super-Admin|Admin', 'admin')
        <a href="{{ route('subjects.create') }}" class="btn btn-primary mb-3">Create New Subject</a>
    @endhasanyrole

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>{{ __('messages.subject_name') }}</th>
                <th>{{ __('messages.subject_code') }}</th>
                <th>{{ __('messages.department') }}</th>
                <th>{{ __('messages.semesters') }}</th>
                <th>{{ __('messages.academic_years') }}</th>
                <th>{{ __('messages.doctors') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->code }}</td>
                    <td>{{ $subject->department->name ?? 'N/A' }}</td>
                    <td>{{ $subject->semesters->pluck('name')->join(', ') ?: 'N/A' }}</td>
                    <td>{{ $subject->academicYears->pluck('year')->join(', ') ?: 'N/A' }}</td>
                    <td>{{ $subject->doctors->pluck('name')->join(', ') ?: 'N/A' }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-info btn-sm">{{ __('messages.show') }}</a>
                            @hasanyrole('Super-Admin|Admin', 'admin')
                                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-warning btn-sm">{{ __('messages.edit') }}</a>
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this subject?')">
                                        {{ __('messages.delete') }}
                                    </button>
                                </form>
                            @endhasanyrole
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
