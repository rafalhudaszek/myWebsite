<?php
	session_start();
	if(isset($_SESSION['user']))
	{
		$wynik = $_POST["wynik"];
		$name = $_SESSION['user'];
		$flag = false;
		$position = 0;
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
				$result = $polaczenie->query("select user from zapamietywanie");
				while($row = $result->fetch_array())
				{
					$nicks[] = $row['user'];
				}
				$count = sizeof($nicks);

				for($i = 0; $i < sizeof($nicks); $i++)
				{
					if($_SESSION['user'] == $nicks[$i])
					{
						$flag = true;
						$position = $i;
					}

				}
				if($flag == true)
				{
					$result = $polaczenie->query("select wynik from zapamietywanie");
					if(!$result)throw new Exception($polaczenie->error);
					while($row = $result->fetch_array())
					{
						$wyniki[] = $row['wynik'];
					}

					for($i = 0; $i < sizeof($wyniki); $i++)
					{
						if($wynik > $wyniki[$position])
						{

							$sql = "delete from zapamietywanie where user ='$name'";
							$polaczenie->query($sql);
							$sql = "insert into zapamietywanie (id, user, wynik) values ('$i','$name', '$wynik')";
							$polaczenie->query($sql);
						}
					}
				}
				else
				{
					$sql = "insert into zapamietywanie (id, user, wynik) values ('$count' , '$name', '$wynik')";
					if($polaczenie->query($sql))
					{
						echo "jupi";
					}
					else
					{
						echo "Error: " . $sql . "<br>" . $polaczenie->error;
					}
				}

				$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color: red;"Bład serwera!></span>';
		}
	}
	header("Location: https://www.rafalhudaszek.pl/panel_gier/zapamietywanie/zapamietywanieScore.php");
?>