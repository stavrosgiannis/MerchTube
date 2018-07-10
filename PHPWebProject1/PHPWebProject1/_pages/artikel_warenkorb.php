<?php
	include_once '../_module/function.php';
	include_once '../_class/artikel_DBC.php';
	include_once '../_class/db.php';
	include_once '../_class/kunde.php';
	session_start();
	$anwender = $_SESSION['anwender'];
	$id_anwender = $anwender->id_anwender;
	$id_artikel =  $_GET['artnum'];
	Artikel_DBC::artwar( $id_anwender, $id_artikel);
	header('Location: suche_antwort.php');
?>