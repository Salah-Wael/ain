@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Head of Department</h2>
    <form action="{{ route('head_of_departments.update', $headOfDepartment->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('head_of_departments._form')
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
