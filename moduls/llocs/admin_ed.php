<?php
// 22-08-2013
// billy
class LlocAdmin_ed {
  public $css = array();
  public $js = array();
  
  public function execap() {
    $this->css = Registre::lleg("estil");
    foreach ($this->css as $clau => $val)
      $this->css[$clau] = Registre::lleg("host") . "/css/" . $val;
    $this->js = Registre::lleg("javas");
    foreach ($this->js as $clau => $val)
      $this->js[$clau] = Registre::lleg("host") . "/js/" . $val;
  }
  public function exec() {

  }
}