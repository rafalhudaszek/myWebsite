<?php
	session_start();


	if(isset($_POST["email"]))
	{
		$walidacja = true;

		//nickname
		$nick = $_POST["nick"];

		if(ctype_alnum($nick) == false)
		{
			$walidacja = false;
			$_SESSION["e_nick"] = "Nick moze składac sie tylko z liter i cyfr";
		}

		if(( strlen($nick)<3) || (strlen($nick) > 8))
		{
			$walidacja = false;
			$_SESSION["e_nick"] = "Nick jest za długi bądź za krótki";
		}

		//email

		$email = $_POST["email"];
		$emailA = filter_var($email, FILTER_SANITIZE_EMAIL);
		if((filter_var($emailA, FILTER_VALIDATE_EMAIL)==false) || ($emailA != $email))
		{
			$walidacja = false;
			$_SESSION["e_email"] = "Podaj poprawny adres e-mail"; 
		}

		//haslo

		$haslo1 = $_POST["haslo1"];
		$haslo2 = $_POST["haslo2"];

		if((strlen($haslo1) < 8) || (strlen($haslo1) > 20))
		{
			$walidacja = false;
			$_SESSION["e_haslo"] = "haslo musi miec od 8 do 20 znaków"; //e_haslo???	
		}


		if($haslo1 != $haslo2)
		{
			$walidacja = false;
			$_SEESION["e_haslo"] = "hasla musza być takie same"; 
		}

		

		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		require_once "connecting.php";
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
				$rezultat = $polaczenie->query("select id from uzytkownicy where email = '$email'");
				if(!$rezultat)throw new Exception($polaczenie->error);
				if($rezultat->num_rows > 0)
				{
					$walidacja = false;
					$_SESSION["e_email"] = "Taki email juz istnieje"; 
				}

				$rezultat = $polaczenie->query("select id from uzytkownicy where user = '$nick'");
				if(!$rezultat)throw new Exception($polaczenie->error);
				if($rezultat->num_rows > 0)
				{
					$walidacja = false;
					$_SESSION["e_nick"] = "Taki nick juz istnieje"; 
				}

				if($walidacja == true)
				{
					if($polaczenie->query("insert into uzytkownicy values(NULL,'$nick', '$haslo_hash', '$email', 0, 0, 0)"))
					{
						$_SESSION["udanarejestracja"] = true;
						$_SESSION["user"] = $nick;
						$_SESSION["loginDate"] = date("Y-m-d H:i:s");
						$_SESSION["duration"] =  5;
						$_SESSION["endTime"] = date('Y-m-d H:i:s', strtotime('+'.$_SESSION["duration"].'minutes', strtotime($_SESSION["loginDate"])));
						header("Location: witaj");
					}
					unset($_SESSION['e_nick']);
					unset($_SESSION['e_email']);
					unset($_SESSION['e_haslo']);
				}
				else
				{
					$_SESSION["nieUdanaRejestracja"] = false;
					header("Location: rejestracja");
				}
				$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color: red;"Bład serwera!></span>';
		}

	}

?>