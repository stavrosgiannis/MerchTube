<?php
include_once 'db.php';
include_once 'kunde.php';

<<<<<<< HEAD
class Kunde_DBC
{
	public static function loadByKundenname($kundenname)
	{

		$kunde = null;
=======
class Anwender_DBC
{
	public static function loadByAnwendername($anwendername)
	{

		$anwender = null;
>>>>>>> origin/Marius

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			exit;
		}

<<<<<<< HEAD
		$sql = "SELECT * FROM tbl_kunde WHERE `kundenname`='$kundenname';";
=======
		$sql = "SELECT * FROM tbl_anwender WHERE anwender_name='$anwendername';";
>>>>>>> origin/Marius

		if ($result = $mysqli->query($sql))
		{
			if ($row = $result->fetch_assoc())
			{
<<<<<<< HEAD
				if ($row["geschaeftskunde_id"] != null)
				{
					$kunde = new Geschaeftskunde();

					// lese auch die Geschäftskundendaten
					$sql2 = "SELECT * FROM tbl_geschaeftskunde WHERE `geschaeftskunde_id`='". $row["geschaeftskunde_id"] ."';";
=======
				if ($row["geschaeftsanwender_id"] != null)
				{
					$anwender = new Geschaeftsanwender();

					// lese auch die Geschäftsanwenderndaten
					$sql2 = "SELECT * FROM tbl_geschaeftsanwender WHERE id_geschaeftsanwender ='". $row["geschaeftsanwender_id"] ."';";
>>>>>>> origin/Marius

					if ($result2 = $mysqli->query($sql2))
					{
						if ($row2 = $result2->fetch_assoc())
						{
<<<<<<< HEAD
							$kunde->id_geschaeftskunde = $row2["id_geschaeftskunde"];
							$kunde->firmenname = $row2["firmenname"];
							$kunde->umstid = $row2["umstid"];
=======
							$anwender->id_geschaeftsanwender = $row2["id_geschaeftsanwender"];
							$anwender->firmenname = $row2["firmenname"];
							$anwender->umstid = $row2["umstid"];
>>>>>>> origin/Marius
						}

						$result2->free();
					}
				}
				else
				{
<<<<<<< HEAD
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
=======
					$anwender = new anwender();
				}

				$anwender->id_anwender = $row["id_anwender"];
				$anwender->anwendernname = $row["anwender_name"];
				$anwender->passwort = $row["passwort"];
				$anwender->salt = $row["salt"];
				$anwender->vorname = $row["vorname"];
				$anwender->nachname = $row["nachname"];
				$anwender->email = $row["email"];

				// Lese profilbild daten vom anwendern
				$sql3 = "SELECT * FROM tbl_profilbild WHERE id_profilbild='". $row['profilbild_id'] ."';";
>>>>>>> origin/Marius

				if ($result3 = $mysqli->query($sql3))
				{
					while ($row3 = $result3->fetch_assoc())
					{
						$profilbild = new Profilbild();
						$profilbild->id_profilbild = $row3["id_profilbild"];
<<<<<<< HEAD
						$profilbild->pfad = $row3["pfad"];
						$profilbild->dateiname = $row3["original_dateiname"];
						$kunde->profilbild = $profilbild;
=======
						$profilbild->dateiname = $row3["name"];
						$anwender->profilbild = $profilbild;
>>>>>>> origin/Marius
					}
					$result3->free();
				}

<<<<<<< HEAD
				// lese alle zum Kunden gehörigen Liefer- und Rechnungsanschriften
				$sql2 = "SELECT * FROM tbl_anschrift WHERE `kunde_id`='". $kunde->id_kunde ."';";
=======
				// lese alle zum anwendern gehörigen Liefer- und Rechnungsanschriften
				$sql2 = "SELECT * FROM tbl_adresse WHERE id_adresse='". $row["adresse_id"] ."';";
>>>>>>> origin/Marius

				if ($result2 = $mysqli->query($sql2))
				{
					while ($row2 = $result2->fetch_assoc())
					{
<<<<<<< HEAD
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
=======
						$anschrift = new Adresse();
						$anschrift->id_adresse = $row2["id_adresse"];
						$anschrift->strasse = $row2["strasse"];
						$anschrift->hausnummer = $row2["hausnummer"];
						$anschrift->plz = $row2["plz"];
						$anschrift->ort = $row2["ort"];
						$anschrift->land = $row2["land"];

						if ($row2["typ"] == "R")
						{
							$anwender->rechnungsanschriftliste[] = $anschrift;
						}
						else
						{
							$anwender->lieferanschriftliste[] = $anschrift;
>>>>>>> origin/Marius
						}
					}

					$result2->free();
				}
			}

			$result->free();
		}

<<<<<<< HEAD
		return $kunde;
	}

    public static function registerKunde($kundenname,$email,$passwort,$salt,$nachname,$vorname)
    {

=======
		return $anwender;
	}

    public static function registeranwender($vorname,$nachname,$email,$passwort,$anwender_name,$salt,$frage1,$frage2,$frage3)
    {
>>>>>>> origin/Marius
		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			exit;
		}
<<<<<<< HEAD

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
=======
		
		$sql = "INSERT INTO tbl_anwender (`id_anwender`, `vorname`, `nachname`, `email`, `passwort`, `anwender_name`, `profilbild_id`, `adresse_id`, `login`, `rechnung_id`, `geschaeftsanwender_id`, `partner_id`, `bankverbindung_id`, `salt`, `frage1`, `frage2`, `frage3`) 
									VALUES (NULL, '$vorname', '$nachname', '$email', '$passwort', '$anwender_name', NULL, NULL, '0', NULL, NULL, NULL, NULL, '$salt', '$frage1', '$frage2', '$frage3')";
		
		print_r ($sql);
		$result = $mysqli->query($sql);
		
		if ($result == 1)
		{
			return true;
			exit;
>>>>>>> origin/Marius
		}
        return false;
    }

<<<<<<< HEAD
    public static function insertOrUpdate($kunde, $isUpdateAnschrift = false)
	{
		if ($kunde == null)
=======
    public static function insertOrUpdate($anwender, $isUpdateAnschrift = false)
	{
		if ($anwender == null)
>>>>>>> origin/Marius
		{
			return;
		}

<<<<<<< HEAD
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
=======
		if ($anwender->id_anwender < 0)
		{
			return anwender_DBC::insert($anwender);
		}
		else
		{
			return anwender_DBC::update($anwender, $isUpdateAnschrift);
		}
	}

	private static function insert($anwender)
>>>>>>> origin/Marius
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

<<<<<<< HEAD
		$sql = "INSERT INTO tbl_kunde(kundenname, email, passwort, nachname, vorname ) values ('".$kunde->kundenname."','".$kunde->email."','".$kunde->passwort."','".$kunde->nachname."','".$kunde->vorname."')'";
=======
		$sql = "INSERT INTO tbl_anwender(anwendernname, email, passwort, nachname, vorname ) values ('".$anwender->anwendernname."','".$anwender->email."','".$anwender->passwort."','".$anwender->nachname."','".$anwender->vorname."')'";
>>>>>>> origin/Marius

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
<<<<<<< HEAD
			$kunde->id_kunde = $mysqli->insert_id;

		}

		foreach ($kunde->rechnungsanschriftliste as $anschrift)
		{
			Kunde_DBC::insertOrUpdateAnschrift($kunde, $anschrift, 'R');
		}

		foreach ($kunde->lieferanschriftliste as $anschrift)
		{
			Kunde_DBC::insertOrUpdateAnschrift($kunde, $anschrift, 'L');
=======
			$anwender->id_anwender = $mysqli->insert_id;

		}

		foreach ($anwender->rechnungsanschriftliste as $anschrift)
		{
			anwender_DBC::insertOrUpdateAnschrift($anwender, $anschrift, 'R');
		}

		foreach ($anwender->lieferanschriftliste as $anschrift)
		{
			anwender_DBC::insertOrUpdateAnschrift($anwender, $anschrift, 'L');
>>>>>>> origin/Marius
		}

		return $ergebnis;

	}

<<<<<<< HEAD
	private static function update($kunde, $isUpdateAnschrift)
=======
	private static function update($anwender, $isUpdateAnschrift)
>>>>>>> origin/Marius
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

<<<<<<< HEAD
		$sql = "Update tbl_kunde Set email = '".$kunde->email."', passwort = '".$kunde->passwort."', nachname='".$kunde->nachname."', vorname = '".$kunde->vorname."' WHERE kundenname = '".$kunde->kundenname. "' ';";
=======
		$sql = "Update tbl_anwender Set email = '".$anwender->email."', passwort = '".$anwender->passwort."', nachname='".$anwender->nachname."', vorname = '".$anwender->vorname."' WHERE anwendernname = '".$anwender->anwendernname. "' ';";
>>>>>>> origin/Marius

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
<<<<<<< HEAD
			$kunde->id_kunde = $mysqli->insert_id;

		}

		foreach ($kunde->rechnungsanschriftliste as $anschrift)
		{
			Kunde_DBC::insertOrUpdateAnschrift($kunde, $anschrift, 'R');
		}

		foreach ($kunde->lieferanschriftliste as $anschrift)
		{
			Kunde_DBC::insertOrUpdateAnschrift($kunde, $anschrift, 'L');
=======
			$anwender->id_anwender = $mysqli->insert_id;

		}

		foreach ($anwender->rechnungsanschriftliste as $anschrift)
		{
			anwender_DBC::insertOrUpdateAnschrift($anwender, $anschrift, 'R');
		}

		foreach ($anwender->lieferanschriftliste as $anschrift)
		{
			anwender_DBC::insertOrUpdateAnschrift($anwender, $anschrift, 'L');
>>>>>>> origin/Marius
		}

		return $ergebnis;
	}

