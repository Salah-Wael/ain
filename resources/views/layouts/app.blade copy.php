<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="
    @if (Auth::guard('admin')->check()) {{ asset('assets-back') }}@endif
    @if(Auth::guard('web')->check()) {{ asset('assets-front') }}@endif
    @if(Auth::guard('head')->check()) {{ asset('assets-head') }}@endif
    @if(Auth::guard('doctor')->check()) {{ asset('assets-doctor') }} @endif/"
    data-template="vertical-menu-template-free">

{{-- Include the appropriate head section --}}
@if (Auth::guard('admin')->check())
    @include('back.partials.head')
@endif
@if(Auth::guard('web')->check())
    @include('front.partials.head')
@endif
@if(Auth::guard('head')->check())
    @include('head.partials.head')
@endif
@if(Auth::guard('doctor')->check())
    @include('doctor.partials.head')
@endif

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- Include the appropriate sidebar --}}
            @include('layouts.sidebar')


            <!-- Layout container -->
            <div class="layout-page">

                {{-- Include the appropriate navbar --}}
                @if (Auth::guard('admin')->check())
                    @include('back.partials.navbar')
                @endif
                @if(Auth::guard('web')->check())
                    @include('front.partials.navbar')
                @endif
                @if(Auth::guard('head')->check())
                    @include('head.partials.navbar')
                @endif
                @if(Auth::guard('doctor')->check())
                    @include('doctor.partials.navbar')
                @endif

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    {{-- Include the appropriate footer --}}
                    @include('layouts.footer')

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    {{-- Include the appropriate scripts --}}
    @if (Auth::guard('admin')->check())
        @include('back.partials.scripts')
    @endif
    @if (Auth::guard('web')->check())
        @include('front.partials.scripts')
    @endif
    @if (Auth::guard('head')->check())
        @include('head.partials.scripts')
    @endif
    @if (Auth::guard('doctor')->check())
        @include('doctor.partials.scripts')
    @endif
</body>

</html>
