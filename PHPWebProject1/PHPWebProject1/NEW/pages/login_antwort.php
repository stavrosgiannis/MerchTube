<?php
session_start();
//Verfollständige den titel der Seite durch eine Variable die in der header.php eingefügt wird.
$titel="Login Antwort";
include_once '../module/function.php';
include_once '../class/db.php';
include_once '../class/kunde_DBC.php';

if (isset($_SESSION['anwender']))
{
    //verweist auf die Hauptseite, da der Kunde bereits eingeloggt ist
    header('Location: index.php');
    exit;

}

$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);
if ($mysqli->connect_errno)
{
    echo "Anmeldung fehlgeschlagen: ". $mysqli->connect_errno;
    exit(0);
}

//Der Zeichensatz zur Verstaendigung mit der DB wird festgelegt
$mysqli->set_charset("utf8");

//die Funktion sichere_eingaben() finden Sie im include function.php
$anwender_name = $_POST['anwender_name'];
$passwort = $_POST['passwort'];
echo 'Anwendername Abfrage-> ';
if (Anwender_DBC::checkIfanwendernnameExists($anwender_name))
{
    echo 'Checkpasswort abfrage-> ';
    if(Anwender_DBC::checkPasswort($anwender_name, $passwort))
    {
        echo 'richtiges passwort-> ';
        $_SESSION['anwender'] = Anwender_DBC::loadByAnwendername($anwender_name);
        $_SESSION['ereignis'] = 4;
        header('Location: index.php');
    }
    else
    {
        echo 'falsches passwort-> ';
        $_SESSION['ereignis'] = 2;
        header('Location: index.php');

    }
}
else
{
    echo 'Falscher Anwendername-> ';
    $_SESSION['ereignis'] = 6;
    header('Location: index.php');
}
?>