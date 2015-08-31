<?php

Route::pattern('code', '[a-zA-Z0-9]{40,42}');

Route::get('/zz', function() {
    $client = New UpClient();
    $client->buildRequestData('RF030222522UA');
    $client->sendRequest();
    $client->formResult();
});

Route::get('/', 'HomeController@showWelcome');

Route::get('/logined', 'HomeController@showWelcome');
Route::get('/login', 'HomeController@showLoginPage');
Route::get('/service', 'HomeController@showServicePage');
Route::get('/about', 'HomeController@showAboutPage');

Route::get('/preloader', 'HomeController@showPreloader');

Route::get('/1', 'HomeController@showWelcome');
Route::get('/2', 'HomeController@showWelcome');

Route::get('/get-saved-delivery-info', 'HomeController@getSavedDeliveryInfo');
Route::post('/get-delivery-info', 'HomeController@getDeliveryInfo');
Route::post('/remove-ttn', 'HomeController@removeTTN');
Route::post('/get-prepared-search', 'HomeController@getPreparedSearch');

Route::get('/admin/login', 'BackendAdminController@showLogin');
Route::post('/admin/login', 'BackendAdminController@postLogin');

/* User */
Route::get('/user/login', 'UserCabinetController@showLogin');
Route::post('/user/post-login', 'UserCabinetController@doUserLogin');
Route::post('/user/post-login-page', 'UserCabinetController@doUserPageLogin');
Route::post('/user/post-logout', 'UserCabinetController@doUserLogout');
Route::post('/user/post-register', 'UserCabinetController@doRegister');
Route::get('/user/activate/{code}', 'UserCabinetController@showUserActivate');
Route::post('/user/activate/{code}', 'UserCabinetController@doUserActivate');
Route::post('/user/post-reset', 'UserCabinetController@doReset');
Route::get('/user/recover/{code}', 'UserCabinetController@showUserRecover');
Route::post('/user/recover/{code}', 'UserCabinetController@doUserRecover');
Route::get('/user/cabinet', 'UserCabinetController@showCabinet');
Route::post('/user/post-social', 'UserCabinetController@doUserLoginBySocial');
Route::post('/user/post-edit', 'UserCabinetController@doUserEdit');

Route::get('/user/login', 'UserCabinetController@showLogin');

// Socials
Route::get('auth_soc/vk', array(
        'as'    => 'auth_vk',
        'uses'  => 'Vis\AuthSoc\VKController@vk')
);
Route::get('auth_soc/vk_res', array(
        'as'    => 'auth_vk_res',
        'uses'  => 'Vis\AuthSoc\VKController@index')
);
Route::get('auth_soc/fb', array(
        'as'    => 'auth_fb',
        'uses'  => 'Vis\AuthSoc\FBController@fb')
);
Route::get('auth_soc/face_res', array(
        'as'    => 'auth_fb_res',
        'uses'  => 'Vis\AuthSoc\FBController@index')
);
Route::get('auth_soc/google', array(
        'as'    => 'auth_google',
        'uses'  => 'Vis\AuthSoc\GoogleController@google')
);
Route::get('oauth2callback', array(
        'as'    => 'auth_google_oauth2callback',
        'uses'  => 'Vis\AuthSoc\GoogleController@oauth2callback')
);

include 'routes_backend.php';

if (file_exists(app_path() .'/routes_dev.php')) {
    include app_path() .'/routes_dev.php';
}