<?php
	$titel="Passwort Vergessen";
	//Include die top.php.
	include '../_module/top.php';
	if (isset($_SESSION['anwender_name']) || isset($_SESSION['id_anwender']))
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

	$email = sichere_eingaben($mysqli, $_POST['email']);
	$frage1 = sichere_eingaben($mysqli, $_POST['frage1']);
	$frage2 = sichere_eingaben($mysqli, $_POST['frage2']);
	$frage3 = sichere_eingaben($mysqli, $_POST['frage3']);	
	$passwort = sichere_eingaben($mysqli, $_POST['passwort']);
	
	//Passwort hashen
	$select_anweisung = ( "	SELECT count(passwort) AS p, salt
							FROM tbl_anwender
							WHERE email = '".$email."'
							AND frage1 = '".$frage1."'
							AND frage2 = '".$frage2."'
							AND frage3 = '".$frage3."'");
									   
	$ergebnis = $mysqli->query($select_anweisung);
	$datensatz = $ergebnis->fetch_assoc();
	$hash = hash('sha256', $passwort);
	$salt = createSalt();
	$passwort = hash('sha256', '.datensatz[salt].' . $hash);
	echo"$passwort";
	