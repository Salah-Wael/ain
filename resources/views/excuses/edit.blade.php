@extends('layouts.app')

@section('title', __('messages.edit') . ' ' . __('messages.excuse'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('messages.edit') . ' ' . __('messages.excuse') }}</div>

                    <div class="card-body">
                        <form action="{{ route('excuses.update', $excuse->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Reason -->
                            <div class="form-group mb-3">
                                <label for="reason">{{ __('messages.reason') }}</label>
                                <input type="text" name="reason" id="reason" class="form-control"
                                    value="{{ old('reason', $excuse->reason) }}" required>
                                @error('reason')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group mb-3">
                                <label for="description">{{ __('messages.description') }}</label>
                                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $excuse->description) }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Material -->
                            <div class="form-group mb-3">
                                <label for="material">{{ __('messages.material') }}</label>
                                <select name="material" id="material" class="form-control" required>
                                    <option value="Medical Report"
                                        {{ $excuse->material == 'Medical Report' ? 'selected' : '' }}>{{ __('messages.medical_report') }}
                                    </option>
                                    <option value="Medical Examinations"
                                        {{ $excuse->material == 'Medical Examinations' ? 'selected' : '' }}>{{ __('messages.medical') }}
                                        Examinations</option>
                                    <option value="Passport Photo"
                                        {{ $excuse->material == 'Passport Photo' ? 'selected' : '' }}>{{ __('messages.passport_photo') }}
                                    </option>
                                    <option value="Other" {{ $excuse->material == 'Other' ? 'selected' : '' }}>{{ __('messages.other') }}
                                    </option>
                                </select>
                                @error('material')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Department -->
                            <div class="form-group mb-3">
                                <label for="department">{{ __('messages.department') }}</label>
                                <select name="department" id="department" class="form-control" required>
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
                                <label>{{ __('messages.existing_images') }}</label>
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
                                <label for="images">{{ __('messages.upload_new_images') }}</label>
                                <input type="file" name="images[]" id="images" class="form-control" multiple>
                                <small class="text-muted">You can upload multiple images (Max size: 2MB each).</small>
                                @error('images.*')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                                <a href="{{ route('excuses.student') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
