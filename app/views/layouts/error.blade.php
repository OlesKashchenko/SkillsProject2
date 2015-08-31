<!DOCTYPE html>
<html lang="ru">
<head>
    @include('partials.head')
</head>

<body>

<!--ALL PAGE!-->
<div class="container main error_page">

    <!--HEADER!-->
    @section('header')
        @include('partials.header')
    @show
    <!--HEADER!-->

    @section('top_border')
    @show

    <!--search filter!-->
    @yield('content_menu')
    <!--search filter!-->

    <!--content!-->
    @yield('content')
    <!--content!-->

    <div class="footer_empty"></div>
</div>
<!--ALL PAGE!-->

<!--FOOTER!-->
@include('partials.footer')
<!--FOOTER!-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap/bootstrap.min.js"></script>

@section('js')
    {{HTML::script('plugins/FlexSlider/jquery.flexslider-min.js')}}
    {{HTML::script('plugins/jsor-jcarousel/js/jquery.jcarousel.min.js')}}
    {{HTML::script('plugins/jsor-jcarousel/js/jcarousel.responsive.js')}}
    {{HTML::script('plugins/rating/js/jquery.rating-2.0.js')}}
@show

<!--my scripts!-->
<script src="/js/script.js"></script>

@yield('script')

</body>
</html>

