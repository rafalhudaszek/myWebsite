<?php
	session_start();

	if(array_key_exists('backButton', $_POST))
	{
		if(isset($_SESSION["user"]))
		{
			header("Location: witaj");
		}
		else
		{
			header("Location: ../../");
		}
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<title>FlapyShip</title>
	<meta name="description" content="JS Memory Game">
	<meta name="keywords" content="javascript, jQuery, game, memory">
	<meta name="author" content="rafalHudaszek">
	
	<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
	
	<link rel="stylesheet" href="panel_gier/flappyShip/styles.css">

	<link href="https://fonts.googleapis.com/css?family=Lobster&amp;subset=latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,700;1,400&display=swap" rel="stylesheet"> 
	<script type="text/javascript" src="panel_gier/flappyShip/jQuery.js"></script> 
	<?php
		if(isset($_SESSION["user"]))
		{
			echo '<script type="text/JavaScript">
				var logFlag = true;
			</script>'; 
		}
		else
		{
			echo '<script type="text/JavaScript">
				var logFlag = false;
			</script>'; 
		}
	?>
	<script>
		$(document).ready(function()
		{
			$('#stopButton').click(function()
			{
				//unset($_SESSION['e_nick']);
				$.ajax(
				{
					type: "POST",
					url: "flappyAdd.php",
					data:
					{
						wynik: $("#levelI").val(),
					}
				});
				window.location.replace('flappyShip.php');
			});
		});
	</script>
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->

</head>

<body>
	<div id="container">
		<div id="logo">
			<form method="post">
				<input type="submit" name="backButton" id="backButton" value="" style="text-align: left; float:left"/>
			</form>
			Flapy<spam style="font-weight: bold;">Ship</spam>
			<div style="clear:both;"></div>	
		</div>
		<div id="gameBox">
			<h2>Naciśnij Start by rozpocząć</h2>
			<br>
			Sterowanie:
			<br>
			z - strzał
			<br>
			strzalki - poruszanie sie
		</div>
		<div id="gameLegend">
			<div id="command">
				<div id="name">
				<?php
					if(isset($_SESSION['user']))
					{
						echo 'Witaj '.$_SESSION['user'].'!'; 
					}
					else
					{
						echo 'Witaj nieznajomy!';
					}
				?>
				</div>
			</div>
			</br>
			<table class="scroll">
			    <thead>
			        <tr>
			            <th>Nick</th>
			            <th>Wynik</th>
			        </tr>
			    </thead>
			    <tbody>
			        
		        	<?php
		        		if(isset($_SESSION["tableN"]))
		        		{
		        			for($i = 0; $i < count($_SESSION["tableN"]); $i++)
		        			{
		        				echo "<tr>
		        					<td>".$_SESSION["tableN"][$i]."</td>
		        					<td>".$_SESSION["tableW"][$i]."</td> 
		        				</tr>";
		        			}
		        		} 
		        	?>
		        	<?php
		        		if(isset($_SESSION["emptyU"]))
		        		{
		        			echo "<tr><td>Brak danych</td><td>Brak danych</td></tr>";
		        			
		        		} 
		        	?>
			        
	
			    </tbody>
			</table>
			</br>
			</br>
			<div id = "levelCounter">
				</br>
				Level:
				</br>
				<div id="level">					
						0
				</div>
				
			</div>
			<form action="https://www.rafalhudaszek.pl/panel_gier/flappyShip/flappyAdd.php" method="post">
				<?php
					if(isset($_SESSION['user']))
					{
						echo '<input id="stopButton" type="submit" value="Zapisz wynik"/>'; 
					}
					else
					{
						echo '<input id="stopButton" type="submit" value="Zapisz wynik" style="opacity: 0.3; cursor: auto;" disabled/>';
					}
				?>
				<input id="levelI" type="hidden" name="wynik"/>  
			</form>
			<input id="startButton" type="submit" value="Start">
		</div>
		<div style="clear:both;"></div>	


	</div>

	<footer>
		Wszystkie prawa zastrzeżone
	</footer>


	<script src="panel_gier/flappyShip/jQuery.js"></script>
	<script src="panel_gier/flappyShip/machine.js"></script>
	
	
</body>
</html>