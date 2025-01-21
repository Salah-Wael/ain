@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Head of Department</h2>
    <form action="{{ route('head_of_departments.store') }}" method="POST">
        @csrf
        @include('head_of_departments._form')
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
