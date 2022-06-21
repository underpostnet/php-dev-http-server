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
      case 'png':
        return 'image/png';
      case 'jpg':
        return 'image/jpg';
      case 'html':
        return 'text/html';
      default:
        return 'application/octet-stream';
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


  function buildUrl($dataEnv, $uri){
    if($dataEnv->dev){
      return $dataEnv->httpServer->host.':'.$dataEnv->httpServer->port.$uri;
    }
    return $dataEnv->httpServer->prodHost.$uri;
  }

  function renderViews($dataRender, $dataEnv, $path, $initScript){
    global $logger;
    foreach ($dataRender->views as $viewData) {
      if($viewData->uri === $path){

        // iniciar session si no tiene libros cargar data en session por defecto
        

        header('Content-Type: '.$this->buildMymeType().'; charset='.$dataRender->charset);
        $render = "

        <!DOCTYPE html>
        <html dir='".$viewData->dir."' lang='".$viewData->lang."'>
          <head>
              <meta charset='".$dataRender->charset."'>
              <!-- json-ld -->
              <title>".$viewData->title."</title>
              <link rel='canonical' href='".$this->buildUrl($dataEnv, $viewData->uri)."'>
              <link rel='icon' type='image/png' href='".$this->buildUrl($dataEnv, $viewData->favicon)."'>
              <meta name ='title' content='".$viewData->title."'>
              <meta name ='description' content='".$viewData->description."'>
              <meta name='author' content='".$dataEnv->author."'>
              <meta property='og:title' content='".$viewData->title."'>
              <meta property='og:description' content='".$viewData->description."'>
              <meta property='og:image' content='".$this->buildUrl($dataEnv, $viewData->image)."'>
              <meta property='og:url' content='".$this->buildUrl($dataEnv, $viewData->uri)."'>
              <meta name='twitter:card' content='summary_large_image'>
              <meta name='viewport' content='initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
              <meta name='viewport' content='width=device-width, user-scalable=no'>
              <!-- font awesome
              <link rel='stylesheet' href='/underpost-library/css/all.min.css'>
              -->
              <link rel='stylesheet' href='/underpost-library/style/simple.css'>
              <link rel='stylesheet' href='/underpost-library/style/place-bar-select.css'>
              <!--
              <link rel='stylesheet' href='/underpost-library/fonts.css'>
              -->
              <script src='/underpost-library/util.js'></script>
              <script src='/underpost-library/vanilla.js'></script>
              ".$initScript($viewData->uri)."
              <script type='module' src='/views/".$viewData->render."'></script>
          </head>
          <body>
            <div style='display: none;'>
              <h1>".$viewData->title."</h1> <h2>".$viewData->description."</h2>
            </div>
          </body>
      </html>

        ";
        // carpetas en staticos con su index.
        exit($render);
      }
    }


  }

}

$views = new views();






 ?>
