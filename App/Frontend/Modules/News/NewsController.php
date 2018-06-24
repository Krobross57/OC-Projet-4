<?php
namespace App\Frontend\Modules\News;

use \MainLib\BackController;
use \MainLib\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \MainLib\FormHandler;

class NewsController extends BackController
{

  //Méthode permettant d'afficher une liste des chapitres paginée à 10 occurences par page

  public function executeIndex(HTTPRequest $request)
  {

    $manager = $this->managers->getManagerOf('News');

    $nombreNews = $this->app->config()->get('nombre_news');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');


    $nombreTotalNews = $manager->count();
    $newsParPage = $nombreNews;
    $page = intval($request->getData('page'));
    $nombrePages = ceil($nombreTotalNews/$newsParPage);

    if ($page > 0 && $page <= $nombrePages) {
      $pageCourante = $page;
    }

    else {
      $pageCourante = 1;
    }


    $listeNews = $manager->getList((($pageCourante-1)*$newsParPage), $newsParPage);

    foreach ($listeNews as $news)
    {
      if (strlen($news->contenu()) > $nombreCaracteres)
      {
        $debut = substr($news->contenu(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . ' ...';

        $news->setContenu($debut);
      }
    }

    $this->page->addVar('title', 'Liste des '.$nombreNews.' derniers chapitres');
    $this->page->addVar('listeNews', $listeNews);
    $this->page->addVar('nombreNews', $nombreNews);
    $this->page->addVar('nombrePages', $nombrePages);
    $this->page->addVar('pageCourante', $pageCourante);
  }


  // Méthode permettant d'afficher la liste complète des commentaires liés à un chapitre donné avec une pagination de 10 par page

  public function executeIndexComments(HTTPRequest $request)
  {

    $nombreComments = $this->app->config()->get('nombre_comments');

    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

    if (!isset($news) || empty($news))
    {
      $this->app->httpResponse()->redirect404();
    }

    $manager = $this->managers->getManagerOf('Comments');

    $nombreTotalComments = count($manager->getCompleteListOf($news->id()));
    $commentsParPage = $nombreComments;
    $page = intval($request->getData('page'));
    $nombrePages = ceil($nombreTotalComments/$commentsParPage);

    if ($page > 0 && $page <= $nombrePages) {
      $pageCourante = $page;
    }

    else {
      $pageCourante = 1;
    }

    $listeComments = $manager->getListOf($news->id(),(($pageCourante-1)*$commentsParPage), $commentsParPage);


    $this->page->addVar('news', $news);
    $this->page->addVar('listeComments', $listeComments);
    $this->page->addVar('nombrePages', $nombrePages);
    $this->page->addVar('pageCourante', $pageCourante);
    $this->page->addVar('titre', $news->titre());
    $this->page->addVar('title', $news->titre().' - Commentaires');
  }

  public function executeShow(HTTPRequest $request)
  {

    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

    $commentsManager = $this->managers->getManagerOf('Comments');

    if (empty($news) || !isset($news))
    {
      $this->app->httpResponse()->redirect404();
    }

    $comments = $commentsManager->getListOf($news->id(), 0, 5);
    $totalComments = $commentsManager->getCompleteListOf($news->id());


    $this->page->addVar('title', $news->titre());
    $this->page->addVar('news', $news);
    $this->page->addVar('comments', $comments);
    $this->page->addVar('totalComments', $totalComments);
  }

  // Méthode permettant d'ajouter un commentaire

  public function executeInsertComment(HTTPRequest $request)
  {
    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'news' => $request->getData('news'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $comment = new Comment;
    }

    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();

    $form = $formBuilder->form();

    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Votre commentaire a bien été ajouté, merci !');

      $this->app->httpResponse()->redirect('news-'.$request->getData('news').'.html');

    }

    $this->page->addVar('comment', $comment);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajout d\'un commentaire');
  }

  // Méthode permettant de signaler un commentaire

  public function executeMarkComment(HTTPRequest $request)
  {

    $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));

    if (!isset($comment))
    {
      $this->app->httpResponse()->redirect404();
    }

    $comment->setMark(true);

    $this->managers->getManagerOf('Comments')->mark($comment);

    $this->app->httpResponse()->redirect('/');

    $this->app->user()->setFlash('Le commentaire a bien été signalé ! Merci de votre collaboration !');
  }

}
