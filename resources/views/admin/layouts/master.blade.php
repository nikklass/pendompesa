@extends('admin.layouts.mainMaster')

@section('main_content') 
        
    <div class="wrapper theme-1-active pimary-color-red">
            
        @include('admin.layouts.partials.header')

        @include('admin.layouts.partials.sidebarLeft')

        @include('admin.layouts.partials.sidebarRight')

        @include('admin.layouts.partials.settingsRight')

        @include('admin.layouts.partials.sidebarBackdropRight')

        <div class="page-wrapper">

            @yield('content')

            <!-- Footer -->
            @include('admin.layouts.partials.footer')
            <!-- /Footer -->

        </div>

    </div>

@endsection
