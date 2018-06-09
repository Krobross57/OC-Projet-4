<?php
namespace Model;

use \Entity\Comment;

class CommentsManagerPDO extends CommentsManager
{
  protected function add(Comment $comment)
  {
    $q = $this->dao->prepare('INSERT INTO comments SET news = :news, auteur = :auteur, contenu = :contenu, date = NOW(), mark = :mark');

    $q->bindValue(':news', $comment->news(), \PDO::PARAM_INT);
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());
    $q->bindValue(':mark', $comment->mark());

    $q->execute();

    $comment->setId($this->dao->lastInsertId());
  }

  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM comments')->fetchColumn();
  }

  public function countMarkedComments($mark) {

    if (!is_bool($mark))
    {
      throw new \InvalidArgumentException('L\'attribut du commentaire passé doit être un booléen');
    }

    $q = $this->dao->prepare('SELECT id, news, auteur, contenu, mark, date FROM comments WHERE mark = :mark ORDER BY id DESC');
    $q->bindValue(':mark', (bool)$mark, \PDO::PARAM_BOOL);
    $q->execute();

    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

    $comments = $q->fetchAll();


    return $comments;
  }


  public function delete($id)
  {
    $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
  }

  public function deleteFromNews($news)
  {
    $this->dao->exec('DELETE FROM comments WHERE news = '.(int) $news);
  }

  public function getListOf($news, $debut = -1, $limite = -1)
  {
    if (!ctype_digit($news))
    {
      throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
    }

    $q = $this->dao->prepare('SELECT id, news, auteur, contenu, date FROM comments WHERE news = :news ORDER BY id DESC LIMIT '.(int) $limite.' OFFSET '.(int) $debut);

    $q->bindValue(':news', $news, \PDO::PARAM_INT);
    $q->execute();

    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

    $comments = $q->fetchAll();

    foreach ($comments as $comment)
    {
      $comment->setDate(new \DateTime($comment->date()));
    }

    return $comments;
  }

  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, news, auteur, contenu, date FROM comments ORDER BY id DESC';

    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

    $listeComments = $requete->fetchAll();

    foreach ($listeComments as $comments)
    {
      $comments->setDate(new \DateTime($comments->date()));

    }

    $requete->closeCursor();

    return $listeComments;
  }

  protected function modify(Comment $comment)
  {
    $q = $this->dao->prepare('UPDATE comments SET auteur = :auteur, contenu = :contenu WHERE id = :id');

    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());
    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);

    $q->execute();
  }

  public function mark(Comment $comment)
  {
    $q = $this->dao->prepare('UPDATE comments SET mark = :mark WHERE id = :id');

    $q->bindValue(':mark', $comment->mark());
    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);

    $q->execute();
  }

  public function unmark(Comment $comment)
  {
    $q = $this->dao->prepare('UPDATE comments SET mark = :mark WHERE id = :id');

    $q->bindValue(':mark', $comment->mark());
    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);

    $q->execute();
  }

  public function get($id)
  {
    $q = $this->dao->prepare('SELECT id, news, auteur, contenu FROM comments WHERE id = :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();

    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

    return $q->fetch();
  }

  public function getMarkedComment($mark, $debut = -1, $limite = -1)
  {
    if (!is_bool($mark))
    {
      throw new \InvalidArgumentException('L\'attribut du commentaire passé doit être un booléen');
    }

    $q = $this->dao->prepare('SELECT id, news, auteur, contenu, mark, date FROM comments WHERE mark = :mark ORDER BY id DESC LIMIT '.(int) $limite.' OFFSET '.(int) $debut);
    $q->bindValue(':mark', (bool)$mark, \PDO::PARAM_BOOL);
    $q->execute();

    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

    $comments = $q->fetchAll();

    foreach ($comments as $comment)
    {
      $comment->setDate(new \DateTime($comment->date()));
    }

    return $comments;
  }
}
