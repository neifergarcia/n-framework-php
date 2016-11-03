<?php
$classesDir = array (
    KERNEL,
    KERNEL . 'auth/',
    KERNEL . 'database/',
    CONTROLLERS,
    TABLES
);

function loadclasses($nombre_clase){
    global $classesDir;
    foreach ($classesDir as $directory) {
        if (file_exists($directory . $nombre_clase . '.php')) {
            require_once ($directory . $nombre_clase . '.php');
            return;
        }
    }
}

spl_autoload_register("loadclasses");

require_once KERNEL . 'Route.php';

require './../public_html/route.php';