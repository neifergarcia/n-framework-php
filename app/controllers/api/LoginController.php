<?php
/**
 * Created by PhpStorm.
 * User: ENESOFTEC
 * Date: 14/04/16
 * Time: 12:22 AM
 */

class LoginController extends Controller {

    public function login(Request $request){
        $username = $request->input("username");
        $password = $request->input("password");

        if(Authentication::login($username, $password)){
            return json_encode(array("success", "User Logged"));
        }

        return json_encode(array("error", "No se reconocen los datos de acceso"));
    }

    public function logout(){
        return json_encode(array("success", Authentication::logout()));
    }
} 