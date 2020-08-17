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
	<title>Zapamietywanie</title>
	<meta name="description" content="JS Memory Game">
	<meta name="keywords" content="javascript, jQuery, game, memory">
	<meta name="author" content="rafalHudaszek">
	
	<meta http-equiv="X-Ua-Compatible" content="IE=edge,chrome=1">
	
	<!--
	<link rel="stylesheet" href="/domains/rafalhudaszek.pl/public_html/panel_gier/zapamietywanie/main.css">
	-->
	<link rel="stylesheet" href="panel_gier/zapamietywanie/style.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster&amp;subset=latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
	<script type="text/javascript" src="panel_gier/zapamietywanie/jQuery.js"></script>
	<script type="text/javascript">
		var xmlhttp = new XMLHttpRequest();
		onmousedown = function()
		{
			xmlhttp.open("GET", "../../changeTimer.php", false);
			xmlhttp.send(null);
		}

		onkeydown = function()
		{
			xmlhttp.open("GET", "../../changeTimer.php", false);
			xmlhttp.send(null);
		}
	</script>
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
					url: "zapamiętywanieAdd.php",
					data:
					{
						wynik: $("#levelI").val(),
					}
				});
			});
			if(logFlag == true)
			{
				setInterval(function()
				{
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.open("GET", "../../timer.php", false);
					xmlhttp.send(null);
					if(xmlhttp.responseText == "logout")
					{
						window.location.href = '../../clear.php';
					}
					document.getElementById("time").innerHTML = xmlhttp.responseText;
				}, 1000);
			}
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
			Gra w zapamiętywanie
			<?php
				if(isset($_SESSION["user"]))
				{
					echo '<div id="pretime">Czas do wylogowania:</div>';
				}
			?>
			<div id="time"></div>
			<div style="clear:both;"></div>	
		</div>

		<div id="gameBox">
			<div id="command">Naciśnij start by rozpocząć</div>
			<div id="game">
			</div>
		</div>

		<div id="gameLegend">
			<div class="timer">
			  <svg class="rotate" viewbox="0 0 250 250">
			    <path id="loader" transform="translate(125, 125)"/>
			  </svg>
			  <div class="dots">
			    <span class="time deg0"></span>
			    <span class="time deg45"></span>
			    <span class="time deg90"></span>
			    <span class="time deg135"></span>
			  </div>
			</div>
			</br>
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
			<div id = "levelCounter">
				Level:
				
				0
			</div>
			<form action="https://www.rafalhudaszek.pl/panel_gier/zapamietywanie/zapamietywanieAdd.php" method="post">
				<?php
					if(isset($_SESSION['user']))
					{
						echo '<input id="stopButton" type="submit" value="Zapisz wynik">'; 
					}
					else
					{
						echo '<input id="stopButton" type="submit" value="Zapisz wynik" style="opacity: 0.3; cursor: auto;" disabled>';
					}
				?>
				<input id="levelI" type="hidden" name="wynik"/> 
			</form>
			</br>
			<input id="startButton" type="submit" value="Start"></input>
		</div>
		<div style="clear:both;"></div>	
	</div>
	<footer>
		Wszystkie prawa zastrzeżone
	</footer>


	<script src="panel_gier/zapamietywanie/jQuery.js"></script>
	<script src="panel_gier/zapamietywanie/memory.js"></script>
	
</body>
</html>