<?php


// exist - write(update/create) - delete - rename

// recursive iterator



// delete recursive
/*
function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
           rrmdir($dir. DIRECTORY_SEPARATOR .$object);
         else
           unlink($dir. DIRECTORY_SEPARATOR .$object);
       }
     }
     rmdir($dir);
   }
 }



 copy recursiuve
 
 $source = "dir/dir/dir";
$dest= "dest/dir";

mkdir($dest, 0755);
foreach (
 $iterator = new \RecursiveIteratorIterator(
  new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
  \RecursiveIteratorIterator::SELF_FIRST) as $item
) {
  if ($item->isDir()) {
    mkdir($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathname());
  } else {
    copy($item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathname());
  }
}


 */

// file_exists($path_test)

// rename("/tmp/fichero_tmp.txt", "/home/user/login/docs/mi_fichero.txt");

/*

$file = fopen('./test.json', "w");
fwrite($file, json_encode($json, JSON_PRETTY_PRINT));
fclose($file);

// json_decode option enable edit -> , true
json_decode(file_get_contents( "./domains.json" ));



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
