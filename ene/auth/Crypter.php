<?php

/*
 * How Use
 *  $crypt = new Crypt(15);
    $hash = $crypt->hash('password');
    $isGood = $crypt->verify('password', $hash);
 */
class Crypter {

    private static function bcrypt(){
        return new Bcrypt(15);
    }

    public static function hash($password){
        return self::bcrypt()->hash($password);
    }

    public static function verify($hashed, $password){
        return self::bcrypt()->verify($password, $hashed);
    }
}