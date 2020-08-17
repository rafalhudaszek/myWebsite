var seconds = 12;
var doPlay = false;
var tmp = 0.0;
//var icons = [ "png/crab.png", "png/butterfly.png", "png/pearl.png", "png/alarm-clock.png", "png/bass-drum.png", "png/calendar.png", "png/glasses.png", "png/guitar.png", "png/headset.png", "png/iron-man.png", "png/microphone.png", "png/money-box.png", "png/phone.png", "png/wallet.png", "png/wi-fi.png"]
var icons = [ "panel_gier/zapamietywanie/png/ambulance.png", "panel_gier/zapamietywanie/png/bag.png", "panel_gier/zapamietywanie/png/bar.png", "panel_gier/zapamietywanie/png/galaxy.png", "panel_gier/zapamietywanie/png/gun.png", "panel_gier/zapamietywanie/png/heart-outline.png", "panel_gier/zapamietywanie/png/office-phone.png", "panel_gier/zapamietywanie/png/pill.png", "panel_gier/zapamietywanie/png/pokeball.png", "panel_gier/zapamietywanie/png/sci-fi.png", "panel_gier/zapamietywanie/png/scissors.png", "panel_gier/zapamietywanie/png/shield.png", "panel_gier/zapamietywanie/png/socks.png", "panel_gier/zapamietywanie/png/tape.png", "panel_gier/zapamietywanie/png/telescope.png"];
var level = 0;
var guess = false;
var toRem = [];
var startIcons = 1;
var playerChoicePos = [];
var playerChoiceIcon = [];
var oldRandPos = [];
var oldRandIcon = [];
var myAnonymous = null;
var startFlag = false;

function startGame()
{	
	if(startFlag == false)
	{
		startFlag = true;
		guess = false;
		zeroToTables();
		createBoard();
		$("#command").html("Zapiamietaj wyświetlone ikony")
		startTimer();
		toRem = revealIcons(level * 2 + startIcons);
		setTimeout(timeForPrepare, seconds * 1000 + 575);
	}
}

function timeForPrepare()
{
	$("#command").html("Przygotuj sie");
	setTimeout(choiceGame, 2 * 1000 );
}

function choiceGame()
{
	guess = true;
	addingListeneres();
	$("#command").html("Wybierz ikony które zapamietałeś");
	revealIcons(15);
	startTimer();
	setTimeout(isCorrect, seconds * 1000 + seconds * 110);
}

function createBoard()
{
	$("#game").html('<div class="icon" id="i0"></div><div class="icon" id="i1"></div><div class="icon" id="i2"></div><div class="icon" id="i3"></div><div class="icon" id="i4"></div><div class="icon" id="i5"></div><div class="icon" id="i6"></div><div class="icon" id="i7"></div><div class="icon" id="i8"></div><div class="icon" id="i9"></div><div class="icon" id="i10"></div><div class="icon" id="i11"></div><div class="icon" id="i12"></div><div class="icon" id="i13"></div><div class="icon" id="i14"></div>');
}

function addingListeneres()
{
	var i0 = document.getElementById("i0");
	var i1 = document.getElementById("i1");
	var i2 = document.getElementById("i2");
	var i3 = document.getElementById("i3");
	var i4 = document.getElementById("i4");

	var i5 = document.getElementById("i5");
	var i6 = document.getElementById("i6");
	var i7 = document.getElementById("i7");
	var i8 = document.getElementById("i8");
	var i9 = document.getElementById("i9");

	var i10 = document.getElementById("i10");
	var i11 = document.getElementById("i11");
	var i12 = document.getElementById("i12");
	var i13 = document.getElementById("i13");
	var i14 = document.getElementById("i14");
	i0.addEventListener("click", function() {choices(0)});
	i1.addEventListener("click", function() {choices(1)});
	i2.addEventListener("click", function() {choices(2)});
	i3.addEventListener("click", function() {choices(3)});
	i4.addEventListener("click", function() {choices(4)});

	i5.addEventListener("click", function() {choices(5)});
	i6.addEventListener("click", function() {choices(6)});
	i7.addEventListener("click", function() {choices(7)});
	i8.addEventListener("click", function() {choices(8)});
	i9.addEventListener("click", function() {choices(9)});

	i10.addEventListener("click", function() {choices(10)});
	i11.addEventListener("click", function() {choices(11)});
	i12.addEventListener("click", function() {choices(12)});
	i13.addEventListener("click", function() {choices(13)});
	i14.addEventListener("click", function() {choices(14)});
}
/*
function removeListeners()
{
	i0.removeEventListener("click", myAnonymous);
}*/

