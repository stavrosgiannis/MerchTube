<?php
	/* In den Eingaben sollen SQL- und HTML-Anteile maskiert werden */
	function sichere_eingaben($db_link, $eingabe)
	{ 
		return mysqli_real_escape_string($db_link,htmlentities($eingabe,ENT_QUOTES, "UTF-8"));
	}
?>