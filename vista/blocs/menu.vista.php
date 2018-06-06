<?php
// 20-08-2013
// billy
$plant = new Plantilla("html/blocs");
$plant->carregar("menu");
$plant->setMatriu("menu", array("LINK", "NOM", "MARCAT"), $Bloc->menu);
$plant->mostrarBloc("menu_tot");
$plant->imprimir();