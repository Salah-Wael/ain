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

                            <!-- Reason Field -->
                            <div class="mb-3">
                                <label for="reason" class="form-label">Reason</label>
                                <input
                                    type="text"
                                    name="reason"
                                    id="reason"
                                    class="form-control"
                                    placeholder="Enter the reason"
                                    required>
                            </div>

                            <!-- Description Field -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea
                                    name="description"
                                    id="description"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Enter additional details (optional)"></textarea>
                            </div>

                            <!-- Material Dropdown -->
                            <div class="mb-3">
                                <label for="material" class="form-label">Material</label>
                                <select name="material" id="material" class="form-select" required>
                                    <option value="" disabled selected>Select material type</option>
                                    <option value="Medical Report">Medical Report</option>
                                    <option value="Medical Examinations">Medical Examinations</option>
                                    <option value="Passport Photo">Passport Photo</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <!-- Departments Dropdown -->
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <select name="department" id="department" class="form-select" required>
                                    <option value="" disabled selected>Select a department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->name }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Upload Supporting Documents -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <h5 class="card-header">Upload Supporting Documents</h5>
                                        <div class="card-body demo-vertical-spacing demo-only-element">
                                            <div class="input-group">
                                                <label class="input-group-text" for="inputGroupFile01">Upload</label>
                                                <input
                                                    type="file"
                                                    name="images[]"
                                                    class="form-control"
                                                    id="inputGroupFile01"
                                                    multiple
                                                    required>
                                            </div>
                                            <small class="text-muted mt-2">You can upload multiple files (Max: 2MB each).</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-4">
                                <button
                                    type="submit"
                                    class="btn btn-outline-primary"
                                    id="create_excuse">
                                    Create Excuse
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
