<?php
	include_once '../_module/function.php';
	include_once '../_class/artikel_DBC.php';
	include_once '../_class/db.php';
	include_once '../_class/kunde.php';
	session_start();
	$anwender = $_SESSION['anwender'];
	$login = $anwender->login;
	
	if($login == 1){
		$bezeichnung =  $_POST['bezeichnung'];
		$beschreibung =  $_POST['beschreibung'];
		$preis =  $_POST['preis'];
		$artnr =  $_POST['artnr'];
		$status =  $_POST['status'];
		Artikel_DBC::admin_artikel_hinzufuegen($bezeichnung, $beschreibung, $preis, $artnr, $status);
	}
	else{
		header('Location: index.php');
	}