var password = "PIS to złodzieje";
password=password.toUpperCase();

var solutionStage = "";
var failsCount = 0;
var passLength = password.length;
window.onload = start;//dziwne ze bez () ale to alias

function showPassword(pass)
{
	document.getElementById("board").innerHTML = pass;
}

function hiddenGenerate()
{
	tmpPass = "";
	for(var i = 0; i < passLength; i++)
	{
		if(password.charAt(i) == " ") tmpPass += " ";
		else tmpPass += "-";
	}
	return tmpPass;
}



function showAlphabet()
{
	var htmlCommand = "";
	var letter = ""
	var letterId = ""
	for(i = 0; i < 35; i++)
	{
		/*letter = String.fromCharCode(65 + i);*/
		letterId = "lit" + i;
		htmlCommand += '<div class="letter" onclick="clickCheck('+ i +')" id="' + letterId + '" >' + litery[i] + '</div>';
		if((i+1) % 7 ==0) htmlCommand += '<div style="clear: both;"></div>';
	}
	document.getElementById("alphabet").innerHTML = htmlCommand;
}

function clickCheck(id)
{
	var flag = false;
	for(i = 0; i < passLength; i++)
	{
		if (litery[id] == password.charAt(i))
		{
			solutionStage = uncover(solutionStage, i, id);
			flag = true;
		}
	}
	if(flag == true)
	{
		document.getElementById("lit" + id).style.color = "#0afa4a";
		document.getElementById("lit" + id).style.border = "3px solid #0afa4a";
		document.getElementById("lit" + id).style.cursor = "default";
	}
	else
	{
		failsCount += 1;
		document.getElementById("lit" + id).style.color = "red";
		document.getElementById("lit" + id).style.border = "3px solid red";
		document.getElementById("lit" + id).style.cursor = "default";
		document.getElementById("lit" + id).setAttribute("onclick",";");
		document.getElementById("gallows").innerHTML = '<img src="img/s' + failsCount + '.jpg" alt=""/>'
	}
	if(solutionStage == password)
		document.getElementById("alphabet").innerHTML = "Gratulacje. Zgadłeś hasło: " + password + '</br></br> <span class="reset" onclick="location.reload()">JESZCZE RAZ?</span>';
	
	if(failsCount >= 9)
		document.getElementById("alphabet").innerHTML = "Porażka, prawidłowe hasło: " + password + '</br></br> <span class="reset" onclick="location.reload()">JESZCZE RAZ?</span>';

	showPassword(solutionStage);
}

function uncover(passTmp, position, id)
{
	passTmp = replaceAt(passTmp, position, litery[id]);
	return passTmp;
}

function replaceAt(string, index, replace) {
  return string.substring(0, index) + replace + string.substring(index + 1);
}

function start()
{
	solutionStage = hiddenGenerate();
	showPassword(solutionStage);
	showAlphabet();
}

var litery = new Array(35);

litery[0] = "A";
litery[1] = "Ą";
litery[2] = "B";
litery[3] = "C";
litery[4] = "Ć";
litery[5] = "D";
litery[6] = "E";
litery[7] = "Ę";
litery[8] = "F";
litery[9] = "G";
litery[10] = "H";
litery[11] = "I";
litery[12] = "J";
litery[13] = "K";
litery[14] = "L";
litery[15] = "Ł";
litery[16] = "M";
litery[17] = "N";
litery[18] = "Ń";
litery[19] = "O";
litery[20] = "Ó";
litery[21] = "P";
litery[22] = "Q";
litery[23] = "R";
litery[24] = "S";
litery[25] = "Ś";
litery[26] = "T";
litery[27] = "U";
litery[28] = "V";
litery[29] = "W";
litery[30] = "X";
litery[31] = "Y";
litery[32] = "Z";
litery[33] = "Ż";
litery[34] = "Ź";