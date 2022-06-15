<?php

class logger {

  function log($str, $dump = false){
    if($this->mute){
      return;
    }
    ob_start();
    $dump ? var_dump($str) : print_r($str);
    error_log(ob_get_clean(), 4);
  }

  public function __construct(){
    $this->dataColor = json_decode(file_get_contents('./data/colors.json'));
    $this->mute = false;
  }
  // http://www.unixwerk.eu/unix/ansicodes.html

  function color($color = "white-black", $str){
    if($this->mute){
      return;
    }
    $dc_ = explode("-", $color);
    $codeTX = $dc_[0];
    $codeBG = (array_key_exists(1, $dc_)) ? $dc_[1] : "black";
    $this->log("\033[1;".$this->dataColor->text->$codeTX.";".$this->dataColor->background->$codeBG."m".$str."\033[0m\n");
  }

  function mute(){
    $this->mute = true;
  }

}

$logger = new logger();

 ?>
