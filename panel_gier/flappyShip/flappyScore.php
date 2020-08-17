<?php
	session_start();
	unset($_SESSION["tableN"]);
	unset($_SESSION["tableW"]);	
	function bubbleSort(&$wynik, &$nick) 
	{ 
	    $n = sizeof($wynik); 
	    for($i = 0; $i < $n; $i++)  
	    { 
	        for ($j = 0; $j < $n - $i - 1; $j++)  
	        { 

	            if ($wynik[$j] < $wynik[$j+1]) 
	            { 
	                $t = $wynik[$j]; 
	                $wynik[$j] = $wynik[$j+1]; 
	                $wynik[$j+1] = $t; 

	                $g = $nick[$j]; 
	                $nick[$j] = $nick[$j+1]; 
	                $nick[$j+1] = $g; 
	            } 
	        } 
	    } 
	} 
	require_once "../../connecting.php";
	mysqli_report(MYSQLI_REPORT_STRICT); //zmiana raportowania, bo uzywamy try catch
	try
	{
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		if($polaczenie->connect_errno != 0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			$result = $polaczenie->query("select user from flappyShip");
				while($row = $result->fetch_array())
				{
					$nicks[] = $row['user'];
				}
				$count = sizeof($nicks);

			$result = $polaczenie->query("select wynik from flappyShip");
			if(!$result)throw new Exception($polaczenie->error);
			while($row = $result->fetch_array())
			{
				$wyniki[] = $row['wynik'];
			}

			if(sizeof($wyniki) == 0)
			{
				$_SESSION["emptyU"] = "brak danych";
				$_SESSION["emptyW"] = "brak danych";
			}
			else
			{	
				bubbleSort($wyniki, $nicks);
				unset($_SESSION["emptyU"]);
				unset($_SESSION["emptyW"]);
				$_SESSION["tableN"] = $nicks;
				$_SESSION["tableW"] = $wyniki;
			}


			$polaczenie->close();
		}
	}
	catch(Exception $e)
	{
		echo '<span style="color: red;"Bład serwera!></span>';
	}
	header("Location: ../../flappy-game");
?>