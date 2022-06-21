<?php

declare(strict_types=1);

include './underpost-modules/logger.php';
include './underpost-modules/files.php';

$dataEnv = json_decode(file_get_contents('./data/env.json'));
$dataRender = json_decode(file_get_contents('./data/render.json'));

$nameRelease = "./release";
if(file_exists($nameRelease)){
    $logger->log("delete old ${nameRelease}");
    $files->recursiveDeleteDirectory($nameRelease);
}
$logger->log("create ${nameRelease}");
mkdir("${nameRelease}");   














?>