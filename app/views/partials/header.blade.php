<!--start header!-->
    <div class="header">
    
        <!--<div class="beta_logo"></div>!-->
    
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="menu clearfix">
                        <a class=" {{ ( Request::segment(1)=='about' ) ? 'float_link act' : 'float_link' }} " href="/about">О проекте</a>
                        <a class=" {{ ( Request::segment(1)=='service' ) ? 'act' : '' }} " href="/service">Службы доставки</a>
                        <a class="def" href="javascript:;">Интернет-магазинам</a>
                        <div class="right {{ (Sentry::check())? 'log_right':'' }}">
                            <!--
                            @if (Request::segment(1) == 'logined')
                                <div class="logined">
                                    <p>ЗДРАВСТВУЙТЕ, <a href="javascript:;" class="user_name">SHMEAL@GMAIL.COM!</a> У ВАС  <span class="user_ratio">5</span> БАЛЛОВ</p>
                                </div>
                            @else
                                <a class="act" href="/login">ВХОД</a>
                            @endif
                            -->
                            

                            @if (Sentry::check())
                                <div class="logined">
                                    <p>
                                        @if (Sentry::getUser()->getFullName())
                                            Здравствуйте, <a href="{{ URL::to('user/cabinet') }}" class="user_name">{{ Sentry::getUser()->getFullName() }}!</a>
                                        @else
                                            Здравствуйте, <a href="{{ URL::to('user/cabinet') }}" class="user_name">{{ Sentry::getUser()->email }}!</a>
                                        @endif
                                            У вас  <span class="user_ratio">{{ Sentry::getUser()->getPointsCount() }}</span> баллов
                                    </p>
                                </div>
                            @else
                                <a class=" {{ ( Request::segment(1)=='login' ) ? 'act' : '' }} " href="{{ URL::to('login') }}">Вход</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="beta">- BETA VERSION -</div>
        </div>
    </div>
    <!--end header!-->
    
    


