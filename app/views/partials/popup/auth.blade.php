<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                <p style="float: left;">или с помощью E-mail и пароля:</p><br><br>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#auth_tab" role="tab" data-toggle="tab">Авторизация</a></li>
                    <li><a href="#reg_tab" role="tab" data-toggle="tab">Регистрация</a></li>
                </ul>
                <div class="tab-content" style="margin-top: 10px;">
                    <div class="tab-pane active" id="auth_tab">
                        <div class="login_email">
                            <form id="user_login">
                                <table style="clear: both;">
                                    <tr>
                                        <td>
                                            <label style="float: left;">Email</label>
                                            <input style="clear: both;float: left;" type="text" name="login_email" id="login_email" placeholder="Введите ваш E-mail">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label style="float: left;">Пароль</label>
                                            <input style="clear: both;float: left;" type="password" name="login_password" id="login_password" placeholder="Введите ваш пароль">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input style="clear: both;float: left;margin-top: 10px;" type="checkbox" name="login_remember" id="login_remember">&nbsp;<span style="float: left;margin-top: 5px;margin-left: 10px;">Запомнить меня</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input onclick="jQuery('#user_login').submit();" class="grey" type="button" value="Войти" style="clear: both;float: left;margin-top: 15px;">
                                            <a class="forgot_pass_link cursor" style="float: left;margin-top: 18px;margin-left: 10px;"><span>Забыли пароль?</span></a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="reg_tab">
                        <form id="user_register">
                            <table style="clear: both;">
                                <tr>
                                    <td>
                                        <label style="float: left;">Фамилия</label>
                                        <input type="text" style="clear: both;float: left;" name="register_last_name" id="register_last_name" maxlength="32">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label style="float: left;">Имя</label>
                                        <input type="text" style="clear: both;float: left;" name="register_first_name" id="register_first_name" maxlength="32">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label style="float: left;">E-mail</label>
                                        <input type="text" style="clear: both;float: left;" name="register_email" id="register_email" maxlength="32">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label style="float: left;">Пароль</label>
                                        <input type="password" style="clear: both;float: left;" name="register_password" id="register_password" maxlength="16">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label style="float: left;">Повторите пароль</label>
                                        <input type="password" style="clear: both;float: left;" name="register_password_confirm" id="register_password_confirm" maxlength="16">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="pravila">
                                            <input type="checkbox" id="pravila" name="pravila">
                                            <label for="pravila">Согласен с <a href="havascript:;">правилами и условиями сайта</a></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="grey" type="button" value="Cоздать профиль" style="clear: both;float: left;" onclick="jQuery('#user_register').submit();">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>