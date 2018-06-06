<?php
  // 13-06-2013
  // billy

function nomValid($cad) {
  return (preg_match("/^[a-zA-Z0-9]{2,45}$/", $cad));
}

function cadValid($cad) {
  if (strpos($cad, "../") !== false)
    return false;
  $permesos = "ABCÇDEFGHIJKLMNÑOPQRSTUVWXYZÁÀÄÉÈËÍÌÏÓÒÖÚÙÜabcçdefghijklmnñopqrstuvwxyzáàäéèëíìïóòöúùü0123456789?.=_-,:/\\ ";
  for ($i = 0; $i < strlen($cad); $i++)
    if (strpos($permesos, substr($cad, $i, 1)) === false)
      return false;
  return true;
}

function quinPerfil() {
  $descr = fopen("conf/quinperfil.txt", "r");
  $estem = fread($descr, 1);
  if (!preg_match("/^[a-zA-Z0-9]$/", $estem))
    $estem = "0";
  fclose($descr);
  return $estem;
}

function imprVec($vec) {
  echo "<div class='depuracio'>\n";
  echo "<pre>\n";
  print_r($vec);
  echo "</pre>\n";
  echo "</div>\n";
}

function voreBloc($bloc) {
  $fit = "./moduls/blocs/" . $bloc . ".php";
  $Mod =  "Bloc" . ucfirst($bloc);
  if (file_exists($fit)) {
    require_once ($fit);
    $Bloc = new $Mod();
    if (method_exists($Mod, "exec"))
      $Bloc->exec();
    if (file_exists("./vista/blocs/" . $bloc . ".vista.php"))
      include "./vista/blocs/" . $bloc . ".vista.php";
  }
}