<?php
// 20-08-2013
// billy
$plant = new Plantilla("html/blocs");
$plant->carregar("admin_menu");
$plant->set("LINK_ME", $Bloc->link);
$plant->mostrarBloc("tornar_admin");
$plant->imprimir();