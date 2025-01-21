@if (Auth::guard('admin')->check())

@elseif (Auth::guard('web')->check())

@elseif (Auth::guard('head')->check())

@elseif (Auth::guard('doctor')->check())

@endif
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Subject</h1>

    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="code" id="code" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="semester_id">Semester</label>
            <select name="semester_id" id="semester_id" class="form-control" required>
                <option value="">Select Semester</option>
                @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
