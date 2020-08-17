var canvas;
var c ;
var startButton = document.getElementById("startButton");
startButton.addEventListener("click", start);
//var stopButton = document.getElementById("stopButton");
//stopButton.addEventListener("click", stopAnimation);
var buttonFlag = false;
var stopFlag = false;
//startButton.removeEventListener("click", start(), false);
//startButton.removeEventListener("click", start(), true);
var time = 0;
var speed = 2;
var width = 960;
var height = 600;
var gameFailure = false;

//podloga i sufit
var floor = [];
var roof = [];
var ilosc_kafelek = 15;
var rec_lenght = 70;
var wypelnienie = 20;
//960 600
//barriery
var ilosc_barrier = 20;
var barriers = []
var interBarriers = 8;
var flats = 60;
var brickAmount = [];
var flatsBrick = [];
var flatsBrickSwaped = [];
var missBarrierIter = 0;

var bulletToSplice = null;
var brickToSpliceW = null;
var brickToSpliceI = null;
var brickToSpliceJ = null;
var brickToSpliceK = null;

var kurwa = [];

//sterowanie samolotem
var up = false;
var down = false;
var left = false;
var right = false;
var tmp = [];
var map = {}; 
var ship;
var shipW = 30;
var shipH = 30;
var shipSpeed = 3;
//limit klatek
var lastTime = 0;
var FRAME_PERIOD = 20;

//brick size
var brickSizeX = 14;
var brickSizeY = 7;
var idBrick = 0;

//bullets
var bulletSize = 6;
var bullets = [];

class Rectangle
{
	constructor() {}
	set(pos_w, pos_h, w, h, id)
	{
		this.pos_w = pos_w;
		this.pos_h = pos_h;
		this.w = w;
		this.h = h;
		this.id = id;
	}
	move()
	{
		c.strokeStyle = "#FFFFFF";
		c.lineWidth = 5;
		c.strokeRect(this.pos_w, this.pos_h, this.w, this.h);
		this.pos_w -= speed;
	}
	toStart()
	{
		if(this.pos_w <= 0 - rec_lenght)
		{
			this.pos_w = 980; 
		}
	}

	getterW()
	{
		return this.pos_w;
	}

	getterH()
	{
		return this.pos_h;
	}
}


class Barrier
{

	set(pos_w, pos_h, id)
	{
		this.pos_w = pos_w;
		this.pos_h = pos_h;
		this.id = id;
	}

	getter()
	{
		return this.pos_w;
	}

	move()
	{
		c.fillStyle = "#FFF";
		c.fillRect(this.pos_w  , rec_lenght, rec_lenght, wypelnienie);
		c.fillRect(this.pos_w  , height - rec_lenght - wypelnienie, rec_lenght, wypelnienie);
		this.pos_w -= speed;
	}

	toStart()
	{
		if(this.pos_w <= 0 - rec_lenght)
		{
			this.pos_w = this.pos_w + 70 * interBarriers * ilosc_barrier; 
		}
	}
	getterW()
	{
		return this.pos_w;
	}
}

class Brick
{
	constructor( pos_w, pos_h, id)
	{
		this.pos_w = pos_w;
		this.pos_h = pos_h;
		this.id = id;
	}

	move()
	{/*
		c.fillStyle = "#FFF";
		c.fillRect(this.pos_w  , this.pos_h, brickSizeX, brickSizeY);*/
		c.strokeStyle = "#FFF";
		c.lineWidth = 2;
		c.strokeRect(this.pos_w  , this.pos_h, brickSizeX, brickSizeY);
		this.pos_w -= speed;
	}

	getterW()
	{
		return this.pos_w;
	}

	getterH()
	{
		return this.pos_h;
	}
}


class Ship
{
	constructor(pos_w, pos_h, w, h)
	{
		this.pos_w = pos_w;
		this.pos_h = pos_h;
		this.w = w;
		this.h = h;
	}

	draw()
	{
		c.fillStyle = "#FFF";
		c.fillRect(this.pos_w, this.pos_h, this.w, this.h);
	}
	posChange(add_pos_w, add_pos_h)
	{
		if(this.pos_w + add_pos_w < 0 || this.pos_w + add_pos_w > 930 || this.pos_h + add_pos_h < 0 || this.pos_h + add_pos_h > 570)
		{
		}
		else
		{
			this.pos_w += add_pos_w;
			this.pos_h += add_pos_h;
		}
	}
	getterW()
	{
		return this.pos_w;
	}
	getterH()
	{
		return this.pos_h;
	}
}

class Bullet
{
	constructor(pos_w, pos_h)
	{
		this.pos_w = pos_w;
		this.pos_h = pos_h;
	}

	move()
	{
		c.fillStyle = "#FFF";
		c.fillRect(this.pos_w, this.pos_h, bulletSize, bulletSize);
		this.pos_w += 2*speed;
	}

	getterW()
	{
		return this.pos_w;
	}

