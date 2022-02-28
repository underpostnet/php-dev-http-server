<?php

// get data env
$dataEnv = json_decode(file_get_contents('./data/env.json'));

// check javascript client side render library
if(!is_dir('./underpost-library')){
  exec('git clone https://github.com/underpostnet/underpost-library');
}else {
  chdir('./underpost-library');
  exec('git pull origin master');
  chdir('../');
}

// update server
exec('git pull origin master');

// clean server port
exec('npx kill-port '.$dataEnv->httpServer->port);

// init server with router
// $dataEnv->startConsole
exec('php -S localhost:'.$dataEnv->httpServer->port.' '.$dataEnv->httpServer->router.' -c ./php.ini');
// exec('php -S localhost:8000 -t ./static -c ./php.ini');


 ?>
