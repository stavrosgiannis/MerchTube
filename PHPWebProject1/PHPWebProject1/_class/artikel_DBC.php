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

}