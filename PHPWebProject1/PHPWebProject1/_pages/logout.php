<?php
session_start();
unset($_SESSION['kunde']);
$_SESSION['ereignis'] = 2;
header('Location: index.php');
?>