	getterH()
	{
		return this.pos_h;
	}
}


onkeydown = function(e)
{
	if(e.keyCode == 90)
	{
		//bullets.push(new Bullet(ship.getterW() + shipW, ship.getterH() + shipH/2));
		bullets.push(new Bullet(ship.getterW() + shipW, ship.getterH() + shipH/2));
	}
	if(map[39] || map[38] || map[37] || map[40])
	{

	}
	else
	{	
		map[e.keyCode] = e.type == 'keydown';
		if(map[39] && right == false)
		{
			right = true;
			tmp.push(setInterval(function(){ship.posChange(shipSpeed, 0)}, 10));
		}
		else if(map[38] && up == false)
		{
			up = true;
			tmp.push(setInterval(function(){ship.posChange(0, (-1) * shipSpeed)}, 10));
		}
		else if(map[37] && left == false)
		{
			left = true;
			tmp.push(setInterval(function(){ship.posChange((-1) * shipSpeed, 0)}, 10));
		}
		else if(map[40] && down == false)
		{	
			down = true;
			tmp.push(setInterval(function(){ship.posChange(0, shipSpeed)}, 10));
		}
	}

}

onkeyup = function(e)
{
	map[e.keyCode] = false;
	if(tmp.length > 1)
	{
		clearInterval(tmp[1]);
		tmp.pop();
	}
	clearInterval(tmp[0]);
	tmp.pop();
	right = false; up = false; left = false; down = false;
}


function buttonChange()
{
	startButton.removeEventListener("click", start(), true);
}
function canvasCreate()
{
	$("#gameBox").html('<canvas id="canvas" width="960" height="600"></canvas>');
	canvas = document.querySelector("canvas");
	c = canvas.getContext('2d');
}

function start()
{

	c = null;
	canvasCreate();
	stopFlag = false;
	speed = 2;

	//delete bullets
	for(i = 0; i < bullets.length; i++)
	{
		delete bullets[i];
	}
	bullets = [];

	gameFailure = false;
	c = canvas.getContext('2d');
	//buttonFlag = true;
	//$("#command").html("Unikaj przeszkód by wygrać")
	startButton.value = "Reset";
	var rand = 0;
	var tmp = 0;
	var predkoscKatowa = 0;
	var cos = 0;
	var los = 0;
	missBarrierIter = 0;
	$("#level").html(missBarrierIter);
	$("#levelI").val(missBarrierIter);
	for(w = 0; w < 2; w++)
	{	
		flatsBrickSwaped[w] = [];	
	}

	for(w = 0; w < 2; w++)
	{
		for(z = 0; z < ilosc_barrier; z ++)
		{
			//flatsBrick[z] = [];	
			flatsBrickSwaped[w][z] = [];	
		}
	}

	for(w = 0; w < 2; w++)
	{
		for(z = 0; z < ilosc_barrier; z ++)
		{
			for(j = 0; j < flats; j++)
			{				
				flatsBrickSwaped[w][z][j] = [];
			}
		}
	}

	for(i = 0; i < ilosc_barrier; i++)
	{
		barriers.push(new Barrier());
		barriers[i].set(960 + interBarriers * i * 70 + 140, 0, i); //0
		barriers[i].set(960 + interBarriers * i * 70 + 140, 0, i); //0
	
		for(j = 0; j < flats; j++)
		{
			predkoscKatowa = 0.1;
			los = 0.3 + j * 0.01 + i * 0.6;
			cos = Math.ceil(6 * Math.sin(predkoscKatowa * (j + los*10)) * Math.sin(predkoscKatowa * (j + los*10))+1);
			//na oko
			for(k = 0; k < cos; k++)
			{
				flatsBrickSwaped[0][i][j][k] = new Brick(1085 + rec_lenght/2 + k * brickSizeX + i * interBarriers * 70, rec_lenght + j * brickSizeY + wypelnienie, idBrick);
				flatsBrickSwaped[1][i][j][k] = new Brick(1085 + 84 - rec_lenght/2 - k * brickSizeX + i * interBarriers * 70, rec_lenght + j * brickSizeY + wypelnienie, idBrick);
				idBrick += 1;
			}
		}
	}
	
	for(i = 0; i < ilosc_kafelek; i++)
	{
		floor.push(new Rectangle());
		floor[i].set(width + i*rec_lenght, height - rec_lenght, rec_lenght, rec_lenght);
	}

	for(i = 0; i < ilosc_kafelek; i++)
	{
		roof.push(new Rectangle());
		roof[i].set(width + i*rec_lenght, 0, rec_lenght, rec_lenght);
	}

	ship = new Ship(20, 385, 30, 30);
	animate(1000);
}

function stopAnimation()
{
	buttonFlag = false;
	//context = null;
	stopFlag = true;
	
}

