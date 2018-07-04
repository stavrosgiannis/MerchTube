<?php
	//start der Session
	session_start();
	//lösche alle Werte in Session_Kunde
	unset($_SESSION['anwender']);
	header('Location: index.php');
?>