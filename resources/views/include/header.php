<!DOCTYPE HTML>
<html lang="es-ES">
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>N-Framework PHP</title>

    <!-- Style Main -->
    <link type="text/css" rel="stylesheet" href="<?php echo ASSETS ?>css/style.css" />

    <script src="/node_modules/zone.js/dist/zone.js"></script>
    <script src="/node_modules/reflect-metadata/Reflect.js"></script>
    <script src="/node_modules/systemjs/dist/system.src.js"></script>

        <!-- 2. Configure SystemJS -->
        <script src="systemjs.config.js"></script>
        <script>
            System.import('app').catch(function(err){ console.error(err); });
        </script>

</head>

