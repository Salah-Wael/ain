<?php
    $guards = [
        'admin' => 'back',
        'web' => 'front',
        'head' => 'head',
        'doctor' => 'doctor',
    ];

    $currentGuard = collect($guards)->first(fn($prefix, $guard) => Auth::guard($guard)->check());
    $assetPath = $currentGuard ? asset("assets-$currentGuard") : asset('assets-front');
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="{{ $assetPath }}/"
    data-template="vertical-menu-template-free">

@if ($currentGuard)
    @include("$currentGuard.partials.head")
@endif

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- Include the sidebar --}}
            @include('layouts.sidebar')

            <div class="layout-page">

                {{-- Include the navbar --}}
                @if ($currentGuard)
                    @include("$currentGuard.partials.navbar")
                @endif

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>

                    @include('layouts.footer')

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    {{-- Include the scripts --}}
    @if ($currentGuard)
        @include("$currentGuard.partials.scripts")
    @endif
</body>
</html>

