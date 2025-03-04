@extends('layouts.app')

@section('title', __('messages.list') . ' ' . __('messages.excuses'))

@section('content')
    <div class="container">
        <h2>{{ __('messages.list') }} {{ __('messages.excuses') }}</h2>
        <a href="{{ route('excuses.create') }}" class="btn btn-primary mb-3">{{ __('messages.create') }}</a>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('messages.student_id') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.reason') }}</th>
                    <th>{{ __('messages.department') }}</th>
                    <th>{{ __('messages.material') }}</th>
                    <th>{{ __('messages.material_images') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($excuses as $excuse)
                    <tr>
                        <td>{{ $excuse->student->id }}</td>
                        <td>{{ $excuse->student->name }}</td>
                        <td>{{ $excuse->reason }}</td>
                        <td>{{ $excuse->department->name }}</td>
                        <td>{{ $excuse->material }}</td>
                        <td>
                            @foreach ($excuse->images as $image)
                                <img src="{{ asset('excuse-images/' . $image->image_path) }}" alt="Material Image" style="width: 100px; height: auto;">
                            @endforeach
                        </td>
                        <td>
                            @if ($excuse->status === 'approved')
                                <a class="btn btn-info btn-sm">{{ __('messages.approved') }}</a>
                            @elseif ($excuse->status === 'pending')
                                <a class="btn btn-warning btn-sm">{{ __('messages.pending') }}</a>
                            @elseif ($excuse->status === 'rejected')
                                <a class="btn btn-danger btn-sm">{{ __('messages.rejected') }}</a>
                            @endif
                        </td>
                        <td>
                            @if ($excuse->status === 'pending')
                                <a href="{{ route('excuses.edit', $excuse) }}" class="btn btn-warning btn-sm">{{ __('messages.edit') }}</a>
                                <form action="{{ route('excuses.destroy', $excuse) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">{{ __('messages.delete') }}</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
