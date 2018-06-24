<?php
namespace Model;

use \MainLib\Manager;
use \Entity\Comment;

abstract class CommentsManager extends Manager
{
  /**
   * Méthode permettant d'ajouter un commentaire.
   * @param $comment Le commentaire à ajouter
   * @return void
   */
  abstract protected function add(Comment $comment);

  /**
   * Méthode permettant d'enregistrer un commentaire.
   * @param $comment Le commentaire à enregistrer
   * @return void
   */
  public function save(Comment $comment)
  {
    if ($comment->isValid())
    {
      $comment->isNew() ? $this->add($comment) : $this->modify($comment);
    }
    else
    {
      throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
    }
  }

  /**
   * Méthode permettant de supprimer un commentaire.
   * @param $id L'identifiant du commentaire à supprimer
   * @return void
   */
  abstract public function delete($id);

  /**
   * Méthode permettant de supprimer tous les commentaires liés à un chapitre
   * @param $news L'identifiant du chapitre dont les commentaires doivent être supprimés
   * @return void
   */
  abstract public function deleteFromNews($news);

  /**
   * Méthode permettant de modifier un commentaire.
   * @param $comment Le commentaire à modifier
   * @return void
   */
  abstract protected function modify(Comment $comment);

  /**
   * Méthode permettant de signaler le commentaire
   * @param $comment Le commentaire à signaler
   * @return void
   */
  abstract public function mark(Comment $comment);

  /**
   * Méthode permettant de retirer le signalement du commentaire
   * @param $comment Le commentaire à ne plus signaler
   * @return void
   */
  abstract public function unmark(Comment $comment);

  /**
   * Méthode permettant de récupérer une liste de commentaires.
   * @param $news Le chapitre duquel on veut récupérer les commentaires
   * @param $debut Le premier commentaire à sélectionner
   * @param $limite Le nombre de commentaires à sélectionner
   * @return array
   */
  abstract public function getListOf($news, $debut = -1, $limite = -1);

  /**
   * Méthode permettant de récupérer la liste complète des commentaires liés à un chapitre précis
   * @param $news Le chapitre duquel on veut récupérer les commentaires
   * @return array
   */
  abstract public function getCompleteListOf($news);

  /**
   * Méthode permettant de récupérer un liste donnée de commentaires parmi tous les commentaires de tous les chapitres
   * @param $debut le premier commentaire à récupérer
   * @param $debut le nombre de commentaires à récupérer
   * @return array
   */
  abstract public function getList($debut = -1, $limite = -1);

  /**
   * Méthode permettant d'obtenir un commentaire spécifique.
   * @param $id L'identifiant du commentaire
   * @return Comment
   */
  abstract public function get($id);

  /**
   * Méthode permettant d'obtenir un commentaire signalé.
   * @param $mark La valeur de l'attribut mark du commentaire
   * @return array
   */
  abstract public function getMarkedComments($mark, $debut = -1, $limite = -1);


  /**
   * Méthode permettant de sélectionner tous les commentaires marqués
   * @param $mark La valeur de l'attribut mark du commentaire
   * @return void
   */
  abstract public function countMarkedComments($mark);
}
