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
								FROM tbl_warenkorb, tbl_artikel
								WHERE artikel_id = id_artikel 
								AND id_anwender = $anwender->id_anwender";
							 
				 
		$ergebnismenge = $mysqli->query($select_anweisung);
		echo"<div class=\"maincontent-area align-container\">";
		
		while($datensatz = $ergebnismenge->fetch_assoc())
		{	
	
	//falls 2 mal das gleiche produkt da ist soll auch der preis demendsprechend verhalten und sich erhöhen
	
		$preis = $datensatz['preis']*$datensatz['menge'];
			echo "<tr>\r\n";
					
					//falls kein bild vorhanden ist für den artikel gib einen platzhalter
					//aber wenn ein arikel bild da ist hole dir das
					//bild aus der datenbank raus und aus dem _img/prdukte 
					
				if(empty($datensatz['arikel_bild_id'])){
					echo "<td><img src=\"../_img/produkte/unset.jpg\" alt=\"ERROR\"></td>";
				}
				else{
					echo "<td><img src=\"../_img/produkte/".$datensatz['arikel_bild_id']."\" alt=\"Kein Bild vorhanden\"></td>";
				}
				
				echo"<form  action=\"loeschewarenkorbinhalt.php?typ='entfernen&id_artikel=".$datensatz['id_artikel']."'\" method=\"post\"> 
					<button class=\"Button\">Entfernen</button>
				</form>".
				"<td>".$datensatz['bezeichnung']."</td>".
				"<td>".$datensatz['beschreibung']."</td>".
				"<td>".$datensatz['menge']."</td>".
				"<td>$preis</td>";
		}
include '../_module/footer.php';
?>