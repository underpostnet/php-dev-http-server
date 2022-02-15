<?php



if(!class_exists('files')){ include 'c:/dd/php-dev-http-server/underpost-modules/files.php'; }
if(!class_exists('logger')){ include 'c:/dd/php-dev-http-server/underpost-modules/logger.php'; }

class jpgreduce  {
function reduceRecursiveJPG($folderPath, $quality = 20 /* 100% to 0 % quality */){
    global $files;
    global $logger;
    foreach ($files->recursiveIteratorDirectory($folderPath) as $path) {
      if(mime_content_type($path)=='image/jpeg'){
        $name_file = end(explode('/', $path));
        $logger->log(' valid jpg image -> '.$name_file);
        imagejpeg(imagecreatefromjpeg($path), $path, $quality);
      }else{
        $logger->log(' invalid jpg image -> '.$path);
      }
    }
  }
}

$jpgreduce = new jpgreduce();



 ?>