<<<<<<< HEAD
	private static function delete($kunde)
	{
	}

	public static function insertOrUpdateAnschrift($kunde, $anschrift, $typ = null)
	{
		if (($kunde == null) || ($anschrift == null) || ($kunde->id_kunde < 0))
=======
	private static function delete($anwender)
	{
	}

	public static function insertOrUpdateAnschrift($anwender, $anschrift, $typ = null)
	{
		if (($anwender == null) || ($anschrift == null) || ($anwender->id_anwender < 0))
>>>>>>> origin/Marius
		{
			return false;
		}

		if ($anschrift->id_anschrift < 0)
		{
<<<<<<< HEAD
			return Kunde_DBC::insertAnschrift($kunde, $anschrift, $typ);
		}
		else
		{
			return Kunde_DBC::updateAnschrift($kunde, $anschrift);
		}
	}

	private static function insertAnschrift($kunde, $anschrift, $typ)
=======
			return anwender_DBC::insertAnschrift($anwender, $anschrift, $typ);
		}
		else
		{
			return anwender_DBC::updateAnschrift($anwender, $anschrift);
		}
	}

	private static function insertAdresse($id_anwender,$adresse,$hausnummer,$plz,$ort,$land,$typ)
>>>>>>> origin/Marius
	{

		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

<<<<<<< HEAD
		$sql = "INSERT INTO tbl_anschrift(strasse, hausnummer, plz, stadt, typ, kunde_id ) values ('".$anschrift->strasse."','".$anschrift->hausnummer."', '".$anschrift->plz."', '".$anschrift->$stadt."','".$typ."','".$kunde->$id_kunde."')';";
=======
		$sql = "INSERT INTO tbl_adresse(strasse, hausnummer, plz, ort, typ, anwender_id ) values ('".$anschrift->strasse."','".$anschrift->hausnummer."', '".$anschrift->plz."', '".$anschrift->$ort."','".$typ."','".$anwender->$id_anwender."')';";
>>>>>>> origin/Marius

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
			$anschrift->id_anschrift = $mysqli->insert_id;

		}

	}

