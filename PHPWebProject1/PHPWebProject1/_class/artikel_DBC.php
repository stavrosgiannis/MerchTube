<?php
include_once 'db.php';
include_once 'artikel.php';

class Artikel_DBC
{

	public static function checkArtikelID($artikelid)
	{
		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

		$sql = "SELECT * FROM tbl_artikel WHERE `artikelnummer`='".$artikelid."';";

		if ($result = $mysqli->query($sql))
		{
			if ($row = $result->fetch_assoc())
			{
				$artikel = new Artikel();
				$artikel->id_artikel = $row["id_artikel"];
				$artikel->artikelnummer = $row["artikelnummer"];
				$artikel->marke = $row["marke"];
				$artikel->modell = $row["modell"];
				$artikel->beschreibung = $row["beschreibung"];
				$artikel->preis = $row["preis"];
				$artikel->bilddatei = $row["bilddatei"];
				$artikel->slogan = $row["slogan"];
				$artikel->kategorie = $row["kategorie"];
			}

			$result->free();
		}
		return $artikel;
	}

	public static function GetArticleForBestseller($artikelid)
	{
		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

		$sql = "SELECT *
				FROM tbl_bestseller, tbl_artikel
				WHERE tbl_artikel.id_artikel = tbl_bestseller.artikel_id";

		if ($result = $mysqli->query($sql))
		{
			if ($row = $result->fetch_assoc())
			{
				$artikel = new Artikel();
				$artikel->id_artikel = $row["id_artikel"];
				$artikel->artikelnummer = $row["artikelnummer"];
				$artikel->marke = $row["marke"];
				$artikel->modell = $row["modell"];
				$artikel->beschreibung = $row["beschreibung"];
				$artikel->preis = $row["preis"];
				$artikel->bilddatei = $row["bilddatei"];
				$artikel->slogan = $row["slogan"];
			}

			$result->free();
		}
		return $artikel;
	}	
	
	static function adminenartikelentfernen()
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "SELECT * 
				FROM tbl_artikel";
				
		$result = $mysqli->query($sql);
		$row_cnt = $result->num_rows;
		
		if ( $row_cnt< 1)
		{
			$suchergebnis = NULL;
			echo"<h1>Keine Produkte gefunden!!</h1><hr><a href='admintools.php?typ=tool'>Zurück</a>";
			exit;
		}
		else
		{	
			echo "<h1>Admin - Produkte aus Katalog entfernen!!!</h1>";					
			if(isset($_SESSION['ereignis']))
			{
				 if ($_SESSION['ereignis'] == 1337)
				 {
					  echo "<h2>Artikel entfernet</h2>";
					  unset($_SESSION['ereignis']);
				 }
			}
			echo"<a href=\"admintools.php?typ=tool\";>Zurück</a><hr><table style=\"border: solid 1px black\">";
			while($datensatz = $result->fetch_assoc())
			{
				echo "<tr>\r\n";
				if(empty($datensatz['bildpfadname']) ){
					echo"<td style=\"border: solid 1px black\"><img src=\"../_img/produkte/unset.jpg\" alt=\"Kein Bild Gefunden\" height=\"42px\" width=\"42px\"></td>";
				} 
				else{
					echo"<td style=\"border: solid 1px black\"><img src=\"../_img/produkte/".$datensatz['bildpfadname']."\" alt=\"Kein Bild Gefunden\" height=\"42px\" width=\"42px\"></td>";
				}
				 echo "<td style=\"border: solid 1px black\">".$datensatz['bezeichnug']."</td>".
						"<td style=\"border: solid 1px black\">".$datensatz['artikelnummer']."</td>".
						"<td style=\"border: solid 1px black\"><a href=\"admintools.php?typ=entfernen2&artikelnummer=".$datensatz['artikelnummer']."\">Entfernen</a></td>";
						echo"</tr>";
			}
			echo"</table></div>";
		}
	}
	
	static function adminenartikelentfernen2($artikelnummer)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
		}
		//utf-8 wird in der datenbank verwendet
		$mysqli->set_charset("utf8");

		$delete = "delete from tbl_artikel WHERE artikelnummer='$artikelnummer'";
		$mysqli->query($delete);
		$_SESSION['ereignis'] = 1337;
	}	
	
	static function admin_artikel_hinzufuegen($bezeichnung, $beschreibung, $preis, $artnr, $status)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
		}
		
		$sql = "INSERT INTO tbl_artikel (id_artikel, bezeichnug, beschreibung, preis, status, bildpfadname, artikelnummer)
		VALUES ('NULL', '$bezeichnung', '$beschreibung', '$preis','0','NULL', '$artnr')";
		if ($mysqli->query($sql) === TRUE) {
		$_SESSION['ereignis'] = 1338;
		header('Location: admintools.php?typ=hinzufügen');
		} 
		else {
			echo "Error: " . $sql . "<br>" . $mysqli->error;
		}
	}
	
	static function artwar( $id_anwender, $id_artikel)
	{
		$ergebnis = false;
		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
		}
		
		$sql = "INSERT INTO tbl_warenkorb (anwender_id, artikel_id, menge) VALUES ('$id_anwender', '$id_artikel', '1');";
		if ($mysqli->query($sql) === TRUE) {
		$_SESSION['ereignis'] = 1339;
		header('Location: admintools.php?typ=hinzufügen');
		} 
		else {
			echo "Error: " . $sql . "<br>" . $mysqli->error;
		}	
	}
}