@extends('layouts.default')

@section('title')
    Восстановление пароля
@stop

@section('content')
    <!--start home_content!-->
    <div class="home_content act">
        <div class="container inside">
            <div class="row">
                <div class="col-xs-12">ВОССТАНОВЛЕНИЕ ПАРОЛЯ
                    <div class="logo">
                        <a href="/"><img src="/images/logo.jpg" width="271" height="27" alt="zd.ua"></a>
                    </div>
                    <div class="data_block">
                        <div class="data_head">ВОССТАНОВЛЕНИЕ ПАРОЛЯ</div>
                        <div class="data_body">
                            <form id="set_password">
                                <p class="reg_label">ДЛЯ ЗАВЕРШЕНИЯ ВОССТАНОВЛЕНИЯ ПАРОЛЯ ВВЕДИТЕ НОВЫЙ ПАРОЛЬ:</p>
                                <table>
                                    <tr>
                                        <td><label>НОВЫЙ ПАРОЛЬ</label></td>
                                        <td><input type="password" id="new_password" name="new_password" placeholder="Новый пароль" maxlength="16"></td>
                                    </tr>
                                    <tr>
                                        <td><label>ПОВТОРИТЕ НОВЫЙ ПАРОЛЬ</label></td>
                                        <td><input type="password" id="new_password_confirm" name="new_password_confirm" placeholder="Повторите новый пароль" maxlength="16"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><button type="button" onclick="jQuery('#set_password').submit();">ПОДТВЕРДИТЬ</button></td>
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


