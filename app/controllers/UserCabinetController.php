<?php

use Cartalyst\Sentry\Users\UserNotFoundException,
    Cartalyst\Sentry\Users\WrongPasswordException,
    Cartalyst\Sentry\Users\UserExistsException;

class UserCabinetController extends BaseController
{
    public function __construct()
    {
        $params = array(
            'only' => array(
                'showCabinet',
                'showFavourites',
                'doUserEdit',
                'doUploadImage',
            )
        );
        $this->beforeFilter('user_auth', $params);
    } // end __construct
    
    public function doUserLogin()
    {
        $data = array(
            'email'    => Input::get('login_email'),
            'password' => Input::get('login_password')
        );

        try {
            $result = Sentry::authenticate($data, Input::has('login_remember'));
        } catch(WrongPasswordException $e) {
            $data = array(
                'status' => false,
                'errors' => array(
                    'Пользователя с такими данными не существует. Проверьте введенные данные, пожалуйста.'
                )
            );
            return Response::json($data);
        } catch(UserNotFoundException $e) {
            $data = array(
                'status' => false,
                'errors' => array(
                    'Пользователя с такими данными не существует. Проверьте введенные данные, пожалуйста.'
                )
            );
            return Response::json($data);
        }
        
        return Response::json(
            array('status' => $result)
        );
    } // end doUserLogin

    public function doUserPageLogin()
    {
        $data = array(
            'email'    => Input::get('login_page_email'),
            'password' => Input::get('login_page_password')
        );

        try {
            $result = Sentry::authenticate($data, Input::has('login_page_remember'));
        } catch(WrongPasswordException $e) {
            $data = array(
                'status' => false,
                'errors' => array(
                    'Пользователя с такими данными не существует. Проверьте введенные данные, пожалуйста.'
                )
            );
            return Response::json($data);
        } catch(UserNotFoundException $e) {
            $data = array(
                'status' => false,
                'errors' => array(
                    'Пользователя с такими данными не существует. Проверьте введенные данные, пожалуйста.'
                )
            );
            return Response::json($data);
        }

        return Response::json(array(
                'status'    => $result,
                'link'      => URL::to('user/cabinet')
            )
        );
    } // end doUserPageLogin

    public function doUserLogout()
    {
        Sentry::logout();

        return Response::json(array());
    } // end doUserLogout

    public function doRegister()
    {
        $email = Input::get('register_email');
        //$password = Input::get('register_password');
        //$firstName = Input::get('register_first_name');
        //$lastName = Input::get('register_last_name');

        $validator = Validator::make(
            array(
                'register_email'        => $email,
                /*
                'register_password'     => $password,
                'register_first_name'   => $firstName,
                'register_last_name'    => $lastName
                */
            ),
            array(
                'register_email'        => 'required|email|min:6|max:32',
                /*
                'register_password'     => 'required|min:6|max:16',
                'register_first_name'   => 'required|min:2|max:32|alpha_dash',
                'register_last_name'    => 'required|min:2|max:32|alpha_dash'
                */
            )
        );

        if ($validator->fails()) {
            $data = array(
                'status' => false,
                'errors' => $validator->messages()->all()
            );
            return Response::json($data);
        }

        try {
            $user = Sentry::createUser(array(
                'email'             => $email,
                'password'          => rand(0, 10000),
                /*
                'first_name'        => $firstName,
                'last_name'         => $lastName,
                */
                'activated'         => 0
            ));

            $activationCode = $user->getActivationCode();

            $mailData = array(
                'user' => array(
                    'full_name' => $user->getFullName()
                ),
                'link' => URL::to('/') . '/user/activate/' . $activationCode
            );

            MailTemplate::ident('activate_user')->send($email, $mailData);

            return Response::json(array(
                'status'    => true
            ));
        } catch (UserExistsException $e) {
            $data = array(
                'status' => false,
                'errors' => array(
                    'Пользователь с таким Email уже существует. Введите, пожалуйста, другой Email.'
                )
            );
            return Response::json($data);
        }
    } // end doRegister

