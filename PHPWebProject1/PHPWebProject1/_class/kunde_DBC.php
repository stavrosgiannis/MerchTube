<?php
include_once 'db.php';
include_once 'kunde.php';

class Anwender_DBC
{
	public static function loadByAnwendername($anwendername)
	{

		$anwender = null;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			exit;
		}

		$sql = "SELECT * FROM tbl_anwender WHERE anwender_name='$anwendername';";

		if ($result = $mysqli->query($sql))
		{
			if ($row = $result->fetch_assoc())
			{
				if ($row["geschaeftsanwender_id"] != null)
				{
					$anwender = new Geschaeftsanwender();

					// lese auch die Geschäftsanwenderndaten
					$sql2 = "SELECT * FROM tbl_geschaeftsanwender WHERE id_geschaeftsanwender ='". $row["geschaeftsanwender_id"] ."';";

					if ($result2 = $mysqli->query($sql2))
					{
						if ($row2 = $result2->fetch_assoc())
						{
							$anwender->id_geschaeftsanwender = $row2["id_geschaeftsanwender"];
							$anwender->firmenname = $row2["firmenname"];
							$anwender->umstid = $row2["umstid"];
						}

						$result2->free();
					}
				}
				else
				{
					$anwender = new anwender();
				}

				$anwender->id_anwender = $row["id_anwender"];
				$anwender->anwendernname = $row["anwender_name"];
				$anwender->passwort = $row["passwort"];
				$anwender->salt = $row["salt"];
				$anwender->login = $row["login"];
				$anwender->vorname = $row["vorname"];
				$anwender->nachname = $row["nachname"];
				$anwender->email = $row["email"];

				// Lese profilbild daten vom anwendern
				$sql3 = "SELECT * FROM tbl_profilbild WHERE id_profilbild='". $row['profilbild_id'] ."';";

				if ($result3 = $mysqli->query($sql3))
				{
					while ($row3 = $result3->fetch_assoc())
					{
						$profilbild = new Profilbild();
						$profilbild->id_profilbild = $row3["id_profilbild"];
						$profilbild->dateiname = $row3["name"];
						$anwender->profilbild = $profilbild;
					}
					$result3->free();
				}

				// lese alle zum anwendern gehörigen Liefer- und Rechnungsanschriften
				$sql2 = "SELECT * FROM tbl_adresse WHERE id_adresse='". $row["adresse_id"] ."';";

				if ($result2 = $mysqli->query($sql2))
				{
					while ($row2 = $result2->fetch_assoc())
					{
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
						}
					}

					$result2->free();
				}
			}

