<?php



if(!class_exists('files')){ include 'c:/dd/php-dev-http-server/underpost-modules/files.php'; }
if(!class_exists('logger')){ include 'c:/dd/php-dev-http-server/underpost-modules/logger.php'; }

class jpgreduce  {
function reduceRecursiveJPG($folderPath, $quality = 20 /* 100% to 0 % quality */){
    global $files;
    global $logger;
    foreach ($files->recursiveIteratorDirectory($folderPath) as $path) {
      $name_file = explode('/', $path);
      $name_file = end($name_file);
      $name_file = explode('.', $name_file);
      $name_file = $name_file[0];
      if(mime_content_type($path)=='image/jpeg'){
        $logger->log(' valid jpg file -> '.$path);
        imagejpeg(imagecreatefromjpeg($path), $path, $quality);
      }
      else if(mime_content_type($path)=='image/png'){
        $logger->log(' valid png file -> '.$path);

        $newPathJpg = explode('/', $path);
        array_pop($newPathJpg);
        $newPathJpg = implode('/', $newPathJpg);
        $newPathJpg = $newPathJpg . '/' . $name_file .'.jpg';

        $pngImage = imagecreatefrompng($path);
        $jpgImage = imagecreatetruecolor(imagesx($pngImage), imagesy($pngImage));
        imagefill($jpgImage, 0, 0, imagecolorallocate($jpgImage, 255, 255, 255));
        imagealphablending($jpgImage, TRUE);
        imagecopy($jpgImage, $pngImage, 0, 0, 0, 0, imagesx($pngImage), imagesy($pngImage));
        imagedestroy($pngImage);
        imagejpeg($jpgImage, $newPathJpg, $quality);

        $logger->log(' valid png to jpg parse file -> '.$newPathJpg);
      }else{
        $logger->log(' invalid file -> '.$path);
      }
    }
  }
}

$jpgreduce = new jpgreduce();



 ?>
