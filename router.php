<?php

declare(strict_types=1);

include './underpost-modules/logger.php';

/*

      The server router will be update automatic
      if detect changes in this script.

*/

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// logger($_SERVER, true);
// logger($_SERVER);

logger(' ON REQUEST -> '.$path);

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
