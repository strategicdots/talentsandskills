<?php include_once("includes/initialize.php");

$uri = trim($_SERVER['REQUEST_URI'], '/');

// remember in production, change to talentandskills
// instead of talents

if (strpos($uri, 'talents/') !== true) {
      $uri = str_replace('talents/', '', $uri);
}

$router = new Router();

require 'routes.php';

require $router->direct($uri);