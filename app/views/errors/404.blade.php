@extends('layouts.default')

@section('title')
    Страница не найдена
@stop

@section('content')
    <div class="home_content act">
        <div class="container inside">
            <div class="row">
                <div class="col-xs-12">
                    <div class="logo">
                        <a href="/"><img src="/images/logo.jpg" width="271" height="27" alt="zd.ua"></a>
                    </div>
                    <div class="data_block error">
                        <div class="data_head">
                            <h1>Страница не найдена</h1>
                            <p>Возможно, эта страница была удалена или допущена ошибка в адресе.</p>
                            <a href="/">Перейти на главную страницу</a>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
@stop