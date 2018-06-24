<?php
namespace Model;

use \MainLib\Manager;
use \Entity\News;

abstract class NewsManager extends Manager
{
  /**
   * Méthode permettant d'ajouter un chapitre
   * @param $news News Le chapitre à ajouter
   * @return void
   */
  abstract protected function add(News $news);

  /**
   * Méthode permettant d'enregistrer un chapitre
   * @param $news News Le chapitre à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(News $news)
  {
    if ($news->isValid())
    {
      $news->isNew() ? $this->add($news) : $this->modify($news);
    }
    else
    {
      throw new \RuntimeException('La news doit être validée pour être enregistrée');
    }
  }

  /**
   * Méthode renvoyant le nombre total de chapitres
   * @return int
   */
  abstract public function count();

  /**
   * Méthode permettant de supprimer un chapitre
   * @param $id int L'identifiant du chapitre à supprimer
   * @return void
   */
  abstract public function delete($id);

  /**
   * Méthode retournant une liste de chapitres demandés
   * @param $debut int Le premier chapitre à sélectionner
   * @param $limite int Le nombre de chapitres à sélectionner
   * @return array La liste des chapitres. Chaque entrée est une instance de News
   */
  abstract public function getList($debut = -1, $limite = -1);

  /**
   * Méthode retournant un chapitre précis
   * @param $id int L'identifiant du chapitre à récupérer
   * @return News La news demandée
   */
  abstract public function getUnique($id);

  /**
   * Méthode permettant de modifier un chapitre
   * @param $news news le chapitre à modifier
   * @return void
   */
  abstract protected function modify(News $news);
}
