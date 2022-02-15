<?php


// exist - write(update/create) - delete - rename

// recursive iterator

/*

function recursiveIteratorDirectory($ruta){
  if (is_dir($ruta)) {
    if ($dh = opendir($ruta)) {
      while (($file = readdir($dh)) !== false) {

        $path = $ruta . $file;


        if (is_dir($ruta . $file) && $file!='.' && $file!='..'){

          recursiveIteratorDirectory($ruta . $file . '/');

        }
      }
      closedir($dh);
    }
  }
}

*/


 ?>
