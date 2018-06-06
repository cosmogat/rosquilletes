<?php
// 25-06-2013
// billy
class LlocTemps {
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
    echo "executant temps<br>";
  }
}