@extends('front.master')

@section('title', 'Excuses')

@section('content')
    <div class="container">
        <h2>Excuses</h2>
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
                            <a class="btn btn-warning btn-sm">Pending</a>
                        </td>
                        <td>{{ $excuse->material }}</td>
                        <td>
                            @foreach ($excuse->images as $image)
                                <img src="{{ asset('excuse-images/' . $image->image_path) }}" alt="Material Image" style="width: 100px; height: auto;">
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('excuses.update-status', $excuse) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-info btn-sm">Approve</button>
                            </form>

                        <form action="{{ route('excuses.update-status', $excuse) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $excuses->links() }}
    </div>
@endsection
