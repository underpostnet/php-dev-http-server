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
    $this->dataColor = json_decode('{
      "text":{
         "black":"30",
         "red":"31",
         "green":"32",
         "yellow":"33",
         "blue":"34",
         "magenta":"35",
         "cyan":"36",
         "white":"37",
         "default":"39"
      },
      "background":{
         "black":"40",
         "red":"41",
         "green":"42",
         "yellow":"43",
         "blue":"44",
         "magenta":"45",
         "cyan":"46",
         "white":"47",
         "default":"49"
      }
   }');
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
