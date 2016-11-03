<?php
/**
 * Created by PhpStorm.
 * User: ENE
 * Date: 7/03/16
 * Time: 20:05
 */



class Controller
{

    protected $title = "";
    protected $folder = "";

    protected $auth = false;

    private function validarAuth($next)
    {
        if($this->auth && $next != "register"){
            try{
                $auth = new Authentication();
                if($auth->user() == null){
                    $this->redirect("login");
                }
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
    }

    protected function view($path, $args = null)
    {

        if($path != "login"){
            $this->validarAuth($path);
        }else{
            $auth = new Authentication();
            if($auth->user() != null){
                $this->redirect();
            }
        }
        $path = $this->folder . "/" . $path;
        return array("path" => VIEWS . $path . ".ene.php", "title" => $this->title, "args" => $args);
    }

    protected function redirect($url = "", $args = null)
    {
        header("Location: ". URLWEB . $url);
    }

}