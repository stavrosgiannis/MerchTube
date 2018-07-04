<?php
	//---------------------------------------------Top Modul wird includiert-------------------------------------------------------------
	include '../_module/top.php';
	include '../_class/kunde_DBC.php';
	$sucheingabe = $_POST['sucheingabe'];	
	Anwender_DBC::suche($sucheingabe);
?>