<!DOCTYPE html>
<html lang="ru">
<head>
    @include('partials.head')
</head>

<body>

    <!--<div class="new_preloader"></div>!-->
    <!--<div id="canvasloader-container" class="loader"></div>!-->
    
    <div class="shadow {{ (Request::segment(1) == 'service') ? 'light' : '' }}"></div>
    <img class="loader_gif" src="/images/loader_final.gif" width="62" height="62">
    <img class="loader_small_gif" src="/images/loader_small.gif" width="30" height="30">
    
    <!--start all!-->
    <div class="all {{ ( Request::segment(1)=='login' ) ? 'login_container' : '' }} {{ ( Request::segment(1)=='service' ) ? 'service_page' : '' }} {{ ( Request::segment(1)=='about' ) ? 'about_page' : '' }}">

        @section('header')
            @include('partials.header')
        @show

        @yield('content')
        
        @include('partials.footer')

    </div>
    <!--end all!-->
   

    @section('modal')
        @include('partials.popup.auth')
        @include('partials.popup.reg')
    @show

    @section('js')
        
    @show

    <!--my scripts!-->
    {{ HTML::script('/js/script.js') }}

    @yield('script')
</body>
</html>

