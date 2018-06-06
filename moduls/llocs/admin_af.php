<?php
// 25-06-2013
// billy
class LlocAdmin_af {
  public $css = array();
  public $js = array();
  public $mods = array();
  public $modsLlocs = array();
  public $modsBlocs = array();
  public $hiHaLlocs = false;
  public $afegirLlocs = false;
  public $afegirBlocs = false;
  public $insertatLlocs = false;
  public $insertatBlocs = false;

  public function execap() {
    $this->css = Registre::lleg("estil");
    foreach ($this->css as $clau => $val)
      $this->css[$clau] = Registre::lleg("host") . "/css/" . $val;
    $this->js = Registre::lleg("javas");
    foreach ($this->js as $clau => $val)
      $this->js[$clau] = Registre::lleg("host") . "/js/" . $val;
  }

  public function exec() {
    if (isset($_POST["bot_afll"])) {
      $this->afegirLlocs = true;
      $post = $_POST;
      unset($post["bot_afll"]);
      $cad_ins = "";
      $modsArx = array();
      foreach ($post as $arx => $nom) {
	$aux = trim($nom);
	if (($aux != "")  and (nomValid($aux))) {
	  $cad_ins = $cad_ins . "('" . $arx . "', '" . $aux . "'),";
	  $this->modsLlocs[] = $aux;
	  $modsArx[] = $arx;
	}
      }
      $cad_ins = substr($cad_ins, 0, -1); 
      if (($cad_ins != "")  and (BaseDades::consulta("INSERT INTO Llocs (modul, nom) VALUES " . $cad_ins))) {
	$this->insertatLlocs = true;
	foreach ($this->modsLlocs as $val) {
	  touch("./html/llocs/" . $arx . ".html");
	  touch("./vista/llocs/" . $arx . ".cap.php");
	  touch("./vista/llocs/" . $arx . ".cos.php");
	  chmod("./html/llocs/" . $arx . ".html", 0664);
	  chmod("./vista/llocs/" . $arx . ".cap.php", 0664);
	  chmod("./vista/llocs/" . $arx . ".cos.php", 0664);
	}	
      }
      
    }
    $vec_aux = BaseDades::consVector("SELECT modul FROM Blocs");
    $vec_mod = array(".", "..");
    $cad_ins = "";
    foreach ($vec_aux as $val)
      $vec_mod[] = $val[0] . ".php";
    $dir = dir("./moduls/blocs/");
    while (false !== ($nomfit = $dir->read()))
      if (!in_array($nomfit, $vec_mod)) {
    	$nommodul = str_replace(".php", "", $nomfit);
    	$mod_aux = substr($nomfit, 0, -4);
    	if ($nommodul == $mod_aux) {
    	  $cad_ins = $cad_ins . "('" . $nommodul . "'),";
    	  $this->modsBlocs[] = $nommodul;
    	}
      }
    $cad_ins = substr($cad_ins, 0, -1);
    if ($cad_ins != "")  {
      $this->afegirBlocs = true;
      if (BaseDades::consulta("INSERT INTO Blocs (modul) VALUES " . $cad_ins)) {
	$this->insertatBlocs = true;
	foreach ($this->modsBlocs as $val) {
	  touch("./html/blocs/" . $val . ".html");
	  touch("./vista/blocs/" . $val . ".vista.php");
	  chmod("./html/blocs/" . $val . ".html", 0664);
	  chmod("./vista/blocs/" . $val . ".vista.php", 0664);
	}
      }
    }

    $vec_aux = BaseDades::consVector("SELECT modul FROM Llocs");
    $vec_mod = array(".", "..");
    foreach ($vec_aux as $val)
      $vec_mod[] = $val[0] . ".php";
    $dir = dir("./moduls/llocs/");
    while (false !== ($nomfit = $dir->read()))
      if (!in_array($nomfit, $vec_mod)) {
    	$nommodul = str_replace(".php", "", $nomfit);
    	$mod_aux = substr($nomfit, 0, -4);
    	if ($nommodul == $mod_aux) {
    	  $this->mods[] = $nommodul;
	  $this->hiHaLlocs = true;
	}
      }
  }

}