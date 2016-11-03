<?php

class Authentication
{

    const PASSWD_CRYPTED = FALSE;
    public static $fieldRol = "";

    public static function login($username, $password)
    {
        $usuarios = new User();
        $user = $usuarios->where("email", $username)->first();
        if (!$user->error) {
            if (self::PASSWD_CRYPTED) {
                if (Crypter::verify($user->fields->password, $password)) {
                    Session::doLogin($user);
                    return true;
                }
            } else if ($user->fields->password == $password) {
                Session::doLogin($user);
                return true;
            }
        }
        return false;
    }

    public static function user()
    {
        $user = Session::getUser();
        return $user;
    }

    public static function isLogged()
    {
        return Session::getUser() != null;
    }

    public static function logout()
    {
        Session::doLogout();
        return true;
    }

} 