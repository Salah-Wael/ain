@extends('back.master')
@section('title', __('lang.roles'))
@section('roles_active', 'active bg-light')
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('lang.roles') }}</h2>

                <div class="page-title-right">
                    {{-- @if (permission(['add_roles'])) --}}
                    <a href="{{ route('back.roles.create') }}" class="btn btn-primary">
                        {{ __('lang.add_new') }}
                    </a>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card mt-3" id="mainCont">
        <div class="card-body">

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table align-middle table-nowrap font-size-14">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-primary" width="5%">#</th>
                            <th class="text-primary">{{ __('lang.name') }}</th>
                            <th class="text-primary">{{ __('lang.can') }}</th>
                            <th class="text-primary">{{ __('lang.permissions') }}</th>
                            <th class="text-primary" width="11%">{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($data['data'] as $key => $item)
                            <tr>
                                <td>{{ $data['data']->firstItem() + $loop->index }}</td>
                                <td>{{ displayRole($item->name) }}</td>
                                <td>can</td>
                                <td>
                                    @foreach ($item->permissions as $permission)
                                        <span class="badge bg-primary">{{ displayPermission($permission->name) }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group">

                                            {{-- @if (permission(['edit_roles'])) --}}
                                            <a href="{{ route('back.roles.edit', ['role' => $item]) }}"
                                                class="btn btn-sm btn-warning">
                                                {{-- <span class="bx bx-edit-alt"></span> --}}
                                                {{ __('lang.edit') }}
                                            </a>
                                            {{-- @endif --}}

                                            {{-- @if (permission(['delete_roles'])) --}}
                                            <form action="{{ route('back.roles.destroy', ['role' => $item]) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">{{ __('lang.delete') }}</button>
                                            </form>
                                            {{-- @endif --}}

                                    </div>
                                </td>
                            </tr>
                        @empty
                            No Roles
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $data['data']->appends(request()->query())->render('pagination::bootstrap-4') }}

        </div>
    </div>
@endsection

@includeIf("$directory.scripts")
@includeIf("$directory.pushScripts")