    public function showUserActivate($code)
    {
        try {
            $user = Sentry::findUserByActivationCode($code);
        } catch(UserNotFoundException $e) {
            App::abort('404');
        }

        return View::make('user.activate')->render();
    } // end showUserActivate

    public function doUserActivate($code)
    {
        try {
            $user = Sentry::findUserByActivationCode($code);

            $user->attemptActivation($code);

            if ($user->isActivated()) {
                $user->password = Input::get('password');
                $user->save();

                Sentry::login($user);

                $data = array(
                    'status'    => true,
                    'link'      => URL::to('user/cabinet')
                );
                return Response::json($data);
            }
        } catch(UserNotFoundException $e) {
            App::abort('404');
        }
    } // end doUserActivate

    public function doReset()
    {
        $email = Input::get('reset_email');

        $validator = Validator::make(
            array('email' => $email),
            array('email' => 'required|email|min:6|max:32')
        );

        if ($validator->fails()) {
            $data = array(
                'status' => false,
                'errors' => $validator->messages()->all()
            );
            return Response::json($data);
        }

        try {
            $user = Sentry::findUserByLogin($email);
            $resetCode = $user->getResetPasswordCode();

            $mailData = array(
                'user' => array(
                    'full_name' => $user->getFullName()
                ),
                'link' => URL::to('/') . '/user/recover/' . $resetCode
            );

            MailTemplate::ident('recover_password')->send($email, $mailData);

            return Response::json(array(
                'status'    => true
            ));
        } catch (UserNotFoundException $e) {
            $data = array(
                'status' => false,
                'errors' => array(
                    'Пользователя с таким Email не существует.'
                )
            );
            return Response::json($data);
        }
    } // end doReset

    public function showUserRecover($code)
    {
        $user = null;

        try {
            $user = Sentry::findUserByResetPasswordCode($code);
        } catch (UserNotFoundException $e) {
            if (!$user) {
                App::abort('404');
            }
        }

        return View::make('user.recover')->render();
    } // end showUserRecover

    public function doUserRecover($code)
    {
        $password = Input::get('new_password');
        $confirmPassword = Input::get('new_password_confirm');

        $validator = Validator::make(
            array(
                'new_password' => $password,
                'new_password_confirm'  => $confirmPassword
            ),
            array(
                'new_password' => 'required|min:6|max:16',
                'new_password_confirm' => 'required|min:6|max:16|same:new_password',
            )
        );

        if ($validator->fails()) {
            $data = array(
                'status' => false,
                'errors' => $validator->messages()->all()
            );
            return Response::json($data);
        }

        $user = null;

        try {
            $user = Sentry::findUserByResetPasswordCode($code);

            if ($user->attemptResetPassword($code, $password)) {
                $data = array(
                    'status' => true,
                    'link' => URL::to('user/cabinet'),
                );
            } else {
                $data = array(
                    'status' => false,
                    'errors' => array(
                        'Произошла ошибка во время установки нового пароля.'
                    )
                );
            }

            return Response::json($data);
        } catch (UserNotFoundException $e) {
            App::abort('404');
        }
    } // end doUserRecover

    public function doUserLoginBySocial()
    {
        try {
            $user = Sentry::findUserByLogin(Input::get('email'));
        } catch (UserNotFoundException $e) {
            $isEmailVerified = $this->doCreateUser();

            $data = array(
                'status' => $isEmailVerified,
                'error' => 'Осталось только подтвердить имейл, перейдя по ссылке из письма'
            );
            return Response::json($data);
        }

        if ($user->isActivated()) {
            User::login($user);
        }

        $data = array(
            'status' => $user->isActivated(),
            'error' => 'Сначала нужно подтвердить имейл, перейдя по ссылке из письма'
        );
        return Response::json($data);
    } // end doUserLoginBySocial
    
