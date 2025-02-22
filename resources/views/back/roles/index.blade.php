@extends('layouts.app')
@section('title', __('lang.roles'))
@section('roles_active', 'active bg-light')
@includeIf("$directory.pushStyles")

@section('content')
    <!-- page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h2 class="h5 page-title">{{ __('messages.roles') }}</h2>

                <div class="page-title-right">
                    <a href="{{ route('back.roles.create') }}" class="btn btn-primary">
                        {{ __('messages.add') }}
                    </a>
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
                            <th class="text-primary">{{ __('messages.name') }}</th>
                            <th class="text-primary">{{ __('messages.permissions') }}</th>
                            <th class="text-primary" width="11%">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($data['data'] as $key => $item)
                            <tr>
                                <td>{{ $data['data']->firstItem() + $loop->index }}</td>
                                <td>{{ displayRole($item->name) }}</td>
                                <td>
                                    @foreach ($item->permissions as $permission)
                                        <span class="badge bg-primary">{{ displayPermission($permission->name) }}</span>
                                    @endforeach
                                </td>
                                <td>
                                   
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('back.roles.edit', ['role' => $item]) }}" class="btn btn-sm btn-warning flex-grow-1">
                                            {{ __('messages.edit') }}
                                        </a>

                                        <form action="{{ route('back.roles.destroy', ['role' => $item]) }}" method="POST" class="m-0 flex-grow-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger w-100">{{ __('messages.delete') }}</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            {{ __('messages.not_found') }}
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
