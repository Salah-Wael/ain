@extends('layouts.app')

@section('title', __('messages.list') . ' ' . __('messages.excuses'))

@section('content')
    <div class="container">
        <h2>{{ __('messages.list') }} {{ __('messages.excuses') }}</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('messages.student_id') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.reason') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.material') }}</th>
                    <th>{{ __('messages.material_images') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($excuses as $excuse)
                    <tr>
                        <td>{{ $excuse->student->id }}</td>
                        <td>{{ $excuse->student->name }}</td>
                        <td>{{ $excuse->reason }}</td>
                        <td>
                            <a class="btn btn-warning btn-sm">{{ __('messages.pending') }}</a>
                        </td>
                        <td>{{ $excuse->material }}</td>
                        <td style="display: flex; gap: 10px; overflow-x: auto; align-items: center;">
                            @foreach ($excuse->images as $image)
                                <a href="{{ asset('excuse-images/' . $image->image_path) }}" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $loop->index }}">
                                    <img src="{{ asset('excuse-images/' . $image->image_path) }}" alt="Material Image" class="img-thumbnail" style="width: 80px; height: 125px; cursor: pointer;">
                                </a>

                                <!-- Modal لعرض الصورة بالحجم الكامل -->
                                <div class="modal fade" id="imageModal-{{ $loop->index }}" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ __('messages.material_images') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('excuse-images/' . $image->image_path) }}" alt="Material Image" class="img-fluid">
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ asset('excuse-images/' . $image->image_path) }}" download class="btn btn-primary">
                                                    {{ __('messages.download') }}
                                                </a>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </td>

                        <td>
                            <form action="{{ route('excuses.update-status', $excuse) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-info btn-sm">{{ __('messages.approved') }}</button>
                            </form>

                            <form action="{{ route('excuses.update-status', $excuse->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('messages.rejected') }}</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $excuses->links() }}
    </div>
@endsection
