<?php
	session_start();
	//Verfollst�ndige den titel der Seite durch eine Variable die in der header.php eingef�gt wird.
	$titel="Login Antwort";
	include_once '../_module/function.php';
	include_once '../_class/db.php';
	include_once '../_class/kunde_DBC.php';
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
	
	if (Anwender_DBC::checkIfanwendernnameExists($anwender_name))
	{
		if(Anwender_DBC::checkPasswort($anwender_name, $passwort))
		{
			$_SESSION['anwender'] = Anwender_DBC::loadByAnwendername($anwender_name);
			$anwender = $_SESSION['anwender'];
			$id_anwender = $anwender->id_anwender;
			$_SESSION['ereignis'] = 4;
			Anwender_DBC::einloggen($id_anwender);
			header('Location: index.php');
		}
		else
		{
			$_SESSION['ereignis'] = 2;
			header('Location: login_anfrage.php');
			
		}
	}else
	{
		$_SESSION['ereignis'] = 6;
			header('Location: login_anfrage.php');
	}
?>