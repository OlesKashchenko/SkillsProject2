@extends('layouts.default')

@section('title')
    Кабинет
@stop

@section('content')
 <!--start home_content!-->
    <div class="home_content act cabinet">
        <div class="container inside">
            <div class="row">
                <div class="col-xs-12">
                    
                    <div class="logo">
                        <a href="/"><img src="/images/logo.jpg" width="271" height="27" alt="zd.ua"></a>
                    </div>
                    
                    <table>
                                <tr>
                                    <td class="search_text">
                                        <div style="position: relative;">
                                            <input id="order-id" type="text" value="">
                                            @if ( Request::segment(1) == 2 )
                                            <div id="proghress_bar_loader" class="proghress_bar proghress_bar_loader" style="display: none;">
                                                <span class="current"></span>
                                            </div>
                                            @endif
                                        </div>    
                                    </td>
                                    <td class="search_button">
                                        <button id="find-btn" type="button" onclick="Main.searchOrder()"><i class="fa fa-search"></i></button>
                                    </td>
                                </tr>
                            </table>
                    
                    <!--start data_block!-->
                    <div class="data_block">
                        <div class="data_menu">
                            <div class="data_menu_container">
                                <a class="act" href="javascript:;" data-id="tab_1">Данные профиля</a>
                                <span>/</span>
                                <!--<a href="javascript:;" data-id="tab_2">История просмотров</a>
                                <span>/</span>-->
                                <a href="javascript:;" data-id="tab_3">Бонусы</a>
                                <span>/</span>
                                <a href="javascript:;" onclick="User.doLogout();">Выход</a>
                            </div>
                        </div>
                        <div class="data_body">
                            <div id="tab_1" class="tabs_table">
                                @include('user.profile')
                            </div>
                            <div id="tab_3" class="tabs_table" style="display: none;">
                                <p style="padding-left: 30px;margin-top: 15px;">
                                    У вас  <span class="user_ratio">{{ Sentry::getUser()->getPointsCount() }}</span> баллов
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--end data_block!-->

                </div>
            </div>
        </div>
    </div>
    <!--end home_content!-->
@stop
