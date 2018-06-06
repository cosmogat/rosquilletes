<?php
// 20-08-2013
// billy

$plant = new Plantilla("html/llocs");
$plant->carregar("admin");
$plant->setVector("css", "CSS", $Lloc->css);
$plant->setVector("js", "JS", $Lloc->js);

$plant->set("NOMWEB", Registre::lleg("nomWeb"));
$plant->mostrarBloc("head");
$plant->imprimir();