<?php
<<<<<<< HEAD
include '../_class/kunde_DBC.php';

session_start();

unset($_SESSION["login_error"]);

if (! isset($_POST["kundenname"]) || ! isset($_POST["passwort"]))
{
	$_SESSION["login_error"] = 1;
	echo "?_POST von Kundenname und Passwort nicht gesetzt!";
	header('Location: login.php');
	exit;
}

$kundenname = $_POST["kundenname"];
$passwort = $_POST["passwort"];

if (Kunde_DBC::checkPasswort($kundenname, $passwort))
{

	// erstelle/lade das Kundenobjekt (verwende eine Kunde_DBC-Methode)

	// speichere das Kundenobjekt in die Session (unter dem Key 'kunde')
	$_SESSION["kunde"] = Kunde_DBC::loadByKundenname($kundenname);
	// speichere in der Session unter dem Key 'ereignis' eine 1 (= erfolgreicher Login)
	$_SESSION["ereignis"] = 1;

	// lÃ¶sche(!) aus der Session einen mÃ¶glichen Eintrag unter dem Key 'login_error'
	unset($_SESSION["login_error"]);
	// leite weiter auf die Seite 'main.php'
	header('Location: index.php');
	exit;
}
else
{
	// speichere in der Session unter dem Key 'login_error' eine 2 (= Kundenname oder Passwort falsch)

    $_SESSION["login_error"] = 2;
    header('Location: login.php');
    exit;

	// leite weiter auf die Seite 'main.php'
}

?>

<br />
<br />
<a href="login.php">zurÃ¼ck</a>
=======
	session_start();
	//Verfollständige den titel der Seite durch eine Variable die in der header.php eingefügt wird.
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
			$_SESSION['ereignis'] = 4;
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
>>>>>>> origin/Marius
