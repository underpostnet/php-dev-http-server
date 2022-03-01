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

date_default_timezone_set($dataEnv->timezone);

// $logger->log($_SERVER, true);
// $logger->log($_SERVER);

// https://www.php.net/manual/en/reserved.variables.php
// get_class_methods()

$logger->color('white-green',' ON REQUEST -> '.$path);

switch ($path) {
  case '/test':
    header('Content-Type: '.$views->buildMymeType().'; charset='.$dataRender->charset);
    echo 'Hello World';
    break;
  case '/update-shop':
    header('Content-Type: application/json; charset='.$dataRender->charset);
    session_start();
    if(isset($_SESSION['books'])){
      $logger->color('white-cyan',' FETCH POST REQUEST -> '.$path);
      $_SESSION['books'] = json_decode( file_get_contents( 'php://input' ), true );
      exit('true');
    }else{
      $_SESSION['books'] = json_decode( file_get_contents( 'php://input' ), true );
      $logger->color("white-cyan", "GET ".$path." -> SET NEW SHOP DATA");
      exit('false');
    }
  case '/destroy-session':
    header('Content-Type: application/json; charset='.$dataRender->charset);
    $logger->color('white-cyan',' REST GET REQUEST -> '.$path);
    session_start();
    session_destroy();
    exit('true');
  case '/buy':
    header('Content-Type: application/json; charset='.$dataRender->charset);
    session_start();
    if(isset($_SESSION['books'])){
      $input = json_decode($_SESSION['books']);
      $logger->color('white-cyan',' FETCH POST REQUEST -> '.$path);
      $total = 0;
      foreach ($input as $book) {
        if($book->buy == true){
          $total = $total + $book->amount;
        }
      }
      if($total>0){
        $logger->color('white-yellow',' COMPRA EXITOSA -> TOTAL $ CLP:'.$total);
        session_destroy();
        exit('true');
      }else{
        session_destroy();
        exit('false');
      }
    }else{
      exit('false');
    }
  default:
    ( $dataEnv->dev ) ? $views->renderInfo($dataRender, $path) : null;
    $views->renderViews($dataRender, $dataEnv, $path);
    $views->renderStatic($dataRender, $path);
    $logger->color('white-red',' ERROR REQUEST -> '.$path);
    $views->renderError($dataRender, 404);
}


?>
