<?php
	session_start();
	include_once '../_module/function.php';
	include_once '../_class/Kunde_DBC.php';
	include_once '../_class/db.php';

	//die Funktion sichere_eingaben() finden Sie im include function.php
	$vorname = $_POST['vorname'];
	$nachname = $_POST['nachname'];
	$anwender_name =  $_POST['anwender_name'];
	$passwort =  $_POST['passwort'];
	$email =  $_POST['email'];
	$adresse =  $_POST['adresse'];
	$hausnummer =  $_POST['hausnummer'];
	$plz =  $_POST['plz'];
	$ort =  $_POST['ort'];
	$land =  $_POST['land'];
	$frage1 =  $_POST['frage1'];
	$frage2 =  $_POST['frage2'];
	$frage3 =  $_POST['frage3'];
	//Passwort hashen
	function createSalt()
	{
		$text = md5(uniqid(rand(), TRUE));
		return substr($text, 0, 3);
	}
	$salt = createSalt();
	$passwort = hash('sha256', $salt . $passwort);
	
	if(Anwender_DBC::checkIfanwendernnameExists($anwender_name) == false){
		
		if(Anwender_DBC::registeranwender($vorname,$nachname,$email,$passwort,$anwender_name,$salt,$frage1,$frage2,$frage3)){
		$_SESSION['ereignis'] = 5;
		header('Location: index.php');
		} 
		else{
			echo"fehler";
		}
	}
	else{
		$_SESSION['ereignis'] = 3;
		header('Location: registrierung_anfrage.php');
	}
?>