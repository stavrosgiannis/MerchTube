<?php
	include_once '../_module/function.php';
	include_once '../_class/artikel_DBC.php';
	include_once '../_class/db.php';
	include_once '../_class/kunde.php';
	session_start();
	$anwender = $_SESSION['anwender'];
	$login = $anwender->login;

	//var_dump($_SESSION['anwender']);
	//exit;
	
	
	if($login == 1){
		/**********************		Tool		*************************************************************/
		if($_GET['typ'] == 'tool')
		{
			include_once '../_module/top.php';
			echo"<div class=\"maincontent-area align-container\">";
			echo"<a href=\"admintools.php?typ=hinzufügen\"> Produkt hinzufügen </a><br>";
			echo"<a href=\"admintools.php?typ=entfernen\"> Produkt entfernen </a>";
		}
		/**********************		Entfernen		*************************************************************/
		if($_GET['typ'] == 'entfernen')
		{
			include_once '../_module/top.php';
			echo"<div class=\"maincontent-area align-container\">";
			Artikel_DBC::adminenartikelentfernen();
			echo"</div>";

		}
		/**********************		Entfernen Part 2		*****************************************************/
		if($_GET['typ'] == 'entfernen2')
		{
			$artikelnummer = $_GET['artikelnummer'];
			Artikel_DBC::adminenartikelentfernen2($artikelnummer);
			header('Location: admintools.php?typ=tool');
		}
		/**********************		Hinzufügen		*************************************************************/
		if($_GET['typ'] == 'hinzufügen')
		{
			include_once '../_module/top.php';
			echo"<div class=\"maincontent-area align-container\">";
			Artikel_DBC::adminenartikelhinzufügen();
			echo"</div>";
		}
	}	
	else{
		header('Location: index.php');
	}
?>