    public function showLogin()
    {
        if (Sentry::check()) {
            return Redirect::to('/user/cabinet');
        }
         
        return View::make('user.login');
    } // end showLogin

    public function showCabinet()
    {
        $user = Sentry::getUser();

        if (!$user) {
            return Redirect::to('login');
        }

        Sentry::login($user);

        $results = DB::table('check_logs')
            ->where('id_user', Sentry::getUser()->id)
            ->get();

        foreach ($results as $key => $value) {
            $results[$key]['log'] = json_decode($value['log'], true);
        }

        return View::make(
            'user.cabinet',
            compact('results', 'user')
        )->render();
    } // end showCabinet

    public function doUserEdit()
    {
        $user = Sentry::getUser();

        $validator = Validator::make(
            array(
                'email'         => Input::get('email'),
                'first_name'    => Input::get('first_name'),
                'last_name'     => Input::get('last_name')
            ),
            array(
                'email'         => 'required|email|min:6|max:32',
                'first_name'    => 'min:2|max:32|alpha',
                'last_name'     => 'min:2|max:32|alpha'
            )
        );

        if ($validator->fails()) {
            $data = array(
                'status' => false,
                'errors' => $validator->messages()->all()
            );
            return Response::json($data);
        }

        if (Input::has('old_pass')) {
            if (!Hash::check(Input::get('old_pass'), $user->password)) {
                $data = array(
                    'status' => false,
                    'errors' => array(
                        'old_pass' => 'Старый пароль введен неверно!'
                    )
                );
                return Response::json($data);
            }

            $emailValidator = Validator::make(
                array(
                    'old_pass' => Input::get('old_pass'),
                    'new_pass' => Input::get('new_pass'),
                ),
                array(
                    'old_pass' => 'required',
                    'new_pass' => 'required|min:6|max:16',
                )
            );

            if ($emailValidator->fails()) {
                $data = array(
                    'status' => false,
                    'errors' => $emailValidator->messages()->all()
                );
                return Response::json($data);
            }

            $user->password = Input::get('new_pass');
        }

        $user->email = Input::get('email');
        $user->first_name  = Input::get('first_name');
        $user->last_name  = Input::get('last_name');
        $user->phones = Input::get('phones');
        $user->address = Input::get('address');

        $user->save();

        $data = array(
            'status' => true
        );

        return Response::json($data);
    } // end doUserEdit

    private function doCreateUser()
    {
        $image = '/storage/user_social_avatars/'. md5(Input::get('email')) .'.jpg';
        file_put_contents(public_path() . $image, file_get_contents(Input::get('photo')));

        $pass = str_random(12);
        $isEmailVerified = Input::get('verified_email') == -1 ? false : true;
        $user = Sentry::createUser(array(
            'email'      => Input::get('email'),
            'password'   => $pass,
            'image'      => $image,
            'first_name' => Input::get('first_name'),
            'last_name'  => Input::get('last_name'),
            'activated'  => $isEmailVerified
        ));

        $mailData = array(
            'user' => array(
                'full_name'       => $user->getFullName(),
                'activation_code' => $user->getActivationCode()
            ),
            'pass' => $pass
        );

        $template = $isEmailVerified ? 'verified_social_email': 'non_verified_social_email';

        MailTemplate::ident($template)->send(Input::get('email'), $mailData);

        return $isEmailVerified;
    } // end doCreateUser

    public function doLoginRequestVk()
    {
        return LarOAuth::vk()->sendLoginRequest();
    }

    public function doHandleRequestVk()
    {
        return LarOAuth::vk()->handleLogin();
    }

    public function doLoginRequestFb()
    {
        return LarOAuth::fb()->sendLoginRequest();
    }

    public function doHandleRequestFb()
    {
        return LarOAuth::fb()->handleLogin();
    }

    public function doLoginRequestGoogle()
    {
        return LarOAuth::google()->sendLoginRequest();
    }

    public function doHandleRequestGoogle()
    {
        return LarOAuth::google()->handleLogin();
    }
}
