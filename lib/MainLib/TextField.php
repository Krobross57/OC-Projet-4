<?php
namespace MainLib;

class TextField extends Field
{

  public function buildWidget()
  {
    $widget = '';

    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }

    $widget .= '<label for="'.$this->for.'">'.$this->label.'</label><textarea placeholder= "'.$this->placeHolder.'"name="'.$this->name.'" id="'.$this->id.'"';

    $widget .= '>';

    if (!empty($this->value))
    {
      $widget .= htmlspecialchars($this->value);
    }

    return $widget.'</textarea>';
  }
}
