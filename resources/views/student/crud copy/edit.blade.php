@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Subjects for {{ $student->name }}</h1>
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="subject_id" class="form-label">Subjects</label>
            <select name="subject_id[]" id="subject_id" class="form-control" multiple>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}"
                        @if(in_array($subject->id, $assignedSubjects)) selected @endif>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
