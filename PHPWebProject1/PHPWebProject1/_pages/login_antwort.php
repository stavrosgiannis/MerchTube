<?php
	session_start();
	//Verfollständige den titel der Seite durch eine Variable die in der header.php eingefügt wird.
	$titel="Login Antwort";
	include_once '../_module/function.php';
	include_once '../_class/db.php';
	$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);
	if (isset($_SESSION['anwender_name']) AND isset($_SESSION['id_anwender']))
	{
		//verweist auf die Hauptseite, da der Kunde bereits eingeloggt ist
		header('Location: main.php');
		exit;
	}
	
	if ($mysqli->connect_errno) 
	{
		echo "Anmeldung fehlgeschlagen: ". $mysqli->connect_errno;
		exit(0);
	}
	//Der Zeichensatz zur Verstaendigung mit der DB wird festgelegt
	$mysqli->set_charset("utf8");
	
	//die Funktion sichere_eingaben() finden Sie im include function.php
	$anwender_name = sichere_eingaben($mysqli, $_POST['anwender_name']);
	$passwort = sichere_eingaben($mysqli, $_POST['passwort']);
	
	
	include_once '../_class/kunde_DBC.php';
	if(Anwender_DBC::checkPasswort($anwender_name, $passwort)){
		$_SESSION['anwender'] = Anwender_DBC::loadbyanwendername($anwender_name);
		$_SESSION['ereignis'] = 4;
		header('Location: index.php');
	}
	else{
		$_SESSION['ereignis'] = 2;
		header('Location: login_anfrage.php');
		
	}
		
?>