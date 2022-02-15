<?php

declare(strict_types=1);

include './underpost-modules/logger.php';

/*

      The server router will be update automatic
      if detect changes in this script.

*/

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);



// $logger->log($_SERVER, true);
// $logger->log($_SERVER);

// https://www.php.net/manual/en/reserved.variables.php
// get_class_methods()

$logger->log(' ON REQUEST -> '.$path);

switch ($path) {
  case '/':
    echo 'Hello World';
    break;
  case '/info':
    echo '<pre>';
    var_dump($_SERVER);
    echo '</pre>';
    break;
  default:
    echo 'default path -> '.$path;
    break;
}


?>
