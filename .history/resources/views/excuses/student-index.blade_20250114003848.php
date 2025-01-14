@extends('front.master')

@section('title', 'Excuses')

@section('content')
    <div class="container">
        <h2>Excuses</h2>
        <a href="{{ route('excuses.create') }}" class="btn btn-primary mb-3">Create Excuse</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Material</th>
                    <th>Material Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($excuses as $excuse)
                    <tr>
                        <td>{{ $excuse->student->id }}</td>
                        <td>{{ $excuse->student->name }}</td>
                        <td>{{ $excuse->reason }}</td>
                        <td>
                            <a  class="btn btn-info btn-sm">View</a>
                            <a  class="btn btn-warning btn-sm">Edit</a>
                            <a  class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('excuses.destroy', $excuse) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                        <td>{{ $excuse->material }}</td>
                        <td>
                            @foreach ($excuse->images as $image)
                                <img src="{{ asset('excuse-images/' . $image->image_path) }}" alt="Material Image" style="width: 100px; height: auto;">
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('excuses.show', $excuse) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('excuses.edit', $excuse) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('excuses.destroy', $excuse) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
