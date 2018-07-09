<?php
session_start();
include_once '../module/function.php';
include_once '../class/Kunde_DBC.php';
include_once '../class/db.php';

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
$passwort = hash('sha256', $passwort . $salt);

if(Anwender_DBC::checkIfanwendernnameExists($anwender_name) == false){

    if(Anwender_DBC::registeranwender($vorname,$nachname,$email,$passwort,$anwender_name,$salt,$frage1,$frage2,$frage3)){
		$_SESSION['ereignis'] = 5;
		//Profilbild hochladen
		$filename = basename($_FILES['upload_image']['name']);
        $extension = end(explode(".", $filename));
        $uploaddir = '../img/profilbilder/';
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