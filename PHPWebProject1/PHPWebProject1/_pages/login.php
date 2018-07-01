<?php
include '../_module/top.php';

// ---------------------------------------------Ende Top-------------------------------------------------------------

if (isset($_SESSION['kunde']) && ($_SESSION['kunde'] != null))
{
    // Redirect auf Hauptseite, da der Kunde bereits eingeloggt ist -------
    header('Location: index.php');
    exit;
}

?>

<!-- Page content -->
  <div class="maincontent-area">
    <div class="container">
		<div id="login">
			<!--<img id="profil_bild" src="../img2/kundenavatar.jpg" alt="Error"></img>-->
			<?php
            if (isset($_SESSION["login_error"]))
            {
                if ($_SESSION["login_error"] == 2)
                {
                    echo "<p><strong>Falsches Passwort oder Username!</strong></p><br>";
                    unset ($_SESSION["login_error"]);
                }
            }

            if (isset($_SESSION['register']) && $_SESSION['register'] == 1)
            {

                echo '<p><strong>Du hast dich erfolgreich registriert!</strong></p>';
                unset($_SESSION["register"]);

            }else if(isset($_SESSION['register']) && $_SESSION['register'] == 2){
                echo '<p>Es gab ein Fehler bei der Registrierung!</p>';
                unset($_SESSION["register"]);
            }
            ?>
			<h3>Anmelden</h3>
			<p">F&uuml;r alle Eink&auml;ufe oder Kundenprofileingaben m&uuml;ssen Sie sich
			 zun&auml;chst hier anmelden.</p>

			<form action="login_antwort.php" method="POST">
				Kundenname oder E-Mail:<br>
				<input type="text" name="kundenname" class="formkategorie">
				<br>

				Passwort:<br>
				<input type="password" name="passwort" class="formkategorie">
				<br>
				<br>
				<button type="submit" id="login_button">Anmelden</button>
			</form>

			<br>
			<br>
			<p style="font-size:75%;">Sie haben Ihr <a href="passwort_renew.html" style="text-decoration:underline">Passwort vergessen</a>?</p>
			<p style="font-size:75%;">Sie sind noch nicht <a href="register.php" style="text-decoration:underline">registriert</a>?</p>
			</div>
    </div>
  </div>

    <?php
	// --------------------------------------------Bottom------------------------------------------------------------->

	include '../module/loadscripts.php';
    ?>

<?php
// --------------------------------------------Bottom------------------------------------------------------------->

include '../_module/bottom.php';
?>