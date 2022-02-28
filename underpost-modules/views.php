<?php





if(!class_exists('files')){ include 'c:/dd/php-dev-http-server/underpost-modules/files.php'; }
if(!class_exists('logger')){ include 'c:/dd/php-dev-http-server/underpost-modules/logger.php'; }

class views  {

  function buildMymeType($staticPath = ".html"){
    $ext =  explode(".", $staticPath);
    switch (array_pop($ext)) {
      case 'js':
        return 'application/javascript';
      case 'css':
        return 'text/css';
      default:
        return 'text/html';
    }
  }

  function responseStatic($dataRender, $staticPath){
    header('Content-Type: '.$this->buildMymeType($staticPath).'; charset='.$dataRender->charset);
    exit(file_get_contents($staticPath));
  }

  function renderStatic($dataRender, $path){
    global $files;
    foreach ($dataRender->statics as $staticDir) {
      foreach ($files->recursiveIteratorDirectory($staticDir) as $staticPath) {
        ( (".".$path) == $staticPath ) ? $this->responseStatic($dataRender, $staticPath) : null;
      }
    }
  }

  function renderInfo($dataRender, $path){
    header('Content-Type: '.$this->buildMymeType().'; charset='.$dataRender->charset);
    switch ($path) {
      case '/info-server':
        echo '<pre>';
        var_dump($_SERVER);
        echo '</pre>';
        exit();
      case '/info':
        phpinfo();
        exit();
    }
  }

  function renderError($dataRender, $status){
    header('Content-Type: '.$this->buildMymeType().'; charset='.$dataRender->charset);
    exit(' Error '.$status);
  }

  function renderViews($dataRender){

    // foreach ($dataRender->$views as $viewData) {
    //
    // }


  }

}

$views = new views();






 ?>
