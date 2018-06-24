<?php
namespace App\Backend\Modules\Connexion;

use \MainLib\BackController;
use \MainLib\HTTPRequest;

class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');

    if ($request->postExists('login'))
    {
      $login = $request->postData('login');
      $password = $request->postData('password');

      $correctPassWord = $this->app->config()->get('pass');

      $isPassWordCorrect = password_verify($password, $correctPassWord);


      if ( $login === $this->app->config()->get('login') && $isPassWordCorrect)
      {
        $this->app->user()->setAuthenticated(true);
        $this->app->httpResponse()->redirect('.');
      }
      else
      {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect');
      }
    }
  }
}
