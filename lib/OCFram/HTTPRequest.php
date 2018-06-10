<?php
namespace OCFram;

class HTTPRequest extends ApplicationComponent
{
  public function cookieData($key)
  {
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
  }

  public function cookieExists($key)
  {
    return isset($_COOKIE[$key]);
  }

  public function getData($key)
  {
    return isset($_GET[$key]) ? $_GET[$key] : null;
  }

  public function getExists($key)
  {
    return isset($_GET[$key]);
  }

  public function method()
  {
    return $_SERVER['REQUEST_METHOD'];
  }

  public function postData($key)
  {
    return isset($_POST[$key]) ? $_POST[$key] : null;
  }

  public function postExists($key)
  {
    return isset($_POST[$key]);
  }

  public function requestURI()
  {
    $uri = $_SERVER['REQUEST_URI'];
    $pos =  strpos($uri, '?');

    if ($pos) {
      return substr($uri, 0, $pos);
    }

    return $uri;
  }
}
