@extends('layouts.default')

@section('title')
    Авторизация
@stop

@section('content')
    <!--start home_content!-->
    <div class="home_content act login_page">
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
                    
                    <!--start data_block!-->
                    <div class="data_block">
                        <div class="data_head">
                            <p>Вы можете авторизироваться с помощью социальных сетей:</p>
                        </div>
                            <div class="soc">
                            <a href="{{ URL::to('auth_soc/fb') }}">FACEBOOK</a><span>/</span>
                            <a href="{{ URL::to('auth_soc/vk') }}">VKONTAKTE</a><span>/</span>
                            <a href="{{ URL::to('auth_soc/google') }}">GOOGLE+</a>
                        </div>
                        <div class="data_menu">
                            <p>Или с помощью e-mail или пароля:</p>
                            <div class="data_menu_container">
                                <a class="act" href="javascript:;" data-id="tab_1">АВТОРИЗАЦИЯ</a><span>/</span>
                                <a href="javascript:;" data-id="tab_2">РЕГИСТРАЦИЯ</a>
                                <!--<a href="javascript:;" data-id="tab_3" id="show_reset_tab"></a>!-->
                            </div>
                        </div>
                        <div class="data_body">
                            <!--start login!-->
                            <div id="tab_1" class="tabs_table">
                                <form id="user_page_login">
                                <table>
                                <tr>
                                    <td><label>E-MAIL</label></td>
                                    <td><input type="email" name="login_page_email" id="register_email" maxlength="32"></td>
                                </tr>
                                <tr>
                                    <td><label>ПАРОЛЬ</label></td>
                                    <td><input type="password" name="login_page_password" id="login_password"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="forgot_pass" type="button" onclick="jQuery('#show_reset_tab').click();jQuery('.act').css('background', 'inherit');">ЗАБЫЛИ ПАРОЛЬ?</button>
                                    </td>
                                    <td>
                                        <button type="button" onclick="jQuery('#user_page_login').submit();" id="login_button">АВТОРИЗИРОВАТЬСЯ</button>
                                        <!--<input class="mycheckbox" type="checkbox" data-label="ЗАПОМНИТЬ МЕНЯ" data-labelPosition="left">
                                        <a class="forgot_pass" href="javascript:;">ЗАБЫЛИ ПАРОЛЬ?</a>!-->
                                    </td>
                                </tr>
                            </table>
                            </form>
                            </div>
                            <!--end login!-->
                            
                            <!--start reg!-->
                            <div id="tab_2" class="tabs_table reg_tab" style="display: none;">
                                <form id="user_register">
                                    <p class="reg_label">Для создания учетной записи введите ваш e-mail:</p>
                                    <table>
                                        <!--<tr>
                                            <td><label>ВАША ФАМИЛИЯ</label></td>
                                            <td><input type="text" name="register_last_name" id="register_last_name" maxlength="32"></td>
                                        </tr>!-->
                                        <!--<tr>
                                            <td><label>ВАШЕ ИМЯ</label></td>
                                            <td><input type="text" name="register_first_name" id="register_first_name" maxlength="32"></td>
                                        </tr>!-->
                                        <tr>
                                            <td><label>E-MAIL</label></td>
                                            <td><input type="email" name="register_email" id="register_email"></td>
                                        </tr>
                                        <!--
                                        <tr>
                                            <td><label>ПАРОЛЬ</label></td>
                                            <td>
                                                <input type="password" name="register_password" id="register_password" maxlength="16">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>ПОВТОРИТЕ ПАРОЛЬ</label></td>
                                            <td>
                                                <input type="password" name="register_password_confirm" id="register_password_confirm" maxlength="16">
                                            </td>
                                        </tr>
                                        -->
                                        <tr>
                                            <td></td>
                                            <td>
                                                <button type="button" onclick="jQuery('#user_register').submit();">ЗАРЕГИСТРИРОВАТЬСЯ</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <div id="user_register_result" style="display: none;margin: 20px 0;">
                                    Для продолжения создания учетной записи проверьте почту и перейдите по указанной в письме ссылке.
                                </div>
                            </div>
                            <!--end reg!-->

                            <div id="tab_3" class="tabs_table reg_tab" style="display: none;">
                                <form id="user_reset">
                                    <p class="reg_label">ДЛЯ ВОССТАНОВЛЕНИЯ ПАРОЛЯ ВВЕДИТЕ ВАШ E-MAIL</p>
                                    <table>
                                        <tr>
                                            <td><label>E-MAIL</label></td>
                                            <td><input type="email" name="reset_email" id="reset_email" placeholder="Введите ваш E-mail"></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><button type="button" onclick="jQuery('#user_reset').submit();">ПОДТВЕРДИТЬ</button></td>
                                        </tr>
                                    </table>
                                </form>
                                <div id="user_reset_result" style="display: none;margin: 20px 0;">
                                    Для продолжения процедуры восстановления пароля проверьте почту и перейдите по указанной в письме ссылке.
                                </div>
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

@section('js')
    @parent
    
    <script>
        $(".mycheckbox").each(function() {
            $(this).prettyCheckable();
        });
    </script>
@stop