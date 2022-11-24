<?php

declare(strict_types=1);

include 'c:/dd/php-dev-http-server/underpost-modules/logger.php';
include 'c:/dd/php-dev-http-server/underpost-modules/files.php';

$dataEnv = json_decode(file_get_contents('./data/env.json'));
$dataRender = json_decode(file_get_contents('./data/render.json'));

$destFolderRelease = ( $dataEnv->dev ? $dataRender->buildFolder : $dataRender->buildProdFolder );

if(file_exists($destFolderRelease)){
    $logger->color("green-black", "delete old ${destFolderRelease}");
    $files->recursiveDeleteDirectory($destFolderRelease);
}

// exit();

$logger->color("green-black", "create ${destFolderRelease}");
mkdir("${destFolderRelease}");   


foreach ($dataRender->statics as $staticPath) {
    $logger->color("green-black", "recursiveCopyDirectory ${staticPath}");
    $files->recursiveCopyDirectory($staticPath, $destFolderRelease.substr($staticPath, 1));
}

foreach ($dataRender->ignore as $ignorePath) {
    $uri = $destFolderRelease.substr($ignorePath, 1);
    $logger->color("green-black", "recursiveDeleteDirectory ${uri}");
    $files->recursiveDeleteDirectory($uri);
}



function createFileView($uri){
    global $logger;
    $logger->color("green-black", "create folder view path ${uri}");
    if(!file_exists($uri)){
        mkdir($uri);
    }
    copy("./router.php", $uri."/index.php");
}

foreach ($dataRender->views as $viewPath) {
    $uri = $destFolderRelease.$viewPath->uri;
    createFileView($uri);
    if(isset($viewPath->paths)){        
        switch ($viewPath->paths->type) {
          case 'shop':
            $dataSubPaths = json_decode(file_get_contents(".".$viewPath->paths->data));
            foreach ($dataSubPaths as $dataItemShop) {
                $uri = $destFolderRelease.$dataItemShop->path;
                createFileView($uri);
            }
            break;
        }
      }  
}

foreach ($dataRender->api as $apiPath) {
    $uri = $destFolderRelease.$apiPath;
    $logger->color("green-black", "create folder api path ${uri}");
    if(!file_exists($uri)){
        mkdir($uri);
    }
    copy("./router.php", $uri."/index.php");
}

$uri = $destFolderRelease."/.well-known";
$logger->color("green-black", "create folder ssl path ${uri}");
mkdir($uri);

?>