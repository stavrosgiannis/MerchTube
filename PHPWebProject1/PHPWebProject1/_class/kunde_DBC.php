<?php
include_once 'db.php';
include_once 'kunde.php';

class Kunde_DBC
{
	public static function loadByKundenname($kundenname)
	{

		$kunde = null;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			exit;
		}

		$sql = "SELECT * FROM tbl_kunde WHERE `kundenname`='$kundenname';";

		if ($result = $mysqli->query($sql))
		{
			if ($row = $result->fetch_assoc())
			{
				if ($row["geschaeftskunde_id"] != null)
				{
					$kunde = new Geschaeftskunde();

					// lese auch die Geschäftskundendaten
					$sql2 = "SELECT * FROM tbl_geschaeftskunde WHERE `geschaeftskunde_id`='". $row["geschaeftskunde_id"] ."';";

					if ($result2 = $mysqli->query($sql2))
					{
						if ($row2 = $result2->fetch_assoc())
						{
							$kunde->id_geschaeftskunde = $row2["id_geschaeftskunde"];
							$kunde->firmenname = $row2["firmenname"];
							$kunde->umstid = $row2["umstid"];
						}

						$result2->free();
					}
				}
				else
				{
					$kunde = new Kunde();
				}

				$kunde->id_kunde = $row["id_kunde"];
				$kunde->kundenname = $row["kundenname"];
				$kunde->passwort = $row["passwort"];
				$kunde->salt = $row["salt"];
				$kunde->vorname = $row["vorname"];
				$kunde->nachname = $row["nachname"];
				$kunde->email = $row["email"];

				// Lese profilbild daten vom Kunden
				$sql3 = "SELECT * FROM tbl_profilbild WHERE `id_profilbild`='". $row['profilbild_id'] ."';";

				if ($result3 = $mysqli->query($sql3))
				{
					while ($row3 = $result3->fetch_assoc())
					{
						$profilbild = new Profilbild();
						$profilbild->id_profilbild = $row3["id_profilbild"];
						$profilbild->pfad = $row3["pfad"];
						$profilbild->dateiname = $row3["original_dateiname"];
						$kunde->profilbild = $profilbild;
					}
					$result3->free();
				}

				// lese alle zum Kunden gehörigen Liefer- und Rechnungsanschriften
				$sql2 = "SELECT * FROM tbl_anschrift WHERE `kunde_id`='". $kunde->id_kunde ."';";

				if ($result2 = $mysqli->query($sql2))
				{
					while ($row2 = $result2->fetch_assoc())
					{
						$anschrift = new Anschrift();
						$anschrift->id_anschrift = $row2["id_anschrift"];
						$anschrift->strasse = $row2["strasse"];
						$anschrift->hausnummer = $row2["hausnummer"];
						$anschrift->plz = $row2["plz"];
						$anschrift->stadt = $row2["stadt"];

						if ($row2["typ"] == "R")
						{
							$kunde->rechnungsanschriftliste[] = $anschrift;
						}
						else
						{
							$kunde->lieferanschriftliste[] = $anschrift;
						}
					}

					$result2->free();
				}
			}

			$result->free();
		}

