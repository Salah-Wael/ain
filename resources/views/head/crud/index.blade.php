@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ __('messages.list') }} {{ __('messages.head_of_departments') }}</h2>
    <a href="{{ route('head_of_departments.create') }}" class="btn btn-primary mb-3">{{ __('messages.add') }} {{ __('messages.head_of_department') }}</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.department') }}</th>
                <th>{{ __('messages.actions') }}</th>
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
                        <a href="{{ route('head_of_departments.edit', $head->id) }}" class="btn btn-warning btn-sm">{{ __('messages.edit') }}</a>
                        <form action="{{ route('head_of_departments.destroy', $head->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">{{ __('messages.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
