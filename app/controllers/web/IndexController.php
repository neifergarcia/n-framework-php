<?php

/**
 * Created by PhpStorm.
 * User: ENE
 * Date: 7/03/16
 * Time: 17:16
 */


class IndexController extends Controller
{
    public function __construct(){
        //$this->auth = true;
    }

    public function index(){
        return $this->view("index");
    }

    //Login
    public function showLogin(){
        return $this->view("login");
    }
}
