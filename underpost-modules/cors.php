<?php

if(!class_exists('logger')){ include 'c:/dd/php-dev-http-server/underpost-modules/logger.php'; }

// https://programmierfrage.com/items/cors-cross-origin-resource-sharing-origin-validation-failure

class cors {
    function validate($allowed_domains){
        global $logger;

        if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
            $origin = $_SERVER['HTTP_ORIGIN'];
        } else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
            $origin = $_SERVER['HTTP_REFERER'];
        } else {
            $origin = $_SERVER['REMOTE_ADDR'];
        }

        // add '::1' ?
        if(substr($origin, -1) == "/"){
            $origin = substr($origin, 0, -1);
        }
        
        if (in_array($origin, $allowed_domains)) {
            // $logger->color("cyan", "success CORS, origin: ".$origin);
            return true;
        }else{
            // $logger->color("red", "error CORS, origin: ".$origin);
            return false;
        }

    }
}

$cors = new cors();


















?>