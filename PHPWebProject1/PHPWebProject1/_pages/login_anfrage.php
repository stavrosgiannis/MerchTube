<?php
	$titel="Login";
	//Include die header.php.
	include '../_module/top.php';
	if (isset($_SESSION['anwender_name']) || isset($_SESSION['id_anwender']))
?>
<body>

<div class="maincontent-area align-container">

<?php
	if(ISSET($_SESSION['ereignis'])){
		 if ($_SESSION['ereignis'] == 6)
		 {
			  echo "<h2>Der Anwendername ist falsch!</h2>";
			  unset($_SESSION['ereignis']);
		 }
		 elseif ($_SESSION['ereignis'] == 2)
		 {
			  echo "<h2>Das Passwort ist falsch!</h2>";
			  unset($_SESSION['ereignis']);
		 }
	}
?>
	<p>Bitte f&uuml;llen Sie die nachfolgenden Eingabefelder aus, um sich anzumelden:</p>
	<form action="login_antwort.php" method="POST">
		<table>
			<tr>
				<td>Anwendername:</td>				
				<td><input type="text" name="anwender_name"></td>
			</tr>
			<tr>
				<td>Passwort:</td>
				<td><input type="password" name="passwort"></td>
			</tr>
		</table>
		<input type="submit" name="anmelden" value="Anmelden">
	</form>
	<a href="registrierung_anfrage.php">Registrieren</a><br>
	<a href="passwort_aendern_anfrage.php">Haben sie ihr Passwort vergessen?</a>
	<div/>
</body>
</html>