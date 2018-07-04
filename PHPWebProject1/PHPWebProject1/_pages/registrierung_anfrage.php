<?php
	//Verfollständige den titel der Seite durch eine Variable die in der header.php eingefügt wird.
	$titel="Registrierung";
	//Include die header.php.
	include '../_module/top.php';
?>
	<body>
	<div class="maincontent-area align-container">
	<?php
		if (isset($_SESSION['ereignis']))
		{
			 if($_SESSION['ereignis'] == 3)
			 {
				 echo "<h1>Registrierung Fehlgeschlagen</h1>";
				 $_SESSION['ereignis'] = 0;
			 }
		}
	?>
		<form action="registrierung_antwort.php" method="POST" enctype="multipart/form-data">
			<table>
			<!--Benutzer Daten-->
			<div>
				<tr>
				<!--	Input Feld für den Zukünftigen Vornamen	-->
					<td>Vorname:</td>
					<td><input type="text" name="vorname" required></td>
				</tr>
				<tr>
				<!--	Input Feld für den Zukünftigen Nachnamen	-->
					<td>Nachname:</td>
					<td><input type="text" name="nachname" required></td>
				</tr>
				<tr>
				<!--	Input Feld für den Zukünftigen anwender Namen	-->
					<td>Anwendername:</td>
					<td><input type="text" name="anwender_name" required></td>
				</tr>
				<tr>
				<!--	Input Feld für das Zukünftige Passwort	-->
					<td>Passwort:</td>
					<td><input type="password" name="passwort" required></td>
				</tr>
				</tr>	
				<!--	Input Feld für das Zukünftige E-Mail Adresse	-->
					<td>E-Mail Adresse:</td>
					<td><input type="email" name="email" required></td>
				</tr>
			<div/>
			<!--Benutzer Wohnort-->
			<div>				
				<tr>
				<!--	Input Feld für die Zukünftige Adresse	-->
					<td>Adresse:</td>
					<td><input type="text" name="adresse"></td>
				</tr>			
				<tr>
				<!--	Input Feld für die Zukünftige Hausnummer	-->
					<td>Hausnummer:</td>
					<td><input type="text" name="hausnummer"></td>
				</tr>		
				<tr>
				<!--	Input Feld für die Zukünftige PLZ	-->
					<td>PLZ:</td>
					<td><input type="text" name="plz"></td>
				</tr>		
				<tr>
				<!--	Input Feld für den Zukünftige Ort	-->
					<td>Ort:</td>
					<td><input type="text" name="ort"></td>
				</tr>		
				<tr>
				<!--	Input Feld für das Zukünftige Land	-->
					<td>Land:</td>
					<td><input type="text" name="land"></td>
				</tr>				
				<tr>
				<!--	Input Feld für die Zukünftige PLZ	-->
					<td>Frage1: Wer ist ihr Lieblings Superheld?</td>
					<td><input type="text" name="frage1" required></td>
				</tr>		
				<tr>
				<!--	Input Feld für den Zukünftige Ort	-->
					<td>Frage2: Was ist ihr Lieblings Essen?</td>
					<td><input type="text" name="frage2" required></td>
				</tr>		
				<tr>
				<!--	Input Feld für das Zukünftige Land	-->
					<td>Frage3: Wer ist ihr Lieblings Promi?</td>
					<td><input type="text" name="frage3" required></td>
				</tr>
			<div/>
			</table>
			<input type="submit" name="registrieren_knopf" value="Registrieren">
		</form>
		<div/>
	</body>
</html>