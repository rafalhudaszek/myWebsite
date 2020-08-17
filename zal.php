<?php

	session_start();

	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connecting.php";

	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

	if($polaczenie->connect_errno != 0)
	{
		echo "Error".$polaczenie->connect_errno." Opis:" . $polaczenie->connect_error;
	}
	else
	{
		$login = $_POST["login"];
		$haslo = $_POST["haslo"];

		$login = htmlentities($login, ENT_QUOTES, "UTF-8");	


		if($rezultat = $polaczenie->query(
			sprintf("select * from uzytkownicy where user = '%s'"
				,mysqli_real_escape_string($polaczenie, $login))))
		{
			$ilosc_wierszy = $rezultat->num_rows;

			if($ilosc_wierszy > 0)
			{
				$wiersz = $rezultat->fetch_assoc();
				if(password_verify($haslo, $wiersz["pass"]))
				{
					$_SESSION["zalogowany"] = true;

					
					$_SESSION["id"] = $wiersz["id"]; 
					$_SESSION["user"] = $wiersz["user"];
					$_SESSION["loginDate"] = date("Y-m-d H:i:s");
					$_SESSION["duration"] =  5;
					$_SESSION["endTime"] = date('Y-m-d H:i:s', strtotime('+'.$_SESSION["duration"].'minutes', strtotime($_SESSION["loginDate"])));

					unset($_SESSION["blad"]);
					$rezultat->free_result(); //zwalnianie pobranych danych
					header("Location: witaj");
				}
				else
				{
					$_SESSION["blad"] = 'Niepoprawne haslo';
					header("Location: logowanie");
				}
			}
			else
			{
				$_SESSION["blad"] = 'Niepoprawny login';
				header("Location: logowanie");
			}
		}

		$polaczenie->close();
	}


?>