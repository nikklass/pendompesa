@extends('site.layouts.mainMaster')

@section('main_content') 
        
    <div class="wrapper theme-1-active pimary-color-red">
            
        @include('site.layouts.partials.header')

        @include('site.layouts.partials.sidebarRight')

        @include('site.layouts.partials.settingsRight')

        @include('site.layouts.partials.sidebarBackdropRight')

        <div class="page-wrapper">

            @yield('content')

            <!-- Footer -->
            @include('site.layouts.partials.footer')
            <!-- /Footer -->

        </div>

    </div>

@endsection
