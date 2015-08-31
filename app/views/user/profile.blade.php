<div id="profile_submit_result_success" style="display: none; margin: 25px; color:green;">
    ДАННЫЕ ВАШЕГО ПРОФИЛЯ УСПЕШНО ОБНОВЛЕНЫ.
</div>
<div id="profile_submit_result_fail" style="display: none; margin: 25px;color: red;">
    ВО ВРЕМЯ ОБНОВЛЕНИЯ ДАННЫХ ЧТО-ТО ПОШЛО НЕ ТАК.
</div>
<form id="cabinet_form" autocomplete="off">
    <table class="view_user_data">
        <tbody>
        <tr>
            <td><label>E-MAIL*</label></td>
            <td><input type="email" name="email" value="{{ $user->email }}"></td>
        </tr>
        <!--
        <tr class="user_row">
            <td colspan="2"><p>ДАННЫЕ, НЕОБХОДИМЫЕ ДЛЯ ОСУЩЕСТВЛЕНИЯ ДОСТАВКИ :</p></td>
        </tr>
        <tr>
            <td><label>ФАМИЛИЯ ПОЛУЧАТЕЛЯ</label></td>
            <td><input type="text" name="last_name" value="{{ $user->last_name }}"></td>
        </tr>
        <tr>
            <td><label>ИМЯ ПОЛУЧАТЕЛЯ</label></td>
            <td><input type="text" name="first_name" value="{{ $user->first_name }}"></td>
        </tr>
        <tr>
            <td><label>НОМЕР ТЕЛЕФОНА</label></td>
            <td><input type="text" name="phones" value="{{ $user->phones }}"></td>
        </tr>
        <tr>
            <td valign="top"><label>АДРЕС ДОСТАВКИ</label></td>
            <td><textarea name="address">{{ $user->address }}</textarea></td>
        </tr>
        -->
        </tbody>
    </table>

    <table class="change_user_data">
        <tbody>
        <tr>
            <td colspan="2"><label>Изменение пароля:</label></td>
        </tr>
        <tr>
            <td><label>СТАРЫЙ ПАРОЛЬ</label></td>
            <td><input type="password" name="old_pass" maxlength="32"></td>
        </tr>
        <tr>
            <td><label>НОВЫЙ ПАРОЛЬ</label></td>
            <td><input type="password" name="new_pass"></td>
        </tr>
        <tr>
            <td><label>ПОВТОРИТЕ ПАРОЛЬ</label></td>
            <td><input type="password" name="new_pass_confirmation"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button onclick="jQuery('#cabinet_form').submit();" type="button">СОХРАНИТЬ ИЗМЕНЕНИЯ</button>
            </td>
        </tr>
        </tbody>
    </table>
</form>