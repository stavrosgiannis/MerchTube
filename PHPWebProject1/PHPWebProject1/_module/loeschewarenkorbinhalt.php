<?php
//include die werte der datenbank
	session_start();
	include '../_module/db.php';
/****************************************************************		Entfernen		*************************************************************/
if($_GET['typ'] == 'entfernen')
{
	//conection zur datenbank
	$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);
	//ausgabe wenn es nicht funktioniert
		if ($mysqli->connect_errno) 
						{
						echo "Anmeldung fehlgeschlagen: ". $mysqli->connect_errno;
						exit(0);
						}
//utf-8 wird in der datenbank verwendet
		$mysqli->set_charset("utf8");
		
//hier wird nur der artikel des anwenders samt seiner angaben aus dem wahrenkorg geworfen JEDER 
//ARTIKEL IM WAHREN KORB HAT EINEN KNOPF DAMIT MAN NICHT ALLES AUF EINMAL LÖSCHT DAFÜR SORGT DIE ID ARTIKEL

	$delete = "DELETE FROM tbl_warenkorb WHERE artikel_id=".$_GET['id_artikel']." AND anwender_id=".$_SESSION['anwender']->id_anwender."";
	
	$mysqli->query($delete);
//nach ausführung leitet es dih zur warenkorb seite weiter .
	header("Location: ../_pages/warenkorb.php");
}

/****************************************************************		Entfernen		*************************************************************/
	
	

if($_GET['typ'] == 'entfernenminuseins')
{
	$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);
	
		if ($mysqli->connect_errno) 
						{
						echo "Anmeldung fehlgeschlagen: ". $mysqli->connect_errno;
						exit(0);
						}

		$mysqli->set_charset("utf8");
	
	$select = "SELECT menge FROM tbl_warenkorb WHERE artikel_id='".$_GET['id_artikel']."' AND anwender_id='".$_SESSION['anweder']->id_anwender."'";
	
	$result = $mysqli->query($select);
	
	while($data = $result->fetch_assoc())
	{
		$menge1 = $data['menge'];
		
		$menge = $menge1-1;
	}
	
	if($menge1 > 1)
	{
		
		$update = "UPDATE tbl_warenkorb SET menge='".$menge."' WHERE anweder_id=".$_SESSION['anwender']->id_anwender." AND artikel_id='".$_GET['id_artikel']."'";
	
		$mysqli->query($update);
	}
	//überpruefen auf php name .ansonsten auch hier ändern//
	header("Location: ../_pages/warenkorb.php");
}
    else
	{
		$_SESSION['entfernen_error'] = 1;
		//HIER MUSS UMBEDINGT DIE SEITE DES PRODUKTES REIN-:im moment ist als platzhalter die start seite drin//
		header("Location: ../_pages/warenkorb.php");
?>