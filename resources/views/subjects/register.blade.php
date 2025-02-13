@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Register for Subjects</h2>

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
                    <th>Select</th>
                    <th>Subject Name</th>
                    <th>Department</th>
                    <th>Doctor(s)</th>
                    <th>Semester</th>
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

        <button type="submit" class="btn btn-primary">Register Selected Subjects</button>
    </form>
</div>
@endsection
