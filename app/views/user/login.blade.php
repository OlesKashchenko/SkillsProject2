@extends('layouts.default')

@section('title')
@stop

@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="margin-top: 70px;">
                <form id="user_page_login">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title" id="myModalLabel">Вход на сайт</h4>
                            <p>Вы можете авторизироваться с помощью социальных сетей</p>
                        </div>
                        <div class="modal-body">
                            <div class="login_soc">
                                <div id="uLogin1af0029f" data-ulogin="display=panel;fields=first_name,last_name,email,photo;sort=default;providers=facebook,vkontakte,googleplus;redirect_uri=;callback=uloginCallback"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="login_email">
                                <form id="user_login">
                                    <p style="float: left;">или с помощью E-mail и пароля:</p>
                                    <table style="clear: both;">
                                        <tr>
                                            <td>
                                                <label style="float: left;">Email</label>
                                                <input style="clear: both;float: left;" type="text" name="login_page_email" id="login_page_email" placeholder="Введите ваш E-mail">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label style="float: left;">Пароль</label>
                                                <input style="clear: both;float: left;" type="password" name="login_page_password" id="login_page_password" placeholder="Введите ваш пароль">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input style="clear: both;float: left;margin-top: 10px;" type="checkbox" name="login_page_remember" id="login_page_remember">&nbsp;<span style="float: left;margin-top: 5px;margin-left: 10px;">Запомнить меня</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input onclick="jQuery('#user_page_login').submit();" class="grey" type="button" value="Войти" style="clear: both;float: left;margin-top: 15px;">
                                                <a class="forgot_pass_link cursor" style="float: left;margin-top: 18px;margin-left: 10px;"><span>Забыли пароль?</span></a>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop


