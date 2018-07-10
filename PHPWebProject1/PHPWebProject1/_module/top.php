<!DOCTYPE html>
<html lang="de">

<?php
	set_include_path ('.');
	include_once '../_class/kunde.php';
	if(session_id() == ''){
		session_start();
	}
	include 'head.php';
	include_once '../_class/db.php';
	include_once '../_class/kunde_DBC.php';
	if(ISSET($_SESSION['anwender'])){
		
		$anwender = $_SESSION['anwender'];
		$login = $anwender->login;
		$id_anwender = $anwender->id_anwender;
		
		if($login == 3){
			Anwender_DBC::unkick($id_anwender);
			header('Location: logout.php');
		}
		if($login == 2){
			echo"<h1 style=\"test-aligne:center\">DER BANHAMMER HAT GESPROCHEN</h1>";
			exit;
		}
	}
?>

<body>

<?php
	include 'header.php';
	include 'menu.php';
	include 'sidebar.php';
?>