<?php
	var_dump( include_once '../_class/kunde_DBC.php');
	$id_anwender=$_GET['id_anwender'];
	
	if($_GET['typ'] == 'user')
	{
		anwender_DBC::adminsetadmin($id_anwender);
		header('Location: admintools.php?typ=onlineuser');
		header("Refresh:0; url=admintools.php?typ=onlineuser");
	}
	
	if($_GET['typ'] == 'admin')
	{
		anwender_DBC::adminsetuser($id_anwender);
		header('Location: admintools.php?typ=onlineuser');
	}
?>