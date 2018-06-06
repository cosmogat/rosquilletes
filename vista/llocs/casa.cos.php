<?php
// 20-08-2013
// billy

$plant = new Plantilla("html/llocs");
$plant->carregar("casa");
$plant->mostrarBloc("body");   
$plant->imprimir();