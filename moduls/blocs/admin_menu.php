<?php
// 25-06-2013
// billy
class BlocAdmin_menu {
  public $link;

  public function exec() {
    $this->link = Link::rutaAbs(Link::arx2lloc("admin"));
  }
}