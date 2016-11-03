<?php

class Route
{

    protected static $GET;
    protected static $POST;
    protected static $URI;
    protected static $GO_URI;
    protected static $URIS = array();

    private static function addUri($uri)
    {
        $arr = self::$URIS;
        if (sizeof($arr) > 0) {
            foreach ($arr as $value) {
                if ($value != $uri) {
                    self::$URIS[sizeof($arr)] = $uri;
                }
            }
        } else {
            self::$URIS[0] = $uri;
        }
    }

    public static function validateUri()
    {
        $arr = self::$URIS;
        $uri = $_SERVER['REQUEST_URI'];
        $exist = false;

        foreach ($arr as $value) {
            if ($value == $uri) {
                $exist = true;
                break;
            }
        }

        if (!$exist) {
            self::showError(404);
        }
    }


    private static function init($go)
    {
        self::$GET = $_SERVER['REQUEST_METHOD'] == 'GET';
        self::$POST = $_SERVER['REQUEST_METHOD'] == 'POST';
        self::$URI = $_SERVER['REQUEST_URI'];
        self::$GO_URI = __DIR__ . $go . '.php';
    }

    private static function controller_func($func, $webservice = false)
    {
        $data = explode("@", $func);

        if (sizeof($data) > 1) {
            require_once KERNEL . 'Request.php';
            require_once CONTROLLERS . 'Controller.php';
            if ($webservice)
                require_once CONTROLLERS . 'api/' . $data[0] . '.php';
            else
                require_once CONTROLLERS . 'web/' . $data[0] . '.php';



            $function = $data[1];
            try {
                $class = new ReflectionMethod($data[0], $function);
                $mArgs = array();
                foreach ($_REQUEST as $key => $arg) {
                    if(is_array($arg))
                        $mArgs[$key] = $arg;
                    else
                        $mArgs[$key] = trim($arg);
                }
                $ret = $class->invokeArgs(new $data[0], array(new Request($mArgs)));;
                return $ret;
            } catch (Exception $e) {

                return false;
            }
        } else {
            return false;
        }
    }


    public static function get($inUri, $outUri, $webservice = false)
    {
        self::init($outUri);
        self::addUri($inUri);
        if (self::$GET) {
            if (self::$URI == $inUri) {
                try {
                    if (!$webservice) {
                        if ($ret = self::controller_func($outUri)) {
                            $TITLE_PAGE = $ret["title"]; //Titulo de la Pagina.
                            if ($ret['args'] != null)
                                foreach ($ret['args'] as $key => $value) {
                                    $$key = $value;
                                }
                            if (file_exists($ret["path"]))
                                require_once $ret["path"];
                            else
                                echo "No se encuentra la vista " . $ret["path"];
                        }else {
                            self::showError(404);
                        }
                    } else {
                        if ($ret = self::controller_func($outUri, true)) {
                            echo json_encode($ret);
                        }
                    }
                } catch (Exception $e) {
                    self::showError(404, $e);
                }
            }
        }
    }

    // @ $app : is request movil?
    public static function post($inUri, $outUri, $webservice = false)
    {
        self::init($outUri);
        self::addUri($inUri);
        if (self::$POST) {
            if (self::$URI == $inUri) {
                if (!$webservice) {
                    if ($ret = self::controller_func($outUri)) {
                        $TITLE_PAGE = $ret["title"]; //Titulo de la Pagina.
                        if ($ret['args'] != null)
                            foreach ($ret['args'] as $key => $value) {
                                $$key = $value;
                            }
                        if (file_exists($ret["path"]))
                            require_once $ret["path"];
                        else
                            echo "No se encuentra la vista " . $ret["path"];
                    } else{
                        self::showError(404);
                    }
                }else{
                    if ($ret = self::controller_func($outUri, true)) {
                        echo json_encode($ret);
                    }
                }
            }
        }
    }

    private static function showError($errno = 0, $message = "")
    {
        switch ($errno) {
            case 404:
                $TITLE_PAGE = "Error 404";
                $errorUrl = ERRORS . '404.php';
                break;
            default:
                $TITLE_PAGE = "Error Desconocido";
                $errorUrl = ERRORS . 'unknown.php';
        }
        require $errorUrl;
    }

} 