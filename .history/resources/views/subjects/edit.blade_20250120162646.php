@if (Auth::guard('admin')->check())
    @extends('back.master')
@elseif (Auth::guard('web')->check())
    @extends('front.master')
@elseif (Auth::guard('head')->check())
    @extends('head.master')
@elseif (Auth::guard('doctor')->check())
    @extends('doctor.master')
@else
    @extends(view: 'layouts.app')
@endif

@section('content')
<div class="container">
    <h2>Edit Subject</h2>

    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $subject->name }}" required>
        </div>

        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ $subject->code }}" required>
        </div>

        <div class="form-group">
            <label for="semester_id">Semester</label>
            <select name="semester_id" id="semester_id" class="form-control" required>
                <option value="">Select Semester</option>
                @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ $semester->id == $subject->semester_id ? 'selected' : '' }}>
                        {{ $semester->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
