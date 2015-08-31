<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User extends SentryUserModel  implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait;

    protected $table = 'users';
    protected $hidden = array('password', 'remember_token');

    public function getFullName()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    } // end getFullName

    public function getPhones()
    {
        return explode('|', $this->phones);
    } // end getPhones

    public function getDeliveryAddresses()
    {
        return explode('|', $this->delivery_address);
    } // end getDeliveryAddresses

    public function getPointsCount()
    {
        return $this->points;
    } // end getPointsCount

    public static function login($user, $remember = false)
    {
        $res = Sentry::login($user, $remember);

        return $res;
    } // end login

    public static function logout()
    {
        $res = Sentry::logout();

        return $res;
    } // end logout
}
