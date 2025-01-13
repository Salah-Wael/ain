@extends('front.master')

@section('title', 'Create Excuse')

@section('content')
    <div class="container">
        <h1>Excuses</h1>
        <a href="{{ route('excuses.create') }}" class="btn btn-primary mb-3">Create Excuse</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Reason</th>
                    <th>Student</th>
                    <th>Status</th>
                    <th>Material</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($excuses as $excuse)
                    <tr>
                        <td>{{ $excuse->id }}</td>
                        <td>{{ $excuse->reason }}</td>
                        <td>{{ $excuse->student->name }}</td>
                        <td>{{ $excuse->status }}</td>
                        <td>{{ $excuse->material }}</td>
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
        {{ $excuses->links() }}
    </div>
@endsection
