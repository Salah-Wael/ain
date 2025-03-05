@extends('layouts.app')


@section('title', __('messages.register_subjects'))
@section('content')
<div class="container">
    <h2 class="mb-4">{{ __('messages.register_subjects') }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subjects.student.register') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('messages.select') }}</th>
                    <th>{{ __('messages.subject_name') }}</th>
                    <th>{{ __('messages.department') }}</th>
                    <th>{{ __('messages.doctors') }}</th>
                    <th>{{ __('messages.semesters') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                    <tr>
                        <td>
                            <input type="checkbox" name="subject_id[]" value="{{ $subject->id }}"
                                {{ (is_array(old('subject_id')) && in_array($subject->id, old('subject_id'))) ? 'checked' : '' }}>
                        </td>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->department->name ?? 'N/A' }}</td>
                        <td>
                            @foreach($subject->doctors as $doctor)
                                {{ $doctor->name }}@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($subject->semesters as $semester)
                                {{ $semester->name }}@if(!$loop->last), @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">{{ __('messages.register') }}</button>
    </form>
</div>
@endsection
