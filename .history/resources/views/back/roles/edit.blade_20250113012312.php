@extends('back.master')
@section('title', __('lang.edit_role'))
@section('roles_active', 'active bg-light')
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.edit_role') }}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('back.roles.update', $role->id) }}" method="post" id="edit_form" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- For updating the role --}}

                <div id="edit_form_messages"></div>

                <div class="row">
                    <!-- Role Name -->
                    <div class="form-group col-md-10">
                        <label class="form-label">{{ __('lang.name') }}</label>
                        <input type="text" class="border form-control" name="name" value="{{ old('name', displayRole($role->name)) }}"
                            placeholder="{{ __('lang.please_enter') }} {{ __('lang.name') }}...">
                    </div>

                    <!-- Select All Checkbox -->
                    <div class="form-group col-md-2 mt-4">
                        <label class="form-check-label text-primary mt-2">
                            <input class="form-check-input" type="checkbox" id="selectAll">
                            @lang('lang.selectAll')
                        </label>
                    </div>

                    <!-- Guard Name -->
                    <label for="guard_name" class="form-label">Guard Name</label>
                    @foreach ($guardsArray as $guard)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="guard_name" value="{{ $guard }}" id="guard_name_{{ $guard }}"
                                @if($guard == $role->guard_name) checked @endif required>
                            <label class="form-check-label" for="guard_name_{{ $guard }}">
                                @if($guard != 'web') {{ ucwords(str_replace('-', ' ', $guard)) }} @else User @endif
                            </label>
                        </div>
                    @endforeach

                    <!-- Permissions -->
                    <div class="form-group col-12 mt-2">
                        <div class="row">
                            @if (count($groups) > 0)
                                @foreach ($groups as $permission)
                                    <div class="col-md-6">
                                        <div class="form-check form-check-primary mt-1">
                                            <input class="form-check-input" type="checkbox"
                                                name="permissionArray[{{ $permission->name }}]"
                                                id="formCheckcolor{{ $permission->id }}"
                                                @if($role->permissions->contains($permission->id)) checked @endif>
                                            <label class="form-check-label"
                                                for="formCheckcolor{{ $permission->id }}">{{ displayPermission($permission->name) }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group float-end mt-3">
                    <button type="submit" class="btn btn-primary" id="submit_edit_form">{{ __('lang.submit') }}</button>
                </div>

            </form>
        </div>
    </div>

@endsection

@includeIf("$directory.scripts")
@includeIf("$directory.pushScripts")
