<?php

// exist - write(update/create) - delete - rename

// file_exists($path_test)

// rename("/tmp/fichero_tmp.txt", "/home/user/login/docs/mi_fichero.txt");

/*

$file = fopen('./test.json', "w");
fwrite($file, json_encode($json, JSON_PRETTY_PRINT));
fclose($file);

// json_decode option enable edit -> , true
json_decode(file_get_contents( "./domains.json" ));

*/

if(!class_exists('logger')){ include 'c:/dd/php-dev-http-server/underpost-modules/logger.php'; }

class files {

  function recursiveCopyDirectory($src, $dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                $this->recursiveCopyDirectory($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
  }

  function recursiveDeleteDirectory($dir) {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
            $this->recursiveDeleteDirectory($dir. DIRECTORY_SEPARATOR .$object);
          else
            unlink($dir. DIRECTORY_SEPARATOR .$object);
        }
      }
      rmdir($dir);
    }
  }
  
  function recursiveIteratorDirectory($path, $paths = []){
    global $logger;
    if (is_dir($path)) {
      if ($dh = opendir($path)) {
        while (($file = readdir($dh)) !== false) {
          $new_path = $path . '/' . $file;
          if (is_dir($new_path) && $file!='.' && $file!='..'){
              $paths = array_merge($paths, $this->recursiveIteratorDirectory($new_path, $paths));
          }else{
            if($file!='.' && $file!='..'){
              array_push($paths, $new_path);
            }
          }
        }
        closedir($dh);
      }
    }else{
      $logger->log(' Directory not found ');
    }
    return array_unique($paths);
  }
}

$files = new files();

 ?>
