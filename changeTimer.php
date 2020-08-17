<?php
	session_start();
	$_SESSION["loginDate"] = date("Y-m-d H:i:s");
	$_SESSION["duration"] =  5;
	$_SESSION["endTime"] = date('Y-m-d H:i:s', strtotime('+'.$_SESSION["duration"].'minutes', strtotime($_SESSION["loginDate"])));
	header("clear.php");

?>