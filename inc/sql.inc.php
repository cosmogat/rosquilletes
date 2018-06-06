<?php
// 22-06-2013
// billy

function sqlIdLlocs($lloc) {
  $aux = "SELECT idllocs, modul FROM Llocs WHERE nom LIKE '" . $lloc . "' LIMIT 1";
  return $aux;
}

function sqlBlocsCap($idlloc) {
  $aux = "SELECT Blocs.Modul FROM Llocs JOIN ModulsCap ON (Llocs.idllocs = ModulsCap.Llocs_idllocs) JOIN Blocs ON (ModulsCap.Blocs_idblocs = Blocs.idblocs) WHERE Llocs.idllocs = " . $idlloc . " ORDER BY ModulsCap.pes";
  return $aux;
}

function sqlBlocsDre($idlloc) {
  $aux = "SELECT Blocs.Modul FROM Llocs JOIN ModulsDreta ON (Llocs.idllocs = ModulsDreta.Llocs_idllocs) JOIN Blocs ON (ModulsDreta.Blocs_idblocs = Blocs.idblocs) WHERE Llocs.idllocs = " . $idlloc . " ORDER BY ModulsDreta.pes";
  return $aux;
}

function sqlBlocsPeu($idlloc) {
  $aux = "SELECT Blocs.Modul FROM Llocs JOIN ModulsPeu ON (Llocs.idllocs = ModulsPeu.Llocs_idllocs) JOIN Blocs ON (ModulsPeu.Blocs_idblocs = Blocs.idblocs) WHERE Llocs.idllocs = " . $idlloc . " ORDER BY ModulsPeu.pes";
  return $aux;
}

function sqlNomPare($llocnom) {
  $aux = "SELECT Llocs.nom FROM Llocs AS Fills JOIN Llocs ON (Fills.llocpare = Llocs.idllocs) WHERE Fills.nom = '" . $llocnom . "' LIMIT 1";
  return $aux;
}

function sqlArx2Lloc($arx) {
  $aux = "SELECT nom FROM Llocs WHERE modul LIKE '" . $arx . "' LIMIT 1";
  return $aux;
}

function sqlNomWeb() {
  $aux = "SELECT nomweb FROM Configuracio LIMIT 1";
  return $aux;
}

function sqlMenu() {
  $aux = "SELECT Llocs.nom, Menu.nommenu FROM Menu JOIN Llocs ON (Menu.idmenu = Llocs.idllocs) ORDER BY Menu.pesmenu";
  return $aux;
}

function sqlIndex() {
  $aux = "SELECT Llocs.nom FROM Configuracio JOIN Llocs ON (Configuracio.index = Llocs.idllocs) LIMIT 1";
  return $aux;
}