function zeroToTables()
{
	guess = false;
	toRem = [];
	playerChoicePos = [];
	playerChoiceIcon = [];
	oldRandPos = [];
	oldRandIcon = [];
}

function choices(id)
{
	if($("#i" + id).css("opacity") == "1")
	{
		playerChoicePos.push(id);
		$("#i" + id).css("border", "5px solid #E9B64a");
		$("#i" + id).css("filter", "brightness(100%)");
		$("#i" + id).css("opacity", "0.99");
	}
}
function isCorrect()
{
	if(playerChoicePos.length == (level * 2 + startIcons))
	{
		var correct = 0;
		for(i = 0; i < playerChoicePos.length; i++)
		{
			for(j = 0; j < oldRandPos.length; j++ )
			{
				if (playerChoicePos[i] == oldRandPos[j])
				{
					playerChoiceIcon.push(oldRandIcon[j]);
				}
			}
		}
		for(i = 0; i < toRem.length; i++)//może się wypierdalać, przekroczenie rozmiaru
		{
			for(j = 0; j < playerChoiceIcon.length; j++)
			{
				if(toRem[i] == playerChoiceIcon[j])
				{
					correct += 1;
				}
			}
		}
		if(correct == level * 2 + startIcons)
		{
			winlevel();
		}
		else
		{
			defeat();
		}
	}
	else
	{
		defeat();
	}
}

function winlevel()
{
	startFlag = false;
	level += 1;
	seconds += 2;
	$("#command").html("");
	$("#game").html('Gratulacje, ukończyłeś poziom</br> Nacisnij przycisk startu by przejść do kolejnego poziomu <br> "Zapisz wynik" tylko jeśli chcesz zakończyć gre');
	$("#levelCounter").html('Level: ' + level);
	$("#levelI").val(level);
}

function defeat()
{
	startFlag = false;
	level = 0;
	seconds = 7;
	$("#command").html("");
	$("#game").html('Przykro mi, nie udało się</br> Nie zapomnij zapisać swojego wyniku');
	$("#levelCounter").html('Level:' + level + '</br>');
}


function revealIcons(nr)
{
	oldRandPos = [];
	oldRandIcon = [];
	var j = 0;
	var flag = false;
	while(j <= nr -1)
	{
		flag = false;
		//position
		var randomPos = Math.floor(Math.random() * 15);
		for(i=0; i < oldRandPos.length + 1; i++)
		{
			if(randomPos == oldRandPos[i])
			{
				flag = true;
			}
		}
		//ikona
		var randomIcon = Math.floor(Math.random() * 15);
		for(i=0; i < oldRandIcon.length; i++)
		{
			if(randomIcon == oldRandIcon[i])
			{
				flag = true;
			}
		}
		
		if(flag == false)
		{
			j += 1;
			oldRandPos.push(randomPos);
			oldRandIcon.push(randomIcon);
			var obraz = 'url(' + icons[randomIcon] + ')';
			if(guess == true)
			{
				$("#i"+ randomPos).removeClass("icon");
				$("#i"+ randomPos).addClass("iconA");				
			}
			$('#i'+ randomPos).css('background-image', obraz);
		}	
	}
	return oldRandIcon;
}

function otherRandom(old)
{
	var tmp = old;
	while(tmp == old)
	{
		tmp = Math.floor(Math.random() * 15);
	}
	return tmp;
}

function startTimer()
{
	if(doPlay == false)
	{
		var loader = document.getElementById('loader')
		  , α = 0
		  , π = Math.PI
		  , t = (seconds/360 * 1000);
		(function draw() {
		  α++;
		  if(α == 360)
		  {
		  	doPlay = false;
		  }
		  else
		  {
		  	doPlay = true;
		  }
		  var r = ( α * π / 180 )
		    , x = Math.sin( r ) * 125
		    , y = Math.cos( r ) * - 125
		    , mid = ( α > 180 ) ? 1 : 0
		    , anim = 'M 0 0 v -125 A 125 125 1 ' 
		           + mid + ' 1 ' 
		           +  x  + ' ' 
		           +  y  + ' z';

		  loader.setAttribute( 'd', anim );
		  if(doPlay){
		    setTimeout(draw, t); // Redraw
		  }
		})();
	}
}

var startButton = document.getElementById("startButton");

startButton.addEventListener("click", function() {startGame();});
