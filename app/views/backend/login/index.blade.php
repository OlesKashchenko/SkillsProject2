@extends('backend.layouts.login')
 
@section('title') Логин @stop
 
@section('form')

<div class="login-wrap">
    {{ Form::open(['role' => 'form']) }}
    <div class="visite">
        <a href="javascript:;">
            <img width="180" height="46" src="/backend/img/logo_big.png">
        </a>
        <span>Система управления контентом</span>
    </div>
    @if ($errors->has())
        @foreach ($errors->all() as $error)
            <div class='bg-danger alert'>{{ $error }}</div>
        @endforeach
    @endif
    <div class="login">
        <input type="text" name="email" placeholder="email">
    </div>
    <div class="pass">
        <input type="password" name="password" placeholder="password">
        <!-- <a href="javascript:;"><i class="fa fa-eye"></i></a> -->
    </div>
    <div>
        <div class="checkbox">
            <label>
                <input name="rememberme" type="checkbox"> <span>Запомнить меня</span>
            </label>
        </div>
        <!-- <a class="forgot-pass" href="javascript:;">Забыли пароль?</a> -->
    </div>
    <div class="clear"></div>
    <button type="submit" class="btn-green"><i class="fa fa-sign-in"></i>Войти</button>
    {{ Form::close() }}
</div>
 
@stop