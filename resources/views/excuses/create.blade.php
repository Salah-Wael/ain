@extends('layouts.app')

@section('title', __('messages.create') . ' ' . __('messages.excuse'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">{{ __('messages.create') . ' ' . __('messages.excuse') }}</h5>
                    <div class="card-body">
                        <form action="{{ route('excuses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Reason Field -->
                            <div class="mb-3">
                                <label for="reason" class="form-label">{{ __('messages.reason') }}</label>
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
                                <label for="description" class="form-label">{{ __('messages.description') }}</label>
                                <textarea
                                    name="description"
                                    id="description"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Enter additional details (optional)"></textarea>
                            </div>

                            <!-- Material Dropdown -->
                            <div class="mb-3">
                                <label for="material" class="form-label">{{ __('messages.material') }}</label>
                                <select name="material" id="material" class="form-select" required>
                                    <option value="" disabled selected>{{ __('messages.select') .' '. __('messages.material') }}</option>
                                    <option value="Medical Report">{{ __('messages.medical_report') }}</option>
                                    <option value="Medical Examinations">{{ __('messages.medical_examinations') }}</option>
                                    <option value="Passport Photo">{{ __('messages.passport_photo') }}</option>
                                    <option value="Other">{{ __('messages.other') }}</option>
                                </select>
                            </div>

                            <!-- Departments Dropdown -->
                            <div class="mb-3">
                                <label for="department" class="form-label">{{ __('messages.department') }}</label>
                                <select name="department" id="department" class="form-select" required>
                                    <option value="" disabled selected>{{ __('messages.select') . ' ' . __('messages.department') }}</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->name }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Upload Supporting Documents -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <h5 class="card-header">{{ __('messages.upload_supporting_documents') }}</h5>
                                        <div class="card-body demo-vertical-spacing demo-only-element">
                                            <div class="input-group">
                                                <label class="input-group-text" for="inputGroupFile01">{{ __('messages.upload') }}</label>
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
                                    {{ __('messages.create') . ' ' . __('messages.excuse') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
