@extends('layouts.app')

@section('title', __('messages.departments'))
@section('content')
<div class="container">
    <h2>{{ __('messages.departments') }}</h2>
    <a href="{{ route('departments.create') }}" class="btn btn-success">{{ __('messages.add') }}</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.abbreviation') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
                <tr>
                    <td>{{ $department->id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->abbreviation }}</td>
                    <td>
                        <a href="{{ route('departments.edit', $department) }}" class="btn btn-primary">{{ __('messages.edit') }}</a>
                        <form action="{{ route('departments.destroy', $department) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
