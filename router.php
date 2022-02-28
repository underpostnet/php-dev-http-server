<?php

declare(strict_types=1);

include './underpost-modules/logger.php';
include './underpost-modules/views.php';

/*

      The server router will be update automatic
      if detect changes in this script.

*/

$dataEnv = json_decode(file_get_contents('./data/env.json'));
$dataRender = json_decode(file_get_contents('./data/render.json'));
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// $logger->log($_SERVER, true);
// $logger->log($_SERVER);

// https://www.php.net/manual/en/reserved.variables.php
// get_class_methods()

$logger->yellowOverRed(' ON REQUEST -> '.$path);

switch ($path) {
  case '/test':
    header('Content-Type: '.$views->buildMymeType().'; charset='.$dataRender->charset);
    echo 'Hello World';
    break;
  default:
    ( $dataEnv->dev ) ? $views->renderInfo($dataRender, $path) : null;
    $views->renderViews($dataRender, $path);
    $views->renderStatic($dataRender, $path);
    $views->renderError($dataRender, 404);
}


?>
