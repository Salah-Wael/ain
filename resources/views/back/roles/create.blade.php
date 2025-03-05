@extends('layouts.app')
@section('title', __('messages.add_new_role'))
@section('roles_active', 'active bg-light')
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('messages.add_new_role') }}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('back.roles.store') }}" method="post" id="add_form" enctype="multipart/form-data">
                @csrf

                <div id="add_form_messages"></div>

                {{-- MODIFICATIONS FROM HERE --}}
                <div class="row">

                    <div class="form-group col-md-10">
                        <label class="form-label">{{ __('messages.name') }}</label>
                        <input type="text" class="border form-control" name="name"
                            placeholder="{{ __('messages.please_enter') }} {{ __('messages.name') }}...">
                    </div>
                    <div class="form-group col-md-2 mt-4">
                        <label class="form-check-label text-primary mt-2">
                            <input class="form-check-input" type="checkbox" id="selectAll">
                            @lang('messages.selectAll')
                        </label>
                    </div>

                    <label for="guard_name" class="form-label">{{ __('messages.guard_name') }}</label>
                    @foreach ($guardsArray as $guard)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="guard_name" value="{{ $guard }}" id="guard_name_{{ $guard }}"
                                @if($guard == 'admin') checked @endif required>
                            <label class="form-check-label" for="guard_name_{{ $guard }}">
                                @if($guard == 'web')
                                    {{ __('messages.student') }}
                                @elseif ($guard == 'head')
                                    {{ __('messages.head_of_department') }}
                                @else
                                    {{ ucwords($guard) }}
                                @endif
                            </label>
                        </div>
                    @endforeach

                    <div class="form-group col-12 mt-2">
                        <div class="row">
                            @if (count($groups) > 0)
                                @foreach ($groups as $permission)
                                    <div class="col-md-6">
                                        <div class="form-check form-check-primary mt-1">
                                            <input class="form-check-input" type="checkbox"
                                                name="permissionArray[{{ $permission->name }}]"
                                                id="formCheckcolor{{ $permission->id }}">
                                            <label class="form-check-label"
                                                for="formCheckcolor{{ $permission->id }}">{{ ucwords(str_replace('_', ' ', $permission->name)) }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>
                {{-- MODIFICATIONS TO HERE --}}

                <div class="form-group float-end mt-3">
                    <button type="submit" class="btn btn-primary" id="submit_add_form">{{ __('messages.save') }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@includeIf("$directory.scripts")
@includeIf("$directory.pushScripts")
