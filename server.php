<?php

exec('npx kill-port 8000');

exec('php -S localhost:8000 router.php -c ./php.ini');


 ?>
