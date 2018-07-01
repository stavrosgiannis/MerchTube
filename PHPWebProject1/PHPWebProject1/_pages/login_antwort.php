<?php
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

	// lösche(!) aus der Session einen möglichen Eintrag unter dem Key 'login_error'
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
<a href="login.php">zurück</a>