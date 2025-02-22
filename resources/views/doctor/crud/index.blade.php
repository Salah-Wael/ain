@extends('layouts.app')

@section('content')
<h2>{{ __('messages.list') .' '. __('messages.doctors')}}</h2>
<a href="{{ route('doctors.create') }}" class="btn btn-primary">{{ __('messages.add') .' '. __('messages.doctor') }}</a>
<table class="table">
    <thead>
        <tr>
            <th>{{ __('messages.doctor_id') }}</th>
            <th>{{ __('messages.name') }}</th>
            <th>{{ __('messages.email') }}</th>
            <th>{{ __('messages.department') }}</th>
            <th>{{ __('messages.subjects') }}</th>
            <th>{{ __('messages.actions') }}</th>
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
                <div style="display: flex; gap: 5px;">
                    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning btn-sm">
                        {{ __('messages.edit') }}
                    </a>
                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            {{ __('messages.delete') }}
                        </button>
                    </form>
                </div>
            </td>
            
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
