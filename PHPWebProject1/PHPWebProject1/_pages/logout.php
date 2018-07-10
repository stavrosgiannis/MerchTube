<?php	
	include_once '../_module/function.php';
	include_once '../_class/db.php';
	include_once '../_class/kunde_DBC.php';
	//start der Session
	session_start();			
	$anwender = $_SESSION['anwender'];
	$id_anwender = $anwender->id_anwender;
	Anwender_DBC::ausloggen($id_anwender);
	//lösche alle Werte in Session_Kunde
	unset($_SESSION['anwender']);
	header('Location: index.php');
?>