@extends('front.master')

@section('title', 'Create Excuse')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Create Excuse</h5>
                    <div class="card-body">
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

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <h5 class="card-header">Upload Supporting Documents</h5>
                                        <div class="card-body demo-vertical-spacing demo-only-element">
                                            <div class="input-group">
                                                <label class="input-group-text" for="inputGroupFile01">Upload</label>
                                                <input type="file" name="images[]" class="form-control"
                                                    id="inputGroupFile01" multiple />
                                            </div>
                                            <div class="mt-3">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-outline-primary" type="button"id="create_more">Add More Files</button>
                                <button type="submit" class="btn btn-success">Create Excuse</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
