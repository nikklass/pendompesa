@extends('site.layouts.mainMaster')

@section('main_content')
        
    <div class="page-wrapper wrapper pa-0 ma-0 auth-page">

        @include('site.layouts.partials.authHeader')

        @yield('content')
           
    </div>

@endsection
