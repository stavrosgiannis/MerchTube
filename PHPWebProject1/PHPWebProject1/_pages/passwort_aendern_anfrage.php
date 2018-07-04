<?php
	$titel="Passwort Vergessen";
	//Include die header.php.
	include '../_module/top.php';
	if (isset($_SESSION['anwender_name']) || isset($_SESSION['id_anwender']))
	{
		//verweist auf die Hauptseite, da der Kunde bereits eingeloggt ist
		header('Location: main.php');
		exit;
	}
	echo"<body>
	<div class=\"maincontent-area align-container\">
	<p>Bitte f&uuml;llen Sie die nachfolgenden Eingabefelder aus, um sich anzumelden:</p>
	<form action=\"passwort_aendern_antwort.php\" method=\"POST\">
		<table>
			<tr>
			<!--	Input Feld für die E-Mail Adresse	-->
				<td>E-mail Adresse:</td>
				<td><input type=\"email\" name=\"anwender_name\"></td>
			</tr>			
			<tr>
			<!--	Input Feld für die erste Frage	-->
				<td>Frage1: Wer ist ihr Lieblings Superheld?</td>
				<td><input type=\"text\" name=\"frage1\" required></td>
			</tr>		
			<tr>
			<!--	Input Feld für den Zukünftige Ort	-->
				<td>Frage2: Was ist ihr Lieblings Essen?</td>
				<td><input type=\"text\" name=\"frage2\" required></td>
			</tr>		
			<tr>
			<!--	Input Feld für das Zukünftige Land	-->
				<td>Frage3: Wer ist ihr Lieblings Promi?</td>
				<td><input type=\"text\" name=\"frage3\" required></td>
			</tr>		
			<tr>
			<!--	Input Feld für das Zukünftige Land	-->
				<td>Neues Passwort:</td>
				<td><input type=\"text\" name=\"passwort\" required></td>
			</tr>
		</table>
		<input type=\"submit\" name=\"anmelden\" value=\"Anmelden\">
	</form>
	<a href=\"registrierung_anfrage.php\">Registrieren</a>
	<div/>";