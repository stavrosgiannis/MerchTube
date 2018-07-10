<?php
	include_once '../_module/function.php';
	include_once '../_class/artikel_DBC.php';
	include_once '../_class/kunde_DBC.php';
	include_once '../_class/db.php';
	include_once '../_class/kunde.php';
	session_start();
	$anwender = $_SESSION['anwender'];
	$login = $anwender->login;

	//var_dump($_SESSION['anwender']);
	//exit;
	
	
	if($login == 1){
		/**********************		Tool		*************************************************************/
		if($_GET['typ'] == 'tool')
		{
			include_once '../_module/top.php';
			echo"<div class=\"maincontent-area align-container\">";
			echo"<a href=\"admintools.php?typ=hinzufügen\"> Produkt hinzufügen </a><br>";
			echo"<a href=\"admintools.php?typ=entfernen\"> Produkt entfernen </a><br>";
			echo"<a href=\"admintools.php?typ=onlineuser\"> Online Anwender Anzeigen </a><br>";
		}
		/**********************		Entfernen		*************************************************************/
		if($_GET['typ'] == 'entfernen')
		{

			include_once '../_module/top.php';
			echo"<div class=\"maincontent-area align-container\">";
			Artikel_DBC::adminenartikelentfernen();
			echo"</div>";

		}
		/**********************		Entfernen Part 2		*****************************************************/
		if($_GET['typ'] == 'entfernen2')
		{
			$artikelnummer = $_GET['artikelnummer'];
			Artikel_DBC::adminenartikelentfernen2($artikelnummer);
			header('Location: admintools.php?typ=entfernen');
		}
		/**********************		Hinzufügen		*************************************************************/
		if($_GET['typ'] == 'hinzufügen')
		{
			include_once '../_module/top.php';?>
			<div class="maincontent-area align-container">
			<h1>Admin - Produkt Hinzufügen</h1><hr>
			<?php if(isset($_SESSION['ereignis']))
			{
				 if ($_SESSION['ereignis'] == 1338)
				 {
					  echo "<h2>Artikel hinzugefügt</h2>";
					  unset($_SESSION['ereignis']);
				 }
			}?> <a href="admintools.php?typ=tool">Zurück</a>
				<form action="admin_artikel_hinzufuegen.php" method="POST" enctype="multipart/form-data">
					<table>
					<!--Benutzer Daten-->
						<tr>
						<!--	Input Feld für den Zukünftigen Vornamen	-->
							<td>Bezeichnung:</td>
							<td><input type="text" name="bezeichnung" required></td>
						</tr>
						<tr>
						<!--	Input Feld für den Zukünftigen Nachnamen	-->
							<td>Beschreibung:</td>
							<td><input type="text" name="beschreibung" required></td>
						</tr>
						<tr>
						<!--	Input Feld für den Zukünftigen anwender Namen	-->
							<td>Preis:</td>
							<td><input type="text" name="preis" required></td>
						</tr>
						<tr>
						<!--	Input Feld für das Zukünftige Passwort	-->
							<td>Artikelnummer:</td>
							<td><input type="number" name="artnr" required></td>
						</tr>
						</tr>	
						<!--	Input Feld für das Zukünftige E-Mail Adresse	-->
							<td>Status:</td>
							<td><input type="number" name="status" required></td>
						</tr>
							</table>
						<input type="submit" name="artikel einfuegen" value="Hinzufügen">
					</form>
				</div>
			</div>
		<?php
		}
		
		/**********************		Onlineuser		*****************************************************/
		if($_GET['typ'] == 'onlineuser')
		{
			header("Refresh:2");
			include_once '../_module/top.php';
			anwender_DBC::adminonlineuser();
			echo"</div>";
		}
		
		/**********************		Onlineuser Part 2		*****************************************************/
		if($_GET['typ'] == 'ban')
		{
			$id_anwender = $_GET['id_anwender'];
			anwender_DBC::adminban($id_anwender);
		}
		
		/**********************		Onlineuser Part 2		*****************************************************/
		if($_GET['typ'] == 'kick')
		{
			$id_anwender = $_GET['id_anwender'];
			anwender_DBC::adminkick($id_anwender);
		}
		
		/**********************		!Banhammer 	*****************************************************/
		if($_GET['typ'] == 'banhammer')
		{
			include_once '../_module/top.php';
			Artikel_DBC::adminban();
		}
		
		/**********************		!Banhammer Part 2 	*****************************************************/
		if($_GET['typ'] == 'banhammer2')
		{
			Artikel_DBC::adminbanhammer2($id_anwender);
		}
	}	
	else{
		header('Location: index.php');
	}
?>