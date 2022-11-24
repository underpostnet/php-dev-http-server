<?php

declare(strict_types=1);

include 'c:/dd/php-dev-http-server/underpost-modules/logger.php';
include 'c:/dd/php-dev-http-server/underpost-modules/views.php';
include 'c:/dd/php-dev-http-server/underpost-modules/cors.php';
include 'c:/dd/php-dev-http-server/underpost-modules/mailer.php';

/*

      The server router will be update automatic
      if detect changes in this script.

*/

// https://github.com/nicolauns/hunter-php-javascript-obfuscator

$pathApp = "c:/dd/php-dev-http-server";

$dataEnv = json_decode(file_get_contents($pathApp . '/data/env.json'));
$dataRender = json_decode(file_get_contents($pathApp . '/data/render.json'));


$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

date_default_timezone_set($dataEnv->timezone);

// $logger->log($_SERVER, true);
// $logger->log($_SERVER);

// https://www.php.net/manual/en/reserved.variables.php
// get_class_methods()

// $logger->mute();
// php.init -> output_buffering = off

// cors validator

// full build html

if (!$dataEnv->dev) {
  $logger->mute();
}

if (!$dataEnv->baseUri) {
  $dataRender->baseUri = "";
}


$logger->color('white-green', 'ON ' . $_SERVER['REQUEST_METHOD'] . ' REQUEST ' . $path);

// origins
$devHost = $dataEnv->httpServer->host . ":" . $dataEnv->httpServer->port;
$prodHost = $dataEnv->httpServer->prodHost;

$initScript = function ($uriView, $dataRender) {
  global $logger;
  global $pathApp;
  global $dataEnv;
  global $cors;
  global $prodHost;
  global $mailer;
  $logger->color('yellow', ' initScript $uriView -> ' . $uriView);

  $fontAwesome = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
 
  return " 
          " . $fontAwesome . "
          <style>
            " . file_get_contents($pathApp . "/underpost-library/spinner/" . $dataRender->spinner . "/index.min.css") . "
          </style>
          <script>
          window._baseUri = '" . $dataRender->baseUri . "';
          window._dev = " . ($dataEnv->dev ? 'true' : 'false') . ";
          window._spinner = `" . file_get_contents($pathApp . "/underpost-library/spinner/" . $dataRender->spinner . "/index") . "`;
          </script>
        ";
};

// echo $path;

if ($path != $dataRender->baseUri . "/" && substr($path, -1) == "/") {
  $path = substr($path, 0, -1);
}

switch ($path) {
  case ($dataRender->baseUri . "/hello"):
    header('Content-Type: ' . $views->buildMymeType() . '; charset=' . $dataRender->charset);
    echo 'Hello World';
    break;
  default:
    ($dataEnv->dev) ? $views->renderInfo($dataRender, $path) : null;
    $views->renderViews($dataRender, $dataEnv, $path, $initScript);
    $views->renderStatic($dataRender, $path);
    $logger->color('white-red', ' ERROR REQUEST -> ' . $path);
    $views->renderError($dataRender, 404);
}
