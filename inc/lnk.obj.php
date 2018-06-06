<?php
// 01-08-2013
// alex

class Link {
  private function __construct() {}
  
  static public function onEstic() {
    return (Registre::lleg("host") . "/" . Registre::lleg("ruta"));
  }

  static public function arx2lloc($arxiu) {
    return Basedades::consValor(sqlArx2Lloc($arxiu));
  }

  static public function ruta($lloc) {
    $iter = true;
    $ruta = "";
    do {
      $ruta = $lloc . "/" . $ruta;
      $llocpare = $lloc;
      $lloc = BaseDades::consValor(sqlNomPare($lloc));
      $iter = ($lloc == "") || ($lloc == $llocpare) ? false : true;
    } while ($iter);
    return $ruta;
  }
  static public function rutaAbs($lloc) {
    return (Registre::lleg("host") . "/" . self::ruta($lloc));
  }

}