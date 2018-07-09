<?php
session_start();
include '../_module/db.php';
/****************************************************************		Hinzufuegen		*************************************************************/
//guckt ob der anwender in der datenbank bereits vorhanden ist
if(Isset($_SESSION['anwender']))
{
    //conectet die datenban verbindungen
    $mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);
	//guckt ob ein fehler bei der conection passiert ist falls ja gib erroro aus
    if ($mysqli->connect_errno)
    {
        echo "Anmeldung fehlgeschlagen: ". $mysqli->connect_errno;
        exit(0);
    }
    //sql OB ES DER WAREN KORB DES ANWEDER IST und die atikel darin
    $mysqli->set_charset("utf8");

    $select = "SELECT * FROM tbl_warenkorb
		                    WHERE anwender_id = '".$_SESSION['anwender']->id_anwender."' AND artikle_id = '".$_POST['id_artikle']."'";

    $result = $mysqli->query($select);

    if(mysqli_num_rows($result) == "")
    //falls alles stimmt füge die information aus tbl warenkorb und der anwender id und die menge ein

    {
        $insert = "INSERT INTO tbl_warenkorb (anwender_id, anwender_id, menge)
					VALUES ('".$_SESSION['anwender']->id_anwender."', '".$_POST['id_artikel']."', '".$_POST['menge']."')";

        $mysqli->query($insert);
    }
    // falls bereits etwas in ner num row steht wird es geupdated
    else
    {
        while($data = $result->fetch_assoc())
        {
            $menge = $data['menge'];
        }
        $menge = $menge+$_POST['menge'];

        $update = "UPDATE tbl_warenkorb SET menge='".$menge."' WHERE artikel_id = '".$_POST['id_artikel']."' AND anwender_id = '".$_SESSION['anwender']->id_anwender."'";

        $mysqli->query($update);
    }
    //soll wennn es eine ware hinzugefügt hat auf die page vom warenkorb verwisen//
    header("Location: ../_pages/warenkorb.php");
}
else
{
    $_SESSION['hinzufuegen_error'] = 1;
    //HIER MUSS UMBEDINGT DIE SEITE DES PRODUKTES REIN-:im moment ist als platzhalter die start seite drin//
    header("Location: ../_pages/index.php");
}

?>