function getDistanceBrick(shipX, shipY, pos_w, pos_h)
{
	x = (shipX + shipW/2) - (pos_w + brickSizeX/2);
	y = (shipY + shipH/2) - (pos_h + Math.ceil(brickSizeY/2)); 
	z = Math.ceil(Math.sqrt((Math.pow(x, 2) + Math.pow(y, 2))));
	//console.log(x + " " + y + " " + z);
	return z;
}

function getDistanceWall(shipX, shipY)
{
	for(i = 0; i < 15; i++)
	{
		x = (shipX + shipW/2) - (floor[i].getterW() + rec_lenght/2);
		y = (shipY + shipH/2) - (floor[i].getterH() + rec_lenght/2); 
		z = Math.ceil(Math.sqrt((Math.pow(x, 2) + Math.pow(y, 2))));
		if(z < 55)
		{
			//console.log(z);
			return false;
		}
		x = (shipX + shipW/2) - (roof[i].getterW() + rec_lenght/2);
		y = (shipY + shipH/2) - (roof[i].getterH() + rec_lenght/2); 
		z = Math.ceil(Math.sqrt((Math.pow(x, 2) + Math.pow(y, 2))));
		if(z < 55)
		{
			//console.log(z);
			return false;
		}
	}
	return true;
	
}

function getDistanceBullet(pos_w, pos_h, brickPos_w, brickPos_h)
{
	x = (pos_w + bulletSize/2) - (brickPos_w + brickSizeX/2);
	y = (pos_h + bulletSize/2) - (brickPos_h + Math.ceil(brickSizeY/2)); 
	z = Math.ceil(Math.sqrt((Math.pow(x, 2) + Math.pow(y, 2))));
	//console.log(z);
	return z;
}


function animate(time)
{
	if(stopFlag == false)
	{
		if ((time - lastTime) < FRAME_PERIOD) {
	        requestAnimationFrame(animate);
	        return;
	    }

	    lastTime = time;
		requestAnimationFrame(animate);
		c.clearRect(0, 0, width, height);

		var shipX = ship.getterW();
		var shipY = ship.getterH();

		for(w = 0; w < 2; w++)
		{
			for(i = 0; i < ilosc_barrier; i++)
			{
				for(j = 0; j < flats; j++)
				{
					for(k = 0; k < flatsBrickSwaped[w][i][j].length; k++)
					{				
						if(flatsBrickSwaped[w][i][j][k] != null)
						{
							flatsBrickSwaped[w][i][j][k].move();
						}
					}
				}
			}
		}

		
		for(i = 0; i < 15; i++)
		{
			floor[i].move();
			roof[i].move();
			floor[i].toStart();
			roof[i].toStart();
		}
		ship.draw();
		for(i = 0; i < ilosc_barrier; i++)
		{
			barriers[i].move();
			barriers[i].toStart();
		}


		for(x = 0; x < bullets.length; x++)
		{
			if(bullets[x] != null)
			{
				bullets[x].move();
			}
		}

		for(w = 0; w < 2; w++)
		{
			for(i = 0; i < ilosc_barrier; i++)
			{
				for(j = 0; j < flats; j++)
				{
					for(k = 0; k < flatsBrickSwaped[w][i][j].length; k++)
					{
						if(flatsBrickSwaped[w][i][j][k] != null)
						{
							//kolizja z ceglami
							
							if(getDistanceBrick(shipX, shipY, flatsBrickSwaped[w][i][j][k].getterW(), flatsBrickSwaped[w][i][j][k].getterH()) < 20)
							{
								console.log("lol1");
								gameFailure = true;
							}

							for(q = 0; q < bullets.length; q++)
							{					
								if(getDistanceBullet(bullets[q].getterW(), bullets[q].getterH(), flatsBrickSwaped[w][i][j][k].getterW(), flatsBrickSwaped[w][i][j][k].getterH()) < 7)
								{
									brickToSpliceW = w;
									brickToSpliceI = i;
									brickToSpliceJ = j;
									brickToSpliceK = k;
									bulletToSplice = q;									
								}			
							}
						}
					}
				}
			}
		}

		if(bulletToSplice != null)
		{
			flatsBrickSwaped[brickToSpliceW][brickToSpliceI][brickToSpliceJ].splice(brickToSpliceK, 1);
			bullets.splice(bulletToSplice, 1);
			bulletToSplice = null;
		}

		//kolizja z sufitem/podloga
		if(!getDistanceWall(shipX, shipY))
		{
			gameFailure = true;
		}

		if(gameFailure)
		{
			//$("#command").html("Przegrana");
			stopAnimation();
		}
		
		if(barriers[missBarrierIter].getterW() < 0 && missBarrierIter < 20)
		{
			missBarrierIter += 1;
			$("#level").html(missBarrierIter);
			$("#levelI").val(missBarrierIter);
		}
		if(missBarrierIter > 3 && missBarrierIter < 7)
		{

			speed = 2;
		}
		if(missBarrierIter > 10)
		{
			speed = 3;
		}
		if(missBarrierIter > 20)
		{
			$("#level").html('666');
		}
	}
	else
	{
		context = null;
	}
}
