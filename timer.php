<?php 
	session_start();

	$fromTime = date('Y-m-d H:i:s');
	$toTime = $_SESSION["endTime"];

	$timeFirst = strtotime($fromTime);
	$timeSecound = strtotime($toTime);

	$difference = $timeSecound - $timeFirst;
	if($difference <= 0)
	{
		echo 'logout';
	}
	else
	{
		echo gmdate("H:i:s", $difference);
	}


?>