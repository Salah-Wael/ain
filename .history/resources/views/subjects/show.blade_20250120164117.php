@if (Auth::guard('admin')->check())
    @extends('back.master')
@elseif (Auth::guard('web')->check())
    @extends('front.master')
@elseif (Auth::guard('head')->check())
    @extends('head.master')
@elseif (Auth::guard('doctor')->check())
    @extends('doctor.master')
@else
    @extends('layouts.app')
@endif

@section('content')
<div class="container">
    <h2>Subject Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name: {{ $subject->name }}</h5>
            <p class="card-text"><strong>Code:</strong> {{ $subject->code }}</p>
            <p class="card-text"><strong>Semester:</strong> {{ $subject->semester->name }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $subject->created_at->format('d-m-Y H:i') }}</p>
            <p class="card-text"><strong>Updated At:</strong> {{ $subject->updated_at->format('d-m-Y H:i') }}</p>

            <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('subjects.destroy', $subject) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
            <a href="{{ route('subjects.index') }}" class="btn btn-primary btn-sm">Back to List</a>
        </div>
    </div>
</div>
@endsection
