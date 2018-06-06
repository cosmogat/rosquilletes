<?php
// 25-06-2013
// billy
class LlocAdmin {
  public $css = array();
  public $js = array();
  public $links = array();
  
  public function execap() {
    $this->css = Registre::lleg("estil");
    foreach ($this->css as $clau => $val)
      $this->css[$clau] = Registre::lleg("host") . "/css/" . $val;
    $this->js = Registre::lleg("javas");
    foreach ($this->js as $clau => $val)
      $this->js[$clau] = Registre::lleg("host") . "/js/" . $val;
  }

  public function exec() {
    $arxius = array("admin_af", "admin_ed", "admin_he");
    foreach ($arxius as $valor)
      $this->links[] = Link::rutaAbs(Link::arx2lloc($valor));
  }
}