		return $kunde;
	}

    public static function registerKunde($kundenname,$email,$passwort,$salt,$nachname,$vorname)
    {

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			exit;
		}

		if (self::loadByKundenname($kundenname) == null)
		{
			$salt = uniqid(mt_rand(), true);
			$hash = hash('sha256', $passwort);

			$sql = "INSERT INTO `tbl_kunde` (`id_kunde`, `kundenname`,
			`email`, `passwort`, `salt`, `nachname`, `vorname`, `profilbild_id`,
			`geschaeftskunde_id`) VALUES (NULL, '$kundenname', '$email', '$hash', '$salt',
			'$nachname', '$vorname', NULL, NULL);";
			$result = $mysqli->query($sql);
			//echo "<hr>$result";
			if ($result == 1)
            {
                return true;
                exit;
            }
		}
        return false;
    }

    public static function insertOrUpdate($kunde, $isUpdateAnschrift = false)
	{
		if ($kunde == null)
		{
			return;
		}

		if ($kunde->id_kunde < 0)
		{
			return Kunde_DBC::insert($kunde);
		}
		else
		{
			return Kunde_DBC::update($kunde, $isUpdateAnschrift);
		}
	}

	private static function insert($kunde)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "INSERT INTO tbl_kunde(kundenname, email, passwort, nachname, vorname ) values ('".$kunde->kundenname."','".$kunde->email."','".$kunde->passwort."','".$kunde->nachname."','".$kunde->vorname."')'";

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
			$kunde->id_kunde = $mysqli->insert_id;

		}

		foreach ($kunde->rechnungsanschriftliste as $anschrift)
		{
			Kunde_DBC::insertOrUpdateAnschrift($kunde, $anschrift, 'R');
		}

		foreach ($kunde->lieferanschriftliste as $anschrift)
		{
			Kunde_DBC::insertOrUpdateAnschrift($kunde, $anschrift, 'L');
		}

		return $ergebnis;

	}

	private static function update($kunde, $isUpdateAnschrift)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "Update tbl_kunde Set email = '".$kunde->email."', passwort = '".$kunde->passwort."', nachname='".$kunde->nachname."', vorname = '".$kunde->vorname."' WHERE kundenname = '".$kunde->kundenname. "' ';";

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
			$kunde->id_kunde = $mysqli->insert_id;

		}

		foreach ($kunde->rechnungsanschriftliste as $anschrift)
		{
			Kunde_DBC::insertOrUpdateAnschrift($kunde, $anschrift, 'R');
		}

		foreach ($kunde->lieferanschriftliste as $anschrift)
		{
			Kunde_DBC::insertOrUpdateAnschrift($kunde, $anschrift, 'L');
		}

		return $ergebnis;
	}

	private static function delete($kunde)
	{
	}

	public static function insertOrUpdateAnschrift($kunde, $anschrift, $typ = null)
	{
		if (($kunde == null) || ($anschrift == null) || ($kunde->id_kunde < 0))
		{
			return false;
		}

		if ($anschrift->id_anschrift < 0)
		{
			return Kunde_DBC::insertAnschrift($kunde, $anschrift, $typ);
		}
		else
		{
			return Kunde_DBC::updateAnschrift($kunde, $anschrift);
		}
	}

	private static function insertAnschrift($kunde, $anschrift, $typ)
	{

		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "INSERT INTO tbl_anschrift(strasse, hausnummer, plz, stadt, typ, kunde_id ) values ('".$anschrift->strasse."','".$anschrift->hausnummer."', '".$anschrift->plz."', '".$anschrift->$stadt."','".$typ."','".$kunde->$id_kunde."')';";

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
			$anschrift->id_anschrift = $mysqli->insert_id;

		}

	}

	private static function updateAnschrift($kunde, $anschrift)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "Update tbl_anschrift Set strasse = '".$anschrift->strasse."', hausnummer = '".$anschrift->hausnummer."', plz ='".$anschrift->plz."', stadt = '".$anschrift->stadt."'';";

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
			$anschrift->id_anschrift = $mysqli->insert_id;

		}
	}

	private static function deleteAnschrift($kunde, $anschrift)
	{
	}

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
				$artikel->name = $row["name"];
				$artikel->beschreibung = $row["beschreibung"];
				$artikel->preis = $row["preis"];
				$artikel->bilddatei = $row["bilddatei"];
				$artikel->slogan = $row["slogan"];
			}

			$result->free();
		}
		return $artikel;
	}

	public static function checkPasswort($kundenname, $passwort)
	{

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

		$sql = "SELECT passwort, salt FROM tbl_kunde WHERE `kundenname`='$kundenname';";

		if ($result = $mysqli->query($sql))
		{
			if ($row = $result->fetch_assoc())
			{
				$hash = hash('sha256', $passwort);

				if ($hash == $row['passwort'])
				{
					return true;
				}
			}

			$result->free();
		}

		return false;
	}

	public static function checkIfKundennameExists($kundenname)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

		$sql = "SELECT * FROM tbl_kunde WHERE `kundenname`='$kundenname' LIMIT 1;";

		if ($result = $mysqli->query($sql) > 0)
		{
			$ergbenis = true;
		}else{
			$ergbenis = false;
		}
		return $ergebnis;
	}

}