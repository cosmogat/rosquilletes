<?php
// 20-08-2013
// billy

$txt = array("Afegir m&ograve;duls", "Editar Llocs", "Editar l'her&egrave;ncia dels Llocs");
$links = array();
foreach ($Lloc->links as $ind => $valor)
  $links[] = array($valor, $txt[$ind]);

$plant = new Plantilla("html/llocs");
$plant->carregar("admin");
$plant->setMatriu("ad_menu", array("LINK", "TXT"), $links);
$plant->mostrarBloc("body");
$plant->imprimir();
