<div class="modal fade" id="reg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel1">Регистрация на сайте</h4>
                <p>Вы можете зарегистрироваться с помощью социальных сетей:</p>
            </div>
            <div class="modal-body">
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
                                <input class="grey" type="button" value="Подтвердить" style="clear: both;float: left;" onclick="jQuery('#user_register').submit();">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="register_send" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel4">Активируйте учетную запись</h4>
                <p>Для продолжения создания учетной записи проверьте почту и перейдите по указанной в письме ссылке.</p>
            </div>
            <br/>
        </div>
    </div>
</div>

<div class="modal fade" id="reset_send" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel4">Восстановите пароль</h4>
                <p>Для продолжения процедуры восстановления пароля проверьте почту и перейдите по указанной в письме ссылке.</p>
            </div>
            <br/>
        </div>
    </div>
</div>