<<<<<<< HEAD
	private static function updateAnschrift($kunde, $anschrift)
=======
	private static function updateAnschrift($anwender, $anschrift)
>>>>>>> origin/Marius
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

<<<<<<< HEAD
	private static function deleteAnschrift($kunde, $anschrift)
=======
	private static function deleteAnschrift($anwender, $anschrift)
>>>>>>> origin/Marius
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

<<<<<<< HEAD
		$sql = "SELECT * FROM tbl_artikel WHERE `artikelnummer`='".$artikelid."';";
=======
		$sql = "SELECT * FROM tbl_artikel WHERE 'artikelnummer'='".$artikelid."';";
>>>>>>> origin/Marius

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

<<<<<<< HEAD
	public static function checkPasswort($kundenname, $passwort)
=======
	public static function checkPasswort($anwender_name, $passwort)
>>>>>>> origin/Marius
	{

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

<<<<<<< HEAD
		$sql = "SELECT passwort, salt FROM tbl_kunde WHERE `kundenname`='$kundenname';";
=======
		$sql = "SELECT * FROM tbl_anwender WHERE `anwender_name` = '$anwender_name';";
>>>>>>> origin/Marius

		if ($result = $mysqli->query($sql))
		{
			if ($row = $result->fetch_assoc())
			{
<<<<<<< HEAD
				$hash = hash('sha256', $passwort);

				if ($hash == $row['passwort'])
				{
					return true;
				}
=======
				$salt = $row['salt'];
				$passwort = hash('sha256', $passwort . $salt);

				if ($passwort == $row['passwort'])
				{
					
					return true;
				}	   
>>>>>>> origin/Marius
			}

			$result->free();
		}

		return false;
	}

