<?php
// 20-08-2013
// billy
$plant = new Plantilla("html/llocs");

if ($Lloc->afegirLlocs) {
  $plant->carregar("admin_af");
  if ($Lloc->insertatLlocs) {
    $plant->setVector("llocs_af", "LLOC", $Lloc->modsLlocs);
    $plant->mostrarBloc("llocs_co");
  }
  else
    $plant->mostrarBloc("llocs_er");
}

if ($Lloc->afegirBlocs) {
  $plant->carregar("admin_af");
  if ($Lloc->insertatBlocs) {
    $plant->setVector("blocs_af", "BLOC", $Lloc->modsBlocs);
    $plant->mostrarBloc("blocs_co");
  }
  else
    $plant->mostrarBloc("blocs_er");
}

if ($Lloc->hiHaLlocs) {
  $plant->carregar("admin_af");
  sort($Lloc->mods);
  $plant->set("ACTION", Link::onEstic());
  $plant->setVector("llocs_ll", "LLOC", $Lloc->mods);
  $plant->mostrarBloc("llocs");
}
$plant->imprimir();
voreBloc("admin_menu");