			$result->free();
		}

		return $anwender;
	}

    public static function registeranwender($vorname,$nachname,$email,$passwort,$anwender_name,$salt,$frage1,$frage2,$frage3)
    {
		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			exit;
		}
		
		$sql = "INSERT INTO tbl_anwender (vorname, nachname, email, passwort, anwender_name, profilbild_id, adresse_id, login, geschaeftsanwender_id, partner_id, bankverbindung_id, salt, frage1, frage2, frage3) 
									VALUES ('$vorname', '$nachname', '$email', '$passwort', '$anwender_name', NULL, NULL, '0', NULL, NULL, NULL, '$salt', '$frage1', '$frage2', '$frage3')";
		$result = $mysqli->query($sql);
		$id_anwender = $mysqli->insert_id;
		$sql1 = "INSERT INTO tbl_eingeloggt (anwender_id,eingeloggt) VALUES ('$id_anwender', '0');";
		$result = $mysqli->query($sql1);
		
		if ($result == 1)
		{
			return true;
			exit;
		}
        return false;
    }

    public static function insertOrUpdate($anwender, $isUpdateAnschrift = false)
	{
		if ($anwender == null)
		{
			return;
		}

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
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "INSERT INTO tbl_anwender(anwendernname, email, passwort, nachname, vorname ) values ('".$anwender->anwendernname."','".$anwender->email."','".$anwender->passwort."','".$anwender->nachname."','".$anwender->vorname."')'";

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
			$anwender->id_anwender = $mysqli->insert_id;

		}

		foreach ($anwender->rechnungsanschriftliste as $anschrift)
		{
			anwender_DBC::insertOrUpdateAnschrift($anwender, $anschrift, 'R');
		}

		foreach ($anwender->lieferanschriftliste as $anschrift)
		{
			anwender_DBC::insertOrUpdateAnschrift($anwender, $anschrift, 'L');
		}

		return $ergebnis;

	}

	private static function update($anwender, $isUpdateAnschrift)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "Update tbl_anwender Set email = '".$anwender->email."', passwort = '".$anwender->passwort."', nachname='".$anwender->nachname."', vorname = '".$anwender->vorname."' WHERE anwendernname = '".$anwender->anwendernname. "' ';";

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
			$anwender->id_anwender = $mysqli->insert_id;

		}

		foreach ($anwender->rechnungsanschriftliste as $anschrift)
		{
			anwender_DBC::insertOrUpdateAnschrift($anwender, $anschrift, 'R');
		}

		foreach ($anwender->lieferanschriftliste as $anschrift)
		{
			anwender_DBC::insertOrUpdateAnschrift($anwender, $anschrift, 'L');
		}

		return $ergebnis;
	}

	private static function delete($anwender)
	{
	}

	public static function insertOrUpdateAnschrift($anwender, $anschrift, $typ = null)
	{
		if (($anwender == null) || ($anschrift == null) || ($anwender->id_anwender < 0))
		{
			return false;
		}

		if ($anschrift->id_anschrift < 0)
		{
			return anwender_DBC::insertAnschrift($anwender, $anschrift, $typ);
		}
		else
		{
			return anwender_DBC::updateAnschrift($anwender, $anschrift);
		}
	}

	private static function insertAdresse($id_anwender,$adresse,$hausnummer,$plz,$ort,$land,$typ)
	{

		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ".
            $mysqli-connect_errno;
			return $ergebnis;
		}

		$sql = "INSERT INTO tbl_adresse(strasse, hausnummer, plz, ort, typ, anwender_id ) values ('".$anschrift->strasse."','".$anschrift->hausnummer."', '".$anschrift->plz."', '".$anschrift->$ort."','".$typ."','".$anwender->$id_anwender."')";

		if ($mysqli->query($sql) === TRUE)
		{
			$ergebnis = true;
			$anschrift->id_anschrift = $mysqli->insert_id;

		}

	}

	private static function updateAnschrift($anwender, $anschrift)
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

	private static function deleteAnschrift($anwender, $anschrift)
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

		$sql = "SELECT * FROM tbl_artikel WHERE 'artikelnummer'='".$artikelid."';";

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

	public static function checkPasswort($anwender_name, $passwort)
	{

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

		$sql = "SELECT * FROM tbl_anwender WHERE `anwender_name` = '$anwender_name';";

		if ($result = $mysqli->query($sql))
		{
			if ($row = $result->fetch_assoc())
			{
				$salt = $row['salt'];
				$passwort = hash('sha256', $passwort . $salt);

				if ($passwort == $row['passwort'])
				{
					
					return true;
				}	   
			}

			$result->free();
		}

		return false;
	}

	public static function checkIfanwendernnameExists($anwender_name)
	{
		$ergebnis = false;

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

		$sql = "SELECT * FROM tbl_anwender WHERE `anwender_name` = '$anwender_name' LIMIT 1;";
		
		$result = $mysqli->query($sql);
		$row_cnt = $result->num_rows;

		if ( $row_cnt > 0)
		{
			$ergebnis = true;
		}
		return $ergebnis;
	}	

	public static function einloggen($id_anwender)
	{

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

		$sql = "UPDATE tbl_eingeloggt SET eingeloggt = '1' WHERE anwender_id = '$id_anwender';";
		$result = $mysqli->query($sql);

	}

	public static function ausloggen($id_anwender)
	{

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

		$sql = "UPDATE tbl_eingeloggt SET eingeloggt = '0' WHERE anwender_id = '$id_anwender';";
		$result = $mysqli->query($sql);

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
			echo "<h1>Suchergebnisse</h1><hr><table style=\"border: solid 1px black\">";
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
						"<td style=\"border: solid 1px black\">".$datensatz['preis']."</td>".
						"<td style=\"border: solid 1px black\">".$datensatz['beschreibung']."</td>".
						"<td style=\"border: solid 1px black\"><a href=\"artikel_warenkorb.php?artnum=".$datensatz['id_artikel']."\">In Warenkorb legen</a></td>";
						echo"</tr>";
			}
			echo"</table></div>";
		}
	}	
	
	static function adminonlineuser()
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
				FROM tbl_eingeloggt, tbl_anwender 
				WHERE id_anwender = anwender_id;";
				
		$result = $mysqli->query($sql);
		$row_cnt = $result->num_rows;
		echo"<div class=\"maincontent-area align-container\">";
		if ( $row_cnt< 1)
		{
			$suchergebnis = NULL;
			echo"<h1>Admin - Keine Ergebnisse gefunden</h1>";
			exit;
		}
		else
		{	
			echo "<h1>Admin - Online Benutzer</h1><hr><table style=\"border: solid 1px black\"><th style=\"border: solid 1px black\">Status</th><th style=\"border: solid 1px black\">id_anwender</th><th style=\"border: solid 1px black\">Rang</th><th style=\"border: solid 1px black\">Vorname</th><th>Nachname</th><th style=\"border: solid 1px black\">Set Admin</th><th style=\"border: solid 1px black\">Kick</th><th style=\"border: solid 1px black\">Banhammer</th></tr><tr>";
			while($datensatz = $result->fetch_assoc())
			{
				echo "<tr>\r\n";
				
				if($datensatz['eingeloggt'] == 1){
					echo "<td style=\"border: solid 1px black;color:green;\">Online</td>";
				}
				if($datensatz['eingeloggt'] == 0){
					echo "<td style=\"border: solid 1px black;color:red;\">Offline</td>";
				}
				
				 echo "<td style=\"border: solid 1px black\">".$datensatz['id_anwender']."</td>";
				 
				if($datensatz['login'] == 1){
					echo "<td style=\"border: solid 1px black;color:blue;\">Admin</td>";
				}
				if($datensatz['login'] == 2){
					echo "<td style=\"border: solid 1px black;color:red;\">BAN</td>";
				}
				if($datensatz['login'] == 3){
					echo "<td style=\"border: solid 1px black;color:grey;\">User(Kick)</td>";
				}
				if($datensatz['login'] == 0){
					echo "<td style=\"border: solid 1px black;color:grey;\">User</td>";
				}				 
				
				 echo "<td style=\"border: solid 1px black\">".$datensatz['vorname']."</td>".
						"<td style=\"border: solid 1px black\">".$datensatz['nachname']."</td>".
						"<td style=\"border: solid 1px black\"><a href=\"admintools.php?typ=kick&id_anwender=".$datensatz['id_anwender']."\">Kicken</a></td>";
						
				if($datensatz['login'] == 1){
					echo "<td style=\"border: solid 1px black;color:blue;\"><a href=\"adminset.php?id_anwender=".$datensatz['id_anwender']."&typ=admin\">Set User</td>";
				}
				if($datensatz['login'] == 2){
					echo "<td style=\"border: solid 1px black;color:blue;\"><a href=\"adminset.php?id_anwender=".$datensatz['id_anwender']."&typ=admin\">Deban</td>";
				}
				if($datensatz['login'] == 3){
					echo "<td style=\"border: solid 1px black;color:blue;\"><a href=\"adminset.php?id_anwender=".$datensatz['id_anwender']."&typ=admin\">Unkick</td>";
				}
				if($datensatz['login'] == 0){
					echo "<td style=\"border: solid 1px black;color:blue;\"><a href=\"adminset.php?id_anwender=".$datensatz['id_anwender']."&typ=user\">Set Admin</td>";
				}	
				
						echo"<td style=\"border: solid 1px black\"><a style=\"text-docoration:none;color:red;\" href=\"admintools.php?typ=ban&id_anwender=".$datensatz['id_anwender']."\">Ban</a></td>";
						echo"</tr>";
			}
			echo"</table><hr><a href=\"admintools.php?typ=tool\">Zurück</a></div>";
		}
		
	}	
	
		public static function adminkick($id_anwender)
	{

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
		}

		$sql = "UPDATE tbl_anwender SET login = '3' WHERE tbl_anwender.id_anwender = $id_anwender;";
		$result = $mysqli->query($sql);
		header('Location: admintools.php?typ=onlineuser');

	}
	
		public static function adminban($id_anwender)
	{

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
			end;
		}

		$sql = "UPDATE tbl_anwender SET login = '2' WHERE id_anwender = '$id_anwender';";
		$result = $mysqli->query($sql);
		header('Location: admintools.php?typ=onlineuser');
	}		
	
	public static function unkick($id_anwender)
	{

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
			end;
		}

		$sql = "UPDATE tbl_anwender SET login = '0' WHERE id_anwender = '$id_anwender';";
		$result = $mysqli->query($sql);
	}		
	
	public static function adminsetadmin($id_anwender)
	{

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
			end;
		}

		$sql = "UPDATE tbl_anwender SET login = '1' WHERE id_anwender = '$id_anwender';";
		$result = $mysqli->query($sql);
	}	
	
	public static function adminsetuser($id_anwender)
	{

		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);

		if ($mysqli->connect_errno)
		{
			echo "Verbindung zur DB fehlgeschlagen: ". $mysqli-connect_errno;
			return false;
			end;
		}

		$sql = "UPDATE tbl_anwender SET login = '0' WHERE id_anwender = '$id_anwender';";
		$result = $mysqli->query($sql);
	}
}
?>