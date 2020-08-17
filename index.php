<?php
	session_start();

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: witaj');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rafał Hudaszek</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<link rel="stylesheet" href="css/bootstrap.min.css">
   	<link rel="stylesheet" href="css/sty.css">
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet"> 
	<script type="text/javascript" src="jQuery.js"></script>
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
</head>
<body>
<main>
	<section class="front">
	    <div class="container-fluid">
	        <div class="bg"></div>
	        <div class="gb"></div>
        	<div class="row">
        		<div class="col-7 offset-5 col-xl-3 offset-xl-8">
        			<div id="name">Rafał Hudaszek</div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-11 offset-1 col-xl-6 offset-xl-5">
        			<img src="img/portfolio.png" id="portfolio" alt="portfolio">
        		</div>
        	</div>
	    </div>
	</section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-3">
            	<img src="img/rafBlackSmall.jpg" id="face" alt="rafal photo">
            </div>
            <div class="col-12 col-sm-6 col-xl-3 offset-xl-1">
				<div class="text">
					<span style="font-weight: 700;">Witam.</span><br>
					Jestem Rafał, libertarian oraz student państwowej
					uczelni AGH.
					  Z aspiracji, specjalista od tworzenia oraz działania aplikacji, z zainteresowań fizyk teoretyk.
				</div>
			</div>

			<div class="col-12 col-sm-6 col-xl-3 offset-xl-1">
				<div class="text">
					<spam style ="font-weight: 700;">Edukacja</spam><br>
					I LO im.<br> 
					Tadeusza Kościuszki w Myślenicach <br>
					<spam style="font-weight: 300;">Profil matematyczno - fizyczny <br>
					( 2014 - 2017 ) </spam>
					<br>
					Akademia Górniczo Hutnicza w Krakowie <br>
					<spam style="font-weight: 300;">Kierunek Informatyka Stosowana 
					<br>( 2017 - aktualnie )</spam>
				</div>
            </div>
        </div>
        <div class="row">
        	<div class="offset-4 col-8 col-xl-4 offset-xl-7">
        		<img src="img/omnie.png" id="omnie" alt="O mnie">
        	</div>
        </div>
        <img src="img/Union 6.png" id="union6" alt="line 6">
        <img src="img/Union 4.png" id="union4" alt="line 4">
    </div>


    <div class="container-fluid">
    	<div class="row">
    		<div class="offset-xl-1 col-xl-3 col-sm-6 col-12">
    			<div class="text">
					<spam style ="font-weight: 700;">Języki w których mam <br>doświadczenie:</spam><br>-Fortran<br>-C<br>-C++14<br>-CSS <br> -HTML <br> <br> 
					<spam style ="font-weight: 700;">Języki w których się rozwijam: </spam><br>-Java 8 <br>-Python 3 <br>-SQL<br>-PHP <br><br>
					<spam style ="font-weight: 700;">Bibloteki:</spam> <br>-jQuery <br>-bootstrap <br>-PDO <br><br><spam style ="font-weight: 700;">FrameWork:</spam> <br>-Spring <br>-Symfony
				</div>
    		</div>
    		<div class="offset-xl-1 col-xl-3 col-sm-6 col-12">
    			<div class="text">
					Front-end, back-end, testing, security, data science. Jestem głodny wiedzy i podejmę się każdej pracy na stanowisku juniorskim.<br><br> Szybko się uczę, jestem zdeterminowany i gotowy do działania. Jako osoba ekstrawertyczna, idealnie pasuje do pracy z zespołem.
				</div>
    		</div>
    	</div>

    	<div class="row">
    		<div class="col-12">
    			<div id="mobile">
					<div class="text">
						<span style="font-weight: 700">Hej!</span><br>
						Jeśli chcesz zagrać w moje gry i zapisać się w tabeli wyników, zapraszam Cię na wersje dekstopową mojej strony!
						<br><br>
						Zapraszam Cię także na mojego githuba gdzie możesz przejrzęć część z moich poprzednich projektów. <br>
						<a href="https://github.com/rafalhudaszek">
							<span style="font-weight: 700;">
								github.com/rafalhudaszek
							</span>
						</a>
					</div>
    			</div>
    		</div>
    	</div>

    	<div class="row">
    		<div class="col-11 offset-1 col-xl-6 offset-xl-5">
        		<img src="img/technologie.png" id="technologie" alt="technologie">
        	</div>
    	</div>
    	<img src="img/Union 8.png" id="union8" alt="line 8">
    	<img src="img/Union 7.png" id="union7" alt="line 7">

    </div>

    <div class="desktop">
	    <div class="container-fluid">
	    	<img src="img/Union 8.png" id="union8-2" alt="line 8-2">
	    	<div class="row">
	    		<div class="offset-xl-1 col-xl-2">
	    			<img src="img/Hej.png" id="hej" alt="hej">
	    		</div>
	    	</div>
	    	<div class="row">
	    		<div class="offset-xl-1 col-xl-4">
	    			<div class="text" style="margin-top: 5vh; margin-bottom: 5vh; font-size: 24px">
	    				<span style="font-weight: 700;">
	    					Zarejestruj się lub zaloguj, żeby móc <br>w pełni korzystać z moich gier!
	    				</span>
	    			</div>
	    			<div class="text" style="margin-top: 2vh;">
	    				Dzięki rejestracji będziesz mógł/mogła widzieć swoje wyniki na tablicy wyników oraz będziesz mógł/mogła je poprawiać.<br><br>Rejestracja nie jest jednak wymagana.<br> Baw się dobrze!
	    			</div>
	    		</div>
	    		<div class="offset-xl-2 col-xl-4">
	    			<a href="logowanie">
						<input type="submit" class="button" name="Logowanie" value="Logowanie" style="margin-top: 16vh"/>
					</a>
					<a href="rejestracja">
						<input  type="submit"  name="Rejestracja" value="Rejestracja" style="margin-top: 5vh;" />
					</a>
	    		</div>
	    	</div>
	    </div>

	    <div class="container-fluid" >
	    	<div class="row">
	    		<div class="offset-xl-1 col-xl-3">
	    			<div class="game">
						<a href="panel_gier/zapamietywanie/zapamietywanieScore.php">
							<img src="img/memory.png" class="gameImg" alt="game memory"/>		
						</a>
					</div>
				</div>
				<div class="col-xl-3">
					<div class="text" style="margin-top:7.1vh;">
						Zapamiętuj ikony na czas, każdy poziom jest trudniejszy!
					</div>
					<a href="panel_gier/zapamietywanie/zapamietywanieScore.php">
						<input  type="submit"  name="memory" value="Zagraj!" style="margin-top: 4vh; margin-right:12vw; width: 265px;"/>	
					</a>
				</div>
	    	</div>

	    	<div class="row">
	    		<div class="offset-xl-4 col-xl-3">
	    			<div class="game">
						<a href="panel_gier/flappyShip/flappyScore.php">		
							<img src="img/flappyShip.png" class="gameImg" alt="game photo"/>
						</a>
					</div>
				</div>
				<div class="col-xl-3">
					<div class="text" style="margin-top:7.1vh;">
						Lataj samolotem i przebijaj się przez kolejne mury!
					</div>
					<a href="panel_gier/flappyShip/flappyScore.php">
						<input  type="submit"  name="flappyShip" value="Zagraj!" style="margin-top: 4vh; margin-right:12vw; width: 265px;"/>	
					</a>
				</div>
	    	</div>

	    	<div class="row">
	    		<div class="offset-xl-1 col-xl-3">
	    			<div class="game">
						<a href="https://github.com/rafalhudaszek">
							<div id="git">
								<img src="img/gitL.png" style="margin-top: 30px;" >
							</div>	
						</a>
					</div>
				</div>
				<div class="col-xl-3">
					<div class="text" style="margin-top:7.1vh;">
						Jesteś ciekaw moich prac? Na githubie umieściłem kod części z moich wcześniejszych projektów
					</div>
					<a href="https://github.com/rafalhudaszek">
						<input  type="submit"  name="github" value="Wejdź!" style="margin-top: 4vh; margin-right:12vw; width: 265px;"/>	
					</a>
				</div>
	    	</div>

	    	<div class="row">
	    		<div class="offset-xl-6 col-xl-5">
	    			<img src="img/projekty.png" id="projekty" alt="projekty">
	    		</div>
	    	</div>
	    	<img src="img/Union 9.png" id="union9" alt="line 9">
	    </div>
	</div>

    <footer>
    	Kontakt: rafalhudaszek98@gmail.com Projekt strony: UI/UX designer Daria Zarębska.
    </footer>
    
</main>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js"></script>
	<script src="jQuery.js"></script>
</body>
</html>
