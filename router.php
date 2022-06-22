<?php

declare(strict_types=1);

include 'c:/dd/php-dev-http-server/underpost-modules/logger.php';
include 'c:/dd/php-dev-http-server/underpost-modules/views.php';

/*

      The server router will be update automatic
      if detect changes in this script.

*/

$pathApp = "c:/dd/deploy_area/palikos";

$dataEnv = json_decode(file_get_contents($pathApp.'/data/env.json'));
$dataRender = json_decode(file_get_contents($pathApp.'/data/render.json'));
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

date_default_timezone_set($dataEnv->timezone);

// $logger->log($_SERVER, true);
// $logger->log($_SERVER);

// https://www.php.net/manual/en/reserved.variables.php
// get_class_methods()

// $logger->mute();
// php.init -> output_buffering = off

if(!$dataEnv->dev){
  $logger->mute();
}else{
  $dataRender->baseUri = "";
}

$logger->color('white-green',' ON REQUEST -> '.$path);

$initScript = function ($uriView, $dataRender){
        global $logger;
        $logger->color('yellow',' initScript $uriView -> '.$uriView);
        return " 
          <script>
          var baseUri = '".$dataRender->baseUri."';
          </script>
        ";
};

// echo $path;

switch ($path) {
  case ($dataRender->baseUri."/hello/"):
    header('Content-Type: '.$views->buildMymeType().'; charset='.$dataRender->charset);
    echo 'Hello World';
    break;
  default:
    ( $dataEnv->dev ) ? $views->renderInfo($dataRender, $path) : null;
    $views->renderViews($dataRender, $dataEnv, $path, $initScript);
    $views->renderStatic($dataRender, $path);
    $logger->color('white-red',' ERROR REQUEST -> '.$path);
    $views->renderError($dataRender, 404);
}


?>
