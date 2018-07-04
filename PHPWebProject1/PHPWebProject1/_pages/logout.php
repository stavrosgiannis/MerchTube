<?php
<<<<<<< HEAD
session_start();
unset($_SESSION['kunde']);
$_SESSION['ereignis'] = 2;
header('Location: index.php');
=======
	//start der Session
	session_start();
	//lösche alle Werte in Session_Kunde
	unset($_SESSION['anwender']);
	header('Location: index.php');
>>>>>>> origin/Marius
?>