<?php
// 21-06-2013
// billy
// mirar en el CMS de ...:
//   es destruiexen els objectes que siguen moduls ?.
//   coses comunes als moduls ficades en una classe principal.

require_once ("./inc/funcions.inc.php");
require_once ("./conf/conf_" . quinPerfil() . ".inc.php");
require_once ("./inc/sql.inc.php");
require_once ("./inc/reg.obj.php");
require_once ("./inc/sql.obj.php");
require_once ("./inc/tpl.obj.php");
require_once ("./inc/lnk.obj.php");

Registre::netj();
Registre::afeg("bd_us", $conf["bd"]["user"]);
Registre::afeg("bd_co", $conf["bd"]["pass"]);
Registre::afeg("bd_ho", $conf["bd"]["host"]);
Registre::afeg("bd_bd", $conf["bd"]["bdad"]);
Registre::afeg("host", $conf["in"]["host"]);
Registre::afeg("depu", $conf["er"]["depu"]);

if (Registre::lleg("depu")) {
  ini_set('display_errors', "On");
  ini_set('error_reporting', E_ALL);
  $temps = microtime(true);
}
else {
  ini_set('display_errors', "Off");
  ini_set('error_reporting', 0);
}

BaseDades::agafarBD();

$index = BaseDades::consValor(sqlIndex());
$lloc = (isset($_REQUEST['lloc']) and nomValid($_REQUEST['lloc'])) ? $_REQUEST['lloc'] : $index;

Registre::afeg("lloc", $lloc);
Registre::afeg("ruta", Link::ruta($lloc));
Registre::afeg("rutaAbs", Registre::lleg("host") . "/" . Registre::lleg("ruta"));
$pos = strpos(Registre::lleg("ruta"), "/");
Registre::afeg("pare", substr(Registre::lleg("ruta"), 0, $pos));
Registre::afeg("estil", array("estil.css"));
Registre::afeg("javas", array("jquery.js"));
Registre::afeg("nomWeb", BaseDades::consValor(sqlNomWeb()));

if ($aux = BaseDades::consVector(sqlIdLlocs($lloc)))
  $vecLlocs = $aux;
else
  $vecLlocs = BaseDades::consVector(sqlIdLlocs($index));
$idLloc = (int) $vecLlocs[0][0];
$nomArx = $vecLlocs[0][1];

$blocsCap = BaseDades::consVector(sqlBlocsCap($idLloc));
$blocsDre = BaseDades::consVector(sqlBlocsDre($idLloc));
$blocsPeu = BaseDades::consVector(sqlBlocsPeu($idLloc));

require_once ("./moduls/llocs/" . $nomArx . ".php");
$nomLloc = "Lloc" . ucfirst($nomArx);
$Lloc = new $nomLloc();

if (method_exists($Lloc, "prep"))
  $Lloc->prep(); // en aquest metode aniran les posibles redireccions
$tpl = new Plantilla("html");

$tpl->carregarMostrar("web", "cap");

if ((method_exists($Lloc, "execap")) and (file_exists("./vista/llocs/" . $nomArx . ".cap.php"))) {
  $Lloc->execap(); // imprimir la capçalera del lloc
  require "./vista/llocs/" . $nomArx . ".cap.php";
}
$tpl->carregar("web");
$tpl->mostrarBloc("ini_web");
$tpl->set("NOMWEB", BaseDades::consValor(sqlNomWeb()));
$tpl->set("LOGO", Registre::lleg("host") . "/img/rosquilletes.png");
$tpl->imprimir();

if (count($blocsCap) != 0) {
  $tpl->carregarMostrar("web", "ini_dalt");
  foreach ($blocsCap as $valor) {
    require_once ("./moduls/blocs/" . $valor[0] . ".php");
    $nomBloc = "Bloc" .  ucfirst($valor[0]);
    $Bloc = new $nomBloc();
    if ((method_exists($Bloc, "exec")) and (file_exists("./vista/blocs/" . $valor[0] . ".vista.php"))) {
      $Bloc->exec();
      include "./vista/blocs/" . $valor[0] . ".vista.php";
    }
  }
  $tpl->carregarMostrar("web", "fi_dalt");
}

if (count($blocsDre) != 0)
  $tpl->carregarMostrar("web", "ini_lloc");
else
  $tpl->carregarMostrar("web", "ini_lloc_tot");

if ((method_exists($Lloc, "exec")) and (file_exists("./vista/llocs/" . $nomArx . ".cos.php"))) {
  $Lloc->exec(); // fer calculs previs a la impresio
  require "./vista/llocs/" . $nomArx . ".cos.php"; // imprimir el lloc
}

$tpl->carregarMostrar("web", "fi_lloc");

if (count($blocsPeu) != 0) {
  $tpl->carregarMostrar("web", "ini_peu");
  foreach ($blocsPeu as $valor) {
    require_once ("./moduls/blocs/" . $valor[0] . ".php");
    $nomBloc = "Bloc" .  ucfirst($valor[0]);
    $Bloc = new $nomBloc();
    if ((method_exists($Bloc, "exec")) and (file_exists("./vista/blocs/" . $valor[0] . ".vista.php"))) {
      $Bloc->exec();
      include "./vista/blocs/" . $valor[0] . ".vista.php";
    }
  }
  $tpl->carregarMostrar("web", "fi_peu");
}
$tpl->carregarMostrar("web", "fi_web");

if (count($blocsDre) != 0) {
  $tpl->carregarMostrar("web", "ini_dre");
  foreach ($blocsDre as $valor) {
    require_once ("./moduls/blocs/" . $valor[0] . ".php");
    $nomBloc = "Bloc" .  ucfirst($valor[0]);
    $Bloc = new $nomBloc();
    if ((method_exists($Bloc, "exec")) and (file_exists("./vista/blocs/" . $valor[0] . ".vista.php"))) {
      $Bloc->exec();
      include "./vista/blocs/" . $valor[0] . ".vista.php";
    }
  }
  $tpl->carregarMostrar("web", "fi_dre");
}

$tpl->carregarMostrar("web", "cul");

if (Registre::lleg("depu")) {
  $tpl->carregar("web");
  $tpl->mostrarBloc("depu");
  $tpl->set("SEGONS", round(microtime(true) - $temps, 3));
  $tpl->imprimir();
}

$tpl->carregarMostrar("web", "fin");
BaseDades::tancarBD();
Registre::netj();