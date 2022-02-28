<?php

class logger {
  function log($str, $dump = false){
    ob_start();
    $dump ? var_dump($str) : print_r($str);
    error_log(ob_get_clean(), 4);
  }
  // http://www.unixwerk.eu/unix/ansicodes.html
  function yellowOverRed($str){
    $this->log("\033[1;33;41m".$str."\033[0m\n");
  }
}
$logger = new logger();

 ?>
