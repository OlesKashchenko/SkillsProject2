@extends('layouts.default')

@section('title')
    Создание пароля учетной записи
@stop

@section('content')
    <!--start home_content!-->
    <div class="home_content act">
        <div class="container inside">
            <div class="row">
                <div class="col-xs-12">
                    <div class="logo">
                        <a href="/"><img src="/images/logo.jpg" width="271" height="27" alt="zd.ua"></a>
                    </div>
                    <div class="data_block activate">
                        <div class="data_head">Создание пароля</div>
                        <div class="data_body">
                            <form id="activate_account">
                                <p class="reg_label">Для активации учетной записи создайте пароль:</p>
                                <table>
                                    <tr>
                                        <td><label>Пароль</label></td>
                                        <td><input type="password" id="password" name="password" placeholder="Пароль" maxlength="16"></td>
                                    </tr>
                                    <tr>
                                        <td><label>Повторите пароль</label></td>
                                        <td><input type="password" id="password_confirm" name="password_confirm" placeholder="Повторите пароль" maxlength="16"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><button type="button" onclick="jQuery('#activate_account').submit();">Активировать</button></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end home_content!-->
@stop


