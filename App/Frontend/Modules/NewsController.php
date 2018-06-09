<?php
namespace App\Frontend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\FormHandler;

class NewsController extends BackController
{


  public function executeIndex(HTTPRequest $request)
  {

    // On récupère le manager des news.
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

    // On ajoute la variable $listeNews à la vue.
    $this->page->addVar('title', 'Liste des '.$nombreNews.' derniers chapitres');
    $this->page->addVar('listeNews', $listeNews);
    $this->page->addVar('nombreNews', $nombreNews);
    $this->page->addVar('nombrePages', $nombrePages);
    $this->page->addVar('pageCourante', $pageCourante);


  }

  public function executeIndexComments(HTTPRequest $request)
  {

    $nombreComments = $this->app->config()->get('nombre_comments');

    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

    $manager = $this->managers->getManagerOf('Comments');



    if (empty($news))
    {
      $this->app->httpResponse()->redirect404();
    }


    $nombreTotalComments = $manager->count();
    $commentsParPage = $nombreComments;
    $page = intval($request->getData('page'));
    $nombrePages = ceil($nombreTotalComments/$commentsParPage);

    if ($page > 0 && $page <= $nombrePages) {
      $pageCourante = $page;
    }

    else {
      $pageCourante = 1;
    }


    $this->page->addVar('news', $news);
    $this->page->addVar('comments', $manager->getListOf($news->id(), 0, $nombreComments));
    $this->page->addVar('nombrePages', $nombrePages);
    $this->page->addVar('pageCourante', $pageCourante);
    $this->page->addVar('nombreComments', $nombreComments);
    $this->page->addVar('titre', $news->titre());
    $this->page->addVar('title', $news->titre().' - Commentaires');





  }

  public function executeShow(HTTPRequest $request)
  {

    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

    $commentsManager = $this->managers->getManagerOf('Comments');

    $comments = $commentsManager->getListOf($news->id(), 0, 5);




    if (empty($news))
    {
      $this->app->httpResponse()->redirect404();
    }

    $this->page->addVar('title', $news->titre());
    $this->page->addVar('news', $news);
    $this->page->addVar('comments', $comments);
  }

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

  public function executeMarkComment(HTTPRequest $request)
  {

    $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));

    $comment->setMark(true);

    $this->managers->getManagerOf('Comments')->mark($comment);

    $this->app->user()->setFlash('Le commentaire a bien été signalé ! Merci de votre collaboration !');

    $this->app->httpResponse()->redirect('/');
  }

}
