@extends('front.master')

@section('title', 'Create Excuse')

@section('content')
    <div class="container">
        <h1>Create Excuse</h1>
        <form action="{{ route('excuses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="reason" class="form-label">Reason</label>
                <input type="text" name="reason" id="reason" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="material" class="form-label">Material</label>
                <select name="material" id="material" class="form-select" required>
                    <option value="Medical Report">Medical Report</option>
                    <option value="Medical Examinations">Medical Examinations</option>
                    <option value="Passport Photo">Passport Photo</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Images</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection
