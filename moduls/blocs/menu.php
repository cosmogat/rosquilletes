<?php
// 25-06-2013
// billy
class BlocMenu {
  public $menu = array();

  public function exec() {
    $this->menu = BaseDades::consVector(sqlMenu());
    $index = BaseDades::consValor(sqlIndex());
    $i = 0;
    foreach ($this->menu as $val) {
      if ($val[0] == $index)
	$this->menu[$i][0] = Registre::lleg("host") . "/";
      else
	$this->menu[$i][0] = Registre::lleg("host") . "/" . $this->menu[$i][0] . "/";
      if ($val[0] == Registre::lleg("pare"))
	$this->menu[$i][2] = " menumarcat";
      else
	$this->menu[$i][2] = "";
      $i++;
    }
  }
}