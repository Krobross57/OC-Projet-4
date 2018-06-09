<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;

class NewsFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Auteur',
        'for' => 'auteur',
        'placeHolder' => 'Veuillez saisir l\'auteur ici',
        'name' => 'auteur',
        'id' => 'auteur',
        'maxLength' => 20,
        'validators' => [
          new MaxLengthValidator('<p class="validators" id="tooLongChapterAuthor">L\'auteur spécifié est trop long (20 caractères maximum)</p>', 20),
          new NotNullValidator('<p class="validators" id="noChapterAuthor">Merci de spécifier l\'auteur du chapitre</p>'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Titre',
        'for' => 'titre',
        'placeHolder' => 'Veuillez saisir le titre du chapitre ici',
        'name' => 'titre',
        'id' => 'titre',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('<p class="validators" id="tooLongChapterTitle">Le titre spécifié est trop long (100 caractères maximum)</p>', 100),
          new NotNullValidator('<p class="validators" id="noChapterTitle">Merci de spécifier le titre du chapitre</p>'),
        ],
      ]))
       ->add(new TextField([
        'name' => 'contenu',
        'id' => 'contenu',
        'validators' => [
          new NotNullValidator('<p class="validators" id="noChapterContent">Merci de spécifier le contenu du chapitre</p>'),
        ],
       ]));
  }
}
