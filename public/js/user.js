"use strict";

var User = 
{
    init: function()
    {
        User.initULogin();
        User.initLoginValidation();
        User.initPageLoginValidation();
        User.initRegisterValidation();
        User.initResetValidation();
        User.initRecoverValidation();
        User.initActivateValidation();
        User.initSubmitCabinet();

        jQuery('.forgot_pass_link').click(function() {
            jQuery('#login').modal('hide');
            jQuery('#reset').modal('show');
        });

        jQuery('.remember_pass_link').click(function() {
            jQuery('#reset').modal('hide');
            jQuery('#login').modal('show');
        });
    }, // end init

    initLoginValidation: function()
    {
        var $validator = jQuery('#user_login').validate({
            rules : {
                'login_email' : {
                    required : true,
                    rangelength: [6, 32],
                    email: true
                },
                'login_password' : {
                    required : true,
                    rangelength: [6, 16]
                }
            },

            messages : {
                'login_email' : {
                    required : 'Поле Email обязательно для заполнения',
                    rangelength: 'Поле Email должно хранить от 6 до 32 символов',
                    email: 'Значение Email имеет неверный формат'
                },
                'login_password' : {
                    required : 'Поле Пароль обязательно для заполнения',
                    rangelength: 'Поле Пароль должно хранить от 6 до 16 символов'
                }
            },

            submitHandler : function(form) {
                var values = jQuery(form).serializeArray();

                jQuery.ajax({
                    type: "POST",
                    url: '/user/post-login',
                    cache: false,
                    data: values,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            window.location.reload();
                        } else {
                            jQuery.each(response.errors, function(key, value) {
                                /*
                                 toastr.error(value);
                                 */
                                alert(value);
                            });
                        }
                    }
                });
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent().parent());
            }
        });
    }, // end initLoginValidation

    initPageLoginValidation: function()
    {
        var $validator = jQuery('#user_page_login').validate({
            rules : {
                'login_page_email' : {
                    required : true,
                    rangelength: [6, 32],
                    email: true
                },
                'login_page_password' : {
                    required : true,
                    rangelength: [6, 16]
                }
            },

            messages : {
                'login_page_email' : {
                    required : 'Поле Email обязательно для заполнения',
                    rangelength: 'Поле Email должно хранить от 6 до 32 символов',
                    email: 'Значение Email имеет неверный формат'
                },
                'login_page_password' : {
                    required : 'Поле Пароль обязательно для заполнения',
                    rangelength: 'Поле Пароль должно хранить от 6 до 16 символов'
                }
            },

            submitHandler : function(form) {
                var values = jQuery(form).serializeArray();

                jQuery.ajax({
                    type: "POST",
                    url: '/user/post-login-page',
                    cache: false,
                    data: values,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            window.location = response.link;
                        } else {
                             jQuery.each(response.errors, function(key, value) {
                                /*
                                toastr.error(value);
                                 */
                                 alert(value);
                             });
                        }
                    }
                });
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent().parent());
            }
        });
    }, // end initLoginValidation

    initRegisterValidation: function()
    {
        var $validator = jQuery('#user_register').validate({
            rules : {
                /*
                'register_last_name' : {
                    required : true,
                    rangelength: [2, 32]
                },
                'register_first_name' : {
                    required : true,
                    rangelength: [2, 32]
                },
                */
                'register_email' : {
                    required : true,
                    rangelength: [6, 32],
                    email: true
                }
                /*
                'register_password' : {
                    required : true,
                    rangelength: [6, 16]
                },
                'register_password_confirm' : {
                    required : true,
                    rangelength: [6, 16],
                    equalTo: "#register_password"
                },
                'pravila' : {
                    required: true
                }
                */
            },

            messages : {
                /*
                'register_last_name' : {
                    required : 'Поле Фамилия обязательно для заполнения',
                    rangelength: 'Поле Фамилия должно хранить от 2 до 32 символов'
                },
                'register_first_name' : {
                    required : 'Поле Имя обязательно для заполнения',
                    rangelength: 'Поле Имя должно хранить от 2 до 32 символов'
                },
                */
                'register_email' : {
                    required : 'Поле Email обязательно для заполнения',
                    rangelength: 'Поле Email должно хранить от 6 до 32 символов',
                    email: 'Значение Email имеет неверный формат'
                }
                /*
                'register_password' : {
                    required : 'Поле Пароль обязательно для заполнения',
                    rangelength: 'Поле Пароль должно хранить от 6 до 16 символов'
                },
                'register_password_confirm' : {
                    required : 'Поле Повторите пароль обязательно для заполнения',
                    rangelength: 'Поле Повторите пароль должно хранить от 6 до 16 символов',
                    equalTo: 'Значение поля Повторите пароль не соответствует значению поля Пароль'
                },
                'pravila' : {
                    required: 'Для продолжения необходимо согласиться с правилами и условиями сайта'
                }
                */
            },

            submitHandler : function(form) {
                var values = jQuery(form).serializeArray();

                jQuery.ajax({
                    type: "POST",
                    url: '/user/post-register',
                    cache: false,
                    data: values,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            jQuery('#user_register').hide(500);
                            jQuery('#user_register_result').delay(500).show(500);
                        } else {
                            jQuery.each(response.errors, function(key, value) {
                                // todo: заменить на человеческое оповещение
                                alert(value);
                            });
                        }
                    }
                });
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent().parent());
            }
        });
    }, // end initRegisterValidation

    initResetValidation: function()
    {
        var $validator = jQuery('#user_reset').validate({
            rules : {
                'reset_email' : {
                    required : true,
                    rangelength: [6, 32],
                    email: true
                }
            },

            messages : {
                'reset_email' : {
                    required : 'Поле Email обязательно для заполнения',
                    rangelength: 'Поле Email должно хранить от 6 до 32 символов',
                    email: 'Значение Email имеет неверный формат'
                }
            },

            submitHandler : function(form) {
                var values = jQuery(form).serializeArray();

                jQuery.ajax({
                    type: "POST",
                    url: '/user/post-reset',
                    cache: false,
                    data: values,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            jQuery('#user_reset').hide(500);
                            jQuery('#user_reset_result').delay(500).show(500);
                        } else {
                            jQuery.each(response.errors, function(key, value) {
                                alert(value);
                                //toastr.error(value);
                            });
                        }
                    }
                });
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent().parent());
            }
        });
    }, // end initResetValidation

    initRecoverValidation: function()
    {
        var $validator = jQuery('#set_password').validate({
            rules : {
                'new_password' : {
                    required : true,
                    rangelength: [6, 16]
                },
                'new_password_confirm' : {
                    required : true,
                    rangelength: [6, 16],
                    equalTo: "#new_password"
                }
            },

            messages : {
                'new_password' : {
                    required : 'Поле Новый пароль обязательно для заполнения',
                    rangelength: 'Поле Новый пароль должно хранить от 6 до 16 символов'
                },
                'new_password_confirm' : {
                    required : 'Поле Повторите новый пароль обязательно для заполнения',
                    rangelength: 'Поле Повторите новый пароль должно хранить от 6 до 16 символов',
                    equalTo: "Значение поля Новый пароль не соответствует значению поля Повторите новый пароль"
                }
            },

            submitHandler : function(form) {
                var values = jQuery(form).serializeArray();

                jQuery.ajax({
                    type: "POST",
                    url: window.location.pathname,
                    cache: false,
                    data: values,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            window.location = response.link;
                        } else {
                            jQuery.each(response.errors, function(key, value) {
                                /*
                                toastr.error(value);
                                */
                                alert(value);
                            });
                        }
                    }
                });
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent().parent());
            }
        });
    }, // end initRecoverValidation

    initActivateValidation: function()
    {
        var $validator = jQuery('#activate_account').validate({
            rules : {
                'password' : {
                    required : true,
                    rangelength: [6, 16]
                },
                'password_confirm' : {
                    required : true,
                    rangelength: [6, 16],
                    equalTo: "#password"
                }
            },

            messages : {
                'password' : {
                    required : 'Поле Пароль обязательно для заполнения',
                    rangelength: 'Поле Пароль должно хранить от 6 до 16 символов'
                },
                'password_confirm' : {
                    required : 'Поле Повторите пароль обязательно для заполнения',
                    rangelength: 'Поле Повторите пароль должно хранить от 6 до 16 символов',
                    equalTo: "Значение поля Пароль не соответствует значению поля Повторите пароль"
                }
            },

            submitHandler : function(form) {
                var values = jQuery(form).serializeArray();

                jQuery.ajax({
                    type: "POST",
                    url: window.location.pathname,
                    cache: false,
                    data: values,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            window.location = response.link;
                        } else {
                            jQuery.each(response.errors, function(key, value) {
                                alert(value);
                            });
                        }
                    }
                });
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent().parent());
            }
        });
    }, // end initActivateValidation

    doLogout: function()
    {
        jQuery.ajax({
            type: "POST",
            url: '/user/post-logout',
            dataType: 'json',
            success: function(response) {
                window.location = '/';
            }
        });
    }, // end doLogout

    initULogin: function()
    {
        window.uloginCallback = function(token) {
            jQuery.getJSON("//ulogin.ru/token.php?host=" + encodeURIComponent(location.toString()) + "&token=" + token + "&callback=?", function(data) {
                console.log(data);
                jQuery.ajax({
                    type: "POST",
                    url: '/user/post-social',
                    data: jQuery.parseJSON(data.toString()),
                    dataType: 'json',
                    success: function(response) {
                        console.log(data);
                        if (response.status) {
                            //window.location.reload();
                        } else {
                            /*
                            toastr.success(response.error);
                            */
                            alert(response.error);
                        }
                    }
                });
            });
        }
    }, // end initULogin

    initSubmitCabinet: function()
    {
        var $validator = jQuery('#cabinet_form').validate({
            rules : {
                'last_name' : {
                    //required : true,
                    rangelength: [2, 32]
                },
                'first_name' : {
                    //required : true,
                    rangelength: [2, 32]
                },
                'email' : {
                    required : true,
                    rangelength: [6, 32],
                    email: true
                }
            },

            messages : {
                'last_name' : {
                    //required : 'Поле Ваша фамилия обязательно для заполнения',
                    rangelength: 'Поле Ваша фамилия должно хранить от 2 до 32 символов'
                },
                'first_name' : {
                    //required : 'Поле Ваше имя обязательно для заполнения',
                    rangelength: 'Поле Ваше имя должно хранить от 2 до 32 символов'
                },
                'email' : {
                    required : 'Поле Электронный адрес обязательно для заполнения',
                    rangelength: 'Поле Электронный адрес должно хранить от 6 до 32 символов',
                    email: 'Значение Электронный адрес имеет неверный формат'
                }
            },

            submitHandler : function(form) {
                jQuery('#profile_submit_result_success').hide();
                jQuery('#profile_submit_result_fail').hide();

                var values = jQuery(form).serializeArray();

                jQuery.ajax({
                    type: "POST",
                    url: '/user/post-edit',
                    data: jQuery('#cabinet_form').serializeArray(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            jQuery('#profile_submit_result_success').show(500);
                        } else {
                            jQuery('#profile_submit_result_fail').show(500);

                            jQuery.each(response.errors, function(key, value) {
                                alert(value);
                            });
                        }
                    }
                });
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });
    }
};


jQuery(document).ready(function() {
    User.init();
});
