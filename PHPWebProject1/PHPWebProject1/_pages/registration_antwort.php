<?php
include '../_class/kunde_DBC.php';

session_start();

$kunde = new Kunde();
$kunde->kundenname = $_POST["kundenname"];
$kunde->passwort = $_POST["passwort"];
$kunde->vorname = $_POST["vorname"];
$kunde->nachname = $_POST["nachname"];
$kunde->email = $_POST["email"];

$anschrift = new Anschrift();
$anschrift->strasse = $_POST["strasse"];
$anschrift->hausnummer = $_POST["hausnummer"];
$anschrift->plz = $_POST["plz"];
$anschrift->stadt = $_POST["stadt"];

$passwort = $kunde->passwort;
$kundenname = $kunde->kundenname;
$email = $kunde->email;
$salt = "";
$vorname = $kunde->vorname;
$nachname = $kunde->nachname;

// In PHP kleiner als 4.1.0 sollten Sie $HTTP_POST_FILES anstatt
// $_FILES verwenden.
$filename = basename($_FILES['upload_image']['name']);

$extension = end(explode(".", $filename));
$uploaddir = '../_img/profilbilder/';
$uploadfile = $uploaddir . $_FILES['upload_image']['name'] = $kunde->kundenname.".".$extension ;

echo '<pre>';
if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile)) {
    echo "Datei ist valide und wurde erfolgreich hochgeladen.\n";
} else {
    echo "Möglicherweise eine Dateiupload-Attacke!\n";
}

echo 'Weitere Debugging Informationen:';
print_r($_FILES);

print "</pre>";

$profilbild = new Profilbild();
$profilbild->id_profilbild = -1;
$profilbild->pfad = $uploaddir;
$profilbild->dateiname = ($_FILES['upload_image']['name'] = $kunde->kundenname.".".$extension );

var_dump($profilbild);

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
    if (Kunde_DBC::registerKunde($kundenname,$email,$passwort,$salt,$nachname,$vorname))
    {

        //erfolgreich registiert = 1
        $_SESSION["register"] = 1;
        header('Location: login.php');
        exit;

    }else{

        //nicht erfolgreich registiert = 2
        $_SESSION["register"] = 2;
        header('Location: login.php');
        exit;

    }

}
?>

<br />
<br />
<a href="login.php">zurück</a>