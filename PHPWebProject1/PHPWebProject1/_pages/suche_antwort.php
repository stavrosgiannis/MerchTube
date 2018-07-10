<?php
	//---------------------------------------------Top Modul wird includiert-------------------------------------------------------------
	include_once '../_class/kunde_DBC.php';
	include_once '../_module/top.php';
	if(ISSET($_SESSION['sucheingabe']) && ISSET($_POST['sucheingabe'])){
		$sucheingabe = $_POST['sucheingabe'];
		$_SESSION['sucheingabe'] = $sucheingabe;	
	}
	if(ISSET($_SESSION['sucheingabe'])){
		$sucheingabe = $_SESSION['sucheingabe'];
	}
	elseif(ISSET($_POST['sucheingabe'])){
		$sucheingabe = $_POST['sucheingabe'];
		$_SESSION['sucheingabe'] = $sucheingabe;	
	}
	
	else{
		echo"ERROR";
	}
	Anwender_DBC::suche($sucheingabe);
?>