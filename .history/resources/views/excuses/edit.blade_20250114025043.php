@extends('front.master')

@section('title', 'Edit Excuse')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Excuse</div>

                    <div class="card-body">
                        <form action="{{ route('excuses.update', $excuse->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Reason -->
                            <div class="form-group mb-3">
                                <label for="reason">Reason</label>
                                <input type="text" name="reason" id="reason" class="form-control"
                                    value="{{ old('reason', $excuse->reason) }}" required>
                                @error('reason')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $excuse->description) }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Material -->
                            <div class="form-group mb-3">
                                <label for="material">Material</label>
                                <select name="material" id="material" class="form-control" required>
                                    <option value="" disabled>Select material</option>
                                    <option value="Medical Report"
                                        {{ $excuse->material == 'Medical Report' ? 'selected' : '' }}>Medical Report
                                    </option>
                                    <option value="Medical Examinations"
                                        {{ $excuse->material == 'Medical Examinations' ? 'selected' : '' }}>Medical
                                        Examinations</option>
                                    <option value="Passport Photo"
                                        {{ $excuse->material == 'Passport Photo' ? 'selected' : '' }}>Passport Photo
                                    </option>
                                    <option value="Other" {{ $excuse->material == 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('material')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Department -->
                            <div class="form-group mb-3">
                                <label for="department">Department</label>
                                <select name="department" id="department" class="form-control" required>
                                    <option value="" disabled>Select a department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department }}"
                                            {{ $excuse->department && $excuse->department->name === $department ? 'selected' : '' }}>
                                            {{ $department }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Existing Images -->
                            <div class="form-group mb-3">
                                <label>Existing Images</label>
                                <div class="d-flex">
                                    @foreach ($excuse->images as $image)
                                        <div class="me-2">
                                            <img src="{{ asset('excuse-images/' . $image->image_path) }}" alt="Excuse Image"
                                                class="img-thumbnail" width="100">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Upload New Images -->
                            <div class="form-group mb-3">
                                <label for="images">Upload New Images</label>
                                <input type="file" name="images[]" id="images" class="form-control" multiple>
                                <small class="text-muted">You can upload multiple images (Max size: 2MB each).</small>
                                @error('images.*')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Update Excuse</button>
                                <a href="{{ route('excuses.student') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
