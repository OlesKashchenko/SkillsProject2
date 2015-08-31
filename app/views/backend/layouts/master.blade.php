<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | Vi-Site 3.0</title>
        <link href='//fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>        
        
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css" rel='stylesheet' type='text/css'>

        <link href="//rawgit.com/vitch/jScrollPane/master/style/jquery.jscrollpane.css" rel="stylesheet" type="text/css" media="all" />
        
        <link rel="stylesheet" href="/backend/style.css">

        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>

    </head>
    <body>
        <div class="wrap container-fluid">
            <!-- HEADER -->
            <div class="header">
                <div class="visite col-sm-6">
                    <a href="#"><img src="/backend/img/logo.png"></a>
                    <p>Система управления контентом</p>
                </div>
                <div class="laravel col-sm-6">
                    <p>powered by laravel</p>
                    <a href="#"><img src="/backend/img/logo_laravel.png"></a>
                </div>
                <div class="clear"></div>
            </div>
            <!-- HEADER END -->
            
            <!-- CONTENT -->
            <div class="content-wrap">
                <div class="sections col-sm-2">
                    <div class="site-name">
                        <img src="/backend/img/site_favicon.png">
                        <a href="#">www.atl.ua</a>
                    </div>
                    <div class="user-name">
                        <a href="#"> <i class="fa fa-user"></i>{{ Auth::user() ? Auth::user()->email : '' }}</a> 
                        <span>-</span>
                        <p>{{ Auth::user() && Auth::user()->role ? Auth::user()->role : 'админ' }}</p>
                        <a href="/admin/logout"><i class="fa fa-sign-out"></i></a>
                    </div>
                    
                    @include('backend.cms.includes.menu')

                </div>

                @yield('content')

            </div>
            <!-- CONTENT END -->
            <div class="empty"></div>   
        </div>

        <!-- FOOTER -->
        <div class="footer container-fluid">
            <p>Vi-Site by VIS-A-VIS © {{ date('Y') }}</p>
        </div>
        <!-- FOOTER END -->

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        
        <script src="//rawgit.com/vitch/jScrollPane/master/script/jquery.mousewheel.js"></script>
        <script src="//rawgit.com/vitch/jScrollPane/master/script/jquery.jscrollpane.min.js"></script>
        <script src="//rawgit.com/Sjeiti/TinySort/master/dist/jquery.tinysort.min.js"></script>
        <script src="//rawgit.com/farhadi/html5sortable/master/jquery.sortable.js"></script>


        <script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.min.js"></script>

        <script src="/backend/js/cms.js"></script>

        <script src="//cdn.ckeditor.com/4.4.3/full/ckeditor.js"></script>
    </body>
</html>