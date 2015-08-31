@extends('layouts.default')

@section('title')
    Главная страница
@stop

@section('content')



    <!--start home_content!-->
    <div class="home_content act">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="center_block">
                        <!--start search!-->
                        <div class="search">

                            <div class="logo">
                                <a href="/"><img src="/images/logo.png" width="145" height="32" alt="wwhere"></a>
                            </div>

                            <table>
                                <tr>
                                    <td class="search_text">
                                        <div style="position: relative;">
                                            <input id="order-id" type="text" value="{{ $ttn }}">
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
                            <div class="service_container temp">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="service_table">
                                            <div class="service_item">
                                                <a href="javascript:;">
                                                    <img class="color" src="/images/in_icon_grey.jpg" width="137" height="33" align="интайм">
                                                    <img class="grey" src="/images/in_icon_grey.png" width="137" height="33" align="интайм">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="service_table">
                                            <div class="service_item">
                                                <a href="javascript:;">
                                                    <img class="grey" src="/images/tnt_icon_grey.jpg" width="105" height="39" align="tnt">
                                                </a>
                                            </div>
                                        </div>        
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="service_table">
                                            <div class="service_item">
                                                <a href="javascript:;">
                                                    <img class="grey" src="/images/zd_icon_grey.png" width="200" height="40" align="zruchnadostavka.com">
                                                </a>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="service_table">
                                            <div class="service_item last">
                                                <a href="javascript:;">
                                                    <img class="color" src="/images/nova_icon.png" width="160" height="31" align="нова пошта">
                                                    <img class="grey" src="/images/nova_icon_grey.jpg" width="188" height="45" align="нова пошта">
                                                </a>    
                                            </div>
                                        </div>    
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="service_table">
                                            <div class="service_item">
                                                <a href="javascript:;">
                                                    <img class="color" src="/images/ukr_icon.jpg" width="85" height="45" align="укрпошта">
                                                    <img class="grey" src="/images/ukr_icon_grey.jpg" width="100" height="54" align="укрпошта">
                                                </a>
                                            </div>
                                        </div>    
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="service_table">
                                            <div class="service_item last">
                                                <a href="javascript:;">
                                                    <img class="color" src="/images/del_icon.jpg" width="82" height="49" align="delauto">
                                                    <img class="grey" src="/images/del_icon_grey.jpg" width="80" height="48" align="delauto">
                                                </a>    
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="service_table">
                                            <div class="service_item">
                                                <a href="javascript:;">
                                                    <img class="color" src="/images/mist_icon.jpg" width="90" height="54" align="мист експрес">
                                                    <img class="grey" src="/images/mist_icon_grey.jpg" width="95" height="57" align="мист експрес">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="service_table">
                                            <div class="service_item">
                                                <a href="javascript:;">
                                                    <img class="color" src="/images/avto_icon.jpg" width="139" height="39" align="автолюкс">
                                                    <img class="grey" src="/images/avto_icon_grey.jpg" width="137" height="34" align="автолюкс">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="results-container">{{ $result }}</div>
                        </div>
                        <!--end search!-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end home_content!-->

@stop

@section('script')
    <script>
        $(document).ready(function()
        {

            $('#order-id').keyup(function(event) {
                if (event.keyCode == 13) {
                    $('#find-btn').click();
                }
            });
        });
        $('.dropdown-toggle').dropdown();
    </script>
@stop

