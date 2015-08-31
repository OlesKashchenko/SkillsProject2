@extends('layouts.default')

@section('title')
    Главная страница
@stop

@section('content')


    
    <!--start home_content!-->
    <div class="home_content {{ ($ttn)?'act':'' }}">
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
                            <h1>Чтобы отследить более одного номера, введите их в строку, разделяя пробелом или другими знаками препинания</h1>
                            <!--<div class="input-group" style="float: left; width: 5%; margin-left: 1%; display: none;" id="preloader">
                                <img src="/images/preloader.gif" style="width: 28px; height: 28px;">
                            </div>!-->
                            
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