<<<<<<< HEAD
	public static function checkIfKundennameExists($kundenname)
=======
	public static function checkIfanwendernnameExists($anwender_name)
>>>>>>> origin/Marius
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

<<<<<<< HEAD
		$sql = "SELECT * FROM tbl_kunde WHERE `kundenname`='$kundenname' LIMIT 1;";

		if ($result = $mysqli->query($sql) > 0)
		{
			$ergbenis = true;
		}else{
			$ergbenis = false;
		}
		return $ergebnis;
=======
		$sql = "SELECT * FROM tbl_anwender WHERE `anwender_name` = '$anwender_name' LIMIT 1;";
		
		$result = $mysqli->query($sql);
		$row_cnt = $result->num_rows;

		if ( $row_cnt > 0)
		{
			$ergebnis = true;
		}
		return $ergebnis;
	}	
	
	static function suche($sucheingabe)
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
				FROM `tbl_artikel` 
				WHERE bezeichnug LIKE '%$sucheingabe%';";
		$result = $mysqli->query($sql);
		$row_cnt = $result->num_rows;
			echo"<div class=\"maincontent-area align-container\">";
		if ( $row_cnt< 1)
		{
			$suchergebnis = NULL;
			echo"<h1>Keine Ergebnisse gefunden!!</h1>";
			exit;
		}
		else
		{	
			echo "<h1>Suchergebnisse</h1>";
			while($datensatz = $result->fetch_assoc())
			{
				echo "<tr>\r\n";
				if( empty($datensatz['arikel_bild_id']) ){
					echo"<img src=\"../_img/produkte/unset.jpg\" alt=\"Kein Bild Gefunden\" height=\"42px\" width=\"42px\">";
				} 
				else{
					echo"<img src=\"../_img/produkte/".$datensatz['	bildpfadname']."\" alt=\"Kein Bild Gefunden\" height=\"42px\" width=\"42px\">";
				}
				 echo "<td>".$datensatz['bezeichnug']."</td>".
						"<td>".$datensatz['preis']."</td>".
						"<td>".$datensatz['beschriebung']."</td>";
			}
			echo"</div>";
		}
>>>>>>> origin/Marius
	}

}