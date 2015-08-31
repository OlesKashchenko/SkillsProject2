@extends('layouts.default')

@section('title')
    О проекте
@stop

@section('content')

    <!--start home_content!-->
    <div class="home_content onas act">
        <div class="container inside">
            <div class="row">
                <div class="col-xs-12">
                    <div class="logo">
                        <a href="/"><img src="/images/logo.png" width="145" height="32" alt="wwhere"></a>
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
                    <div class="data_block article temp">
                        <h1>О проекте</h1>
                        <p>wwhere — сервис по отслеживанию украинских почтовых и курьерских отправлений. Еще никогда отслеживание почтовых отправлений не было таким удобным!</p>
                        <p>Сервис wwhere создан для упрощения процедуры отслеживания регистрируемых почтовых и курьерских отправлений 
по предоставленному вам трек-коду (уникальному идентификационному номеру, который присваивается организацией-отправителем).</p>
                        <p>Даже если вы ожидаете отправления от разных почтовых или курьерских компаний, наш сервис будет полезным для вас! Вам просто необходимо ввести присвоенный вашей посылке трекинг номер в специальное поле, а если несколько, 
то через пробел либо любой другой знак препинания. И в один клик мышкой вы получите нужную вам информацию!</p>
                    </div>
                    <div id="results-container">{{ $result }}</div>
                </div>
            </div>
        </div>
    </div>
    <!--end home_content!-->
    
@stop