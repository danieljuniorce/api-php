<?php
namespace Core;

class Core
{
  public function __construct()
  {
    $prefix = '\Controllers\\';
    $params = array();

    //retirando o index.php da url com a função explode;
    $url = explode('index.php', $_SERVER['PHP_SELF']);
    $url = end($url);

    $url = explode('/', $url);
    array_shift($url);

    if (!empty($url)) {
      $controller = $url[0].'Controller';
      \array_shift($url);

      if (isset($url[0])) {
        $action = $url[0];
        array_shift($url);

        if (count($url) > 0) {
          $params = $url;
        }
      } else {
        $action = 'index';
      }
    } else {
      $controller = 'homeController';
      $action = 'index';
    }

    $c = $prefix.$controller;
    \call_user_func_array(array(new $c(), $action), $params);
  }
}
