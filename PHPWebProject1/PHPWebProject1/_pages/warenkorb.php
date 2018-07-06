<?php
//---------------------------------------------Top Modul wird includiert-------------------------------------------------------------
	include '../_module/top.php';
// --------------------------------------------Bottom------------------------------------------------------------->
		//datenbank connect 
		$mysqli = new mysqli(DB::$dbserver, DB::$dbuser, DB::$dbpassword, DB::$dbname);
//fall es nicht klappt gibt es ein erroro aus
		if ($mysqli->connect_errno) 
		{
			echo "Anmeldung fehlgeschlagen: ". $mysqli->connect_errno;
			exit(0);
		}
		$anwender = $_SESSION['anwender'];
		
		$mysqli->set_charset("utf8");
//liste ALLES aus denm warenkorb und die atikel aus
		$select_anweisung = "SELECT *
								FROM tbl_warenkorb AS w, tbl_artikel AS a
								WHERE w.artikel_id = a.id_artikel
								AND w.anwender_id = $anwender->id_anwender";
							 
		// echo "$select_anweisung";	 
		// exit;
		echo"<div class=\"maincontent-area align-container\">";
		if($ergebnismenge = $mysqli->query($select_anweisung)){	
				echo"<table style=\"border: solid 1px black; margin-right:20px\">
					<tr>
						<th>Bild</th><th>Produkt</th><th>Beschreibung</th><th>Menge</th><th>Preis</th><th>Entfernen</th></tr><tr>";
		while($datensatz = $ergebnismenge->fetch_assoc())
		{	
	
		$preis = $datensatz['preis']*$datensatz['menge'];

					//falls kein bild vorhanden ist für den artikel gib einen platzhalter aber wenn ein arikel bild da ist hole dir das bild aus der datenbank raus und aus dem _img/prdukte 
					
				if(empty($datensatz['bildpfadname'])){
					echo "<td style=\"border: solid 1px black\"><img src=\"../_img/produkte/unset.jpg\" alt=\"ERROR\"></td>";
				}
				else{
					echo "<td style=\"border: solid 1px black\"><img src=\"../_img/produkte/".$datensatz['bildpfadname']."\" alt=\"Kein Bild vorhanden\" height=\"42\" width=\"42\"></td>";
				}
				
				echo
				"<td style=\"border: solid 1px black\">".$datensatz['bezeichnug']."</td>".
				"<td style=\"border: solid 1px black\">".$datensatz['beschriebung']."</td>".
				"<td style=\"border: solid 1px black\">".$datensatz['menge']."</td>".
				"<td style=\"border: solid 1px black\">$preis</td>".
				"<td style=\"border: solid 1px black\"><a href=\"../_module/loeschewarenkorbinhalt.php?typ=entfernen&id_artikel=".$datensatz['id_artikel']."\">Entfernen</a></td>";
				echo"</tr>";
		}
		echo"</table><hr>";
		}
include '../_module/footer.php';
?>