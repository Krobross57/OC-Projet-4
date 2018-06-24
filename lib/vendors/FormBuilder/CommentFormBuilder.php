<?php
namespace FormBuilder;

use \MainLib\FormBuilder;
use \MainLib\StringField;
use \MainLib\TextField;
use \MainLib\MaxLengthValidator;
use \MainLib\NotNullValidator;

class CommentFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Auteur',
        'for'=> 'auteur',
        'name' => 'auteur',
        'placeHolder' => 'Veuillez saisir l\'auteur ici',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('<p class="validators" id="tooLongComment">L\'auteur spécifié est trop long (50 caractères maximum)</p>', 50),
          new NotNullValidator('<p class="validators" id="noCommentAuthor">Merci de spécifier l\'auteur du commentaire</p>'),
        ],
       ]))
       ->add(new TextField([
        'label' => 'Contenu',
        'for' => 'contenu',
        'name' => 'contenu',
        'placeHolder' => 'Veuillez saisir votre commentaire ici',
        'validators' => [
          new NotNullValidator('<p class="validators" id="noComment">Merci de spécifier votre commentaire</p>'),
        ],
       ]));
  }
}
