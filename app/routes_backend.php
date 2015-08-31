<?php

Route::pattern('id_default', '[0-9]*');

Route::group(array('prefix' => 'admin', 'before' => array('auth_admin', 'check_permissions')), function () {

    Route::get('/', 'BackendAdminController@showDashboard');
    Route::get('/logout', 'BackendAdminController@getLogout');

    Route::get('/settings', 'TableAdminController@showSettings');
    Route::post('/handle/settings', 'TableAdminController@handleSettings');
    Route::get('/email-templates', 'TableAdminController@showEmailTemplates');
    Route::post('/handle/email-templates', 'TableAdminController@handleEmailTemplates');

    // users
    Route::get('/tb/users', 'TableAdminController@showUsers');
    Route::post('/handle/users', 'TableAdminController@handleUsers');
    Route::get('/tb/groups', 'TableAdminController@showGroups');
    Route::post('/handle/groups', 'TableAdminController@handleGroups');
    Route::get('tb/users/{id}', 'Yaro\TableBuilder\TBUsersController@showEditUser')->where('id', '[0-9]+');
    Route::post('tb/users/update', 'Yaro\TableBuilder\TBUsersController@doUpdateUser');
    Route::get('tb/users/create', 'Yaro\TableBuilder\TBUsersController@showCreateUser');
    Route::post('tb/users/do-create', 'Yaro\TableBuilder\TBUsersController@doCreateUser');
    Route::get('tb/groups/{id}', 'Yaro\TableBuilder\TBUsersController@showEditGroup')->where('id', '[0-9]+');
    Route::post('tb/groups/update', 'Yaro\TableBuilder\TBUsersController@doUpdateGroup');
    Route::get('tb/groups/create', 'Yaro\TableBuilder\TBUsersController@showCreateGroup');
    Route::post('tb/groups/do-create', 'Yaro\TableBuilder\TBUsersController@doCreateGroup');
    Route::post('tb/users/upload-image', 'Yaro\TableBuilder\TBUsersController@doUploadImage');
    // end users

    Route::get('/z', 'TestingAdminController@show');
});