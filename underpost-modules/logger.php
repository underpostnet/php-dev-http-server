<?php

function logger($str, $dump = false){
  ob_start();
  $dump ? var_dump($str) : print_r($str);
  error_log(ob_get_clean(), 4);
}

 ?>
