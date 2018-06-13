<?php
namespace App\Backend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\News;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;
use \OCFram\FormHandler;

class NewsController extends BackController
{

  // Méthode permettant de supprimer un chapitre

  public function executeDelete(HTTPRequest $request)
  {
    $newsId = $request->getData('id');

    $this->managers->getManagerOf('News')->delete($newsId);
    $this->managers->getManagerOf('Comments')->deleteFromNews($newsId);

    $this->app->user()->setFlash('Le chapitre a bien été supprimé !');

    $this->app->httpResponse()->redirect('/admin/');

  }

  // Méthode permettant de supprimer un commentaire

  public function executeDeleteComment(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Comments')->delete($request->getData('id'));

    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');

    $this->app->httpResponse()->redirect('/admin/');
  }


  // Méthode permettant d'afficher le tableau de bord du BackOffice

  public function executeIndex(HTTPRequest $request)
  {
      $newsManager = $this->managers->getManagerOf('News');
      $commentsManager = $this->managers->getManagerOf('Comments');
      $nombreCaracteres = $this->app->config()->get('nombre_caracteres');

      $newsPubliees = $newsManager->count();
      $commentsAModerer= $commentsManager->countMarkedComments(true);

      $lastNews = $newsManager->getList(0, 1);
      $lastComments = $commentsManager->getList(0, 1);

      foreach ($lastNews as $news) {
        if (strlen($news->contenu()) > $nombreCaracteres)
        {
          $debut = substr($news->contenu(), 0, $nombreCaracteres);
          $debut = substr($debut, 0, strrpos($debut, ' ')) . ' ...';
          $news->setContenu($debut);
        }
      }

      foreach ($lastComments as $comments) {
        if (strlen($comments->contenu()) > $nombreCaracteres)
        {
          $debut = substr($news->contenu(), 0, $nombreCaracteres);
          $debut = substr($debut, 0, strrpos($debut, ' ')) . ' ...';
          $comments->setContenu($debut);
        }
      }

      $this->page->addVar('title', 'Tableau de bord');
      $this->page->addVar('newsPubliees', $newsPubliees);
      $this->page->addVar('commentsAModerer', $commentsAModerer);
      $this->page->addVar('lastNews', $lastNews);
      $this->page->addVar('lastComments', $lastComments);
  }

  // Méthode permettant d'afficher un tableau regroupant tous les chapitres

  public function executeIndexNews(HTTPRequest $request)
  {
    $newsManager = $this->managers->getManagerOf('News');


    $nombreNews = $this->app->config()->get('nombre_news');


    $nombreTotalNews = $newsManager->count();

    $newsParPage = $nombreNews;

    $page = intval($request->getData('page'));
    $nombrePagesNews = ceil($nombreTotalNews/$newsParPage);


    if ($page > 0 && $page <= $nombrePagesNews) {
      $pageCourante = $page;
    }

    else {
      $pageCourante = 1;
    }

    $listeNews = $newsManager->getList((($pageCourante-1)*$newsParPage), $newsParPage);

    $this->page->addVar('title', 'Liste des chapitres');
    $this->page->addVar('listeNews', $listeNews);
    $this->page->addVar('nombreNews', $nombreNews);
    $this->page->addVar('nombrePagesNews', $nombrePagesNews);
    $this->page->addVar('pageCourante', $pageCourante);
  }


  // Méthode permettant d'afficher un tableau regroupant les commentaires signalés

  public function executeIndexComments(HTTPRequest $request)
  {

    $commentsManager = $this->managers->getManagerOf('Comments');


    $nombreComments = $this->app->config()->get('nombre_comments');


    $nombreTotalComments = $commentsManager->countMarkedComments(true);

    $commentsParPage = $nombreComments;
    $page = intval($request->getData('page'));

    $nombrePagesComments = ceil($nombreTotalComments/$commentsParPage);

    if ($page > 0 && $page <= $nombrePages) {
      $pageCourante = $page;
    }

    else {
      $pageCourante = 1;
    }

    $listeComments = $commentsManager->getMarkedComments(true, (($pageCourante-1)*$commentsParPage), $commentsParPage);

    $this->page->addVar('title', 'Commentaires en attente de modération');
    $this->page->addVar('comments', $listeComments );
    $this->page->addVar('nombreComments', $nombreComments);
    $this->page->addVar('nombrePagesComments', $nombrePagesComments);
    $this->page->addVar('pageCourante', $pageCourante);
  }


  // Méthode permettant d'ajouter un commentaire

  public function executeInsert(HTTPRequest $request)
  {
    $this->processForm($request);

    $this->page->addVar('title', 'Ajouter un chapitre');
  }


  // Méthode permettant de modifier un chapitre

  public function executeUpdate(HTTPRequest $request)
  {
    $this->processForm($request);

    $this->page->addVar('title', 'Modifier un chapitre');
  }


  // Méthode permettant de modifier un commentaire

  public function executeUpdateComment(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modifier un commentaire');

    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    }

    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();

    $form = $formBuilder->form();

    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été modifié');

      $this->app->httpResponse()->redirect('/admin/');
    }

    $this->page->addVar('form', $form->createView());
  }


  // Méthode permettant d'utiliser un formulaire pour l'ajout et la modification des chapitres et des commentaires

  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $news = new News([
        'auteur' => $request->postData('auteur'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu')
      ]);

      if ($request->getExists('id'))
      {
        $news->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant de la news est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
      }
      else
      {
        $news = new News;
      }
    }

    $formBuilder = new NewsFormBuilder($news);
    $formBuilder->build();

    $form = $formBuilder->form();

    $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);

    if ($formHandler->process())
    {
      $this->app->user()->setFlash($news->isNew() ? 'Le chapitre a bien été ajouté !' : 'Le chapitre a bien été modifié !');

      $this->app->httpResponse()->redirect('/admin/');
    }

    $this->page->addVar('form', $form->createView());
  }


  // Méthode permettant de valider un commentaire signalé

  public function executeUnmarkComment(HTTPRequest $request)
  {

    $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));

    $comment->setMark(false);

    $this->managers->getManagerOf('Comments')->mark($comment);

    $this->app->httpResponse()->redirect('/admin/comments.html');
  }
}
