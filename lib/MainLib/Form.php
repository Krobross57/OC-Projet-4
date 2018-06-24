<?php
namespace MainLib;

class Form
{
  protected $entity;
  protected $fields = [];

  public function __construct(Entity $entity)
  {
    $this->setEntity($entity);
  }

  public function add(Field $field)
  {
    $attr = $field->name(); // Récupération du nom du champ
    $field->setValue($this->entity->$attr()); // Assignation de la valeur correspondante au champ.

    $this->fields[] = $field; // Ajout du champ passé en argument à la liste des champs.
    return $this;
  }

  public function createView()
  {
    $view = '';

    // Parcours du tableau généré par la méthode add() et création un à un des champs du formulaire
    foreach ($this->fields as $field)
    {
      $view .= $field->buildWidget().'<br />';
    }

    return $view;
  }

  public function isValid()
  {
    $valid = true;

    // Vérification de la validité des champs
    foreach ($this->fields as $field)
    {
      if (!$field->isValid())
      {
        $valid = false;
      }
    }

    return $valid;
  }

  public function entity()
  {
    return $this->entity;
  }

  public function setEntity(Entity $entity)
  {
    $this->entity = $entity;
  }
}
