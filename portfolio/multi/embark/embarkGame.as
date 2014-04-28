﻿package {	import flash.display.*;	import flash.events.*;	import flash.utils.Timer;	import flash.display.Sprite;	import flash.text.TextField;	import flash.media.Sound;	import flash.media.SoundChannel;	import flash.utils.Timer;	import flash.events.TimerEvent;	import flash.display.MovieClip;	import flash.media.Sound;	import flash.net.URLRequest;	import flash.net.URLLoader;	import flash.media.SoundChannel;	import flash.media.SoundTransform;	import flash.media.SoundMixer;	import com.greensock.TweenLite;	import com.greensock.TweenMax;	import com.greensock.*;	import com.greensock.easing.*;	public class embarkGame extends MovieClip	{		public var backgnd:MovieClip = new MovieClip();		private var embarkship:embarkShip;		private var Shield:shield;		private var asteroid:Array;		private var bkgAsteroid:Array;		private var blasters:Array;		public var upArrow,downArrow,leftArrow,rightArrow:Boolean;		private var nextAsteroid:Timer;		private var nextBkgAsteroid:Timer;		public var difficulty:int = 1;		public var i:int = 0;		public var j:int = 0;		public var k:int = 0;		private var shotsHit:int = 0;		private var shots:int = 0;		public var shipLives:int = 3;		public var shipShot:Boolean = false;		public var hitsTimer:Timer = new Timer(4000,1);		public var count:Number;		public var damage:Number = 0;		public var lvlTimer:Timer = new Timer(1000,count);		public var explosionSound:Sound;		public var explosionChannel:SoundChannel;		public var explosion:String = "music/explosion.mp3";		public var zapSound:Sound;		public var Planet:MovieClip = new planet();		public var zapChannel:SoundChannel;		public var zap:String = "music/zap.mp3";		public var levelSong:Sound;		public var levelChannel:SoundChannel;		public var levelSongs:Array = ["music/CutAndRun.mp3","music/Cipher.mp3","music/Presenterator.mp3"];		public var songtransform:SoundTransform = new SoundTransform(0.1,0);		public var effectstransform:SoundTransform = new SoundTransform(0.3,0);		public var effectstransformtwo:SoundTransform = new SoundTransform(0.1,0);		public function startEmbark()		{			// init score			addChild(backgnd);			showGameScore();			shipLivesLeft();			// create ship			embarkship = new embarkShip();			addChild(embarkship);			// create object arrays			asteroid = new Array();			bkgAsteroid = new Array();			blasters = new Array();			// listen for keyboard			stage.addEventListener(KeyboardEvent.KEY_DOWN,keyDownFunction);			stage.addEventListener(KeyboardEvent.KEY_UP,keyUpFunction);			// look for collisions			addEventListener(Event.ENTER_FRAME,checkForHits);			addEventListener(Event.ENTER_FRAME,checkForShipHits);			// start asteroids flying			whichLevel();		}		public function finalScoreCalc()		{			var lifeBonus:Number;			if (shipLives == 3){			    lifeBonus = shipLives * 20;			} else {				lifeBonus = shipLives * 10;			}			var totalPoints = shotsHit / shots;			var percentage = Math.round(totalPoints*100);			var scoreTotal = Math.round(lifeBonus+(totalPoints * shotsHit) - (damage * 2));			finalScore.text = String("Life Bonus: "+ lifeBonus + '\n' + "Damage: -" + damage*2 + "\n" + "Shot Accuracy: " + percentage + "%" + '\n' + "Asteroids Hit: " + shotsHit + '\n' + "Final Score: " + scoreTotal);		}		public function whichLevel()		{			if (level == 1)			{				embarkship.x = 100;				embarkship.y = 230;				levelSong = new Sound();				levelSong.load(new URLRequest(levelSongs[0]));				levelChannel = levelSong.play();				levelChannel.soundTransform = songtransform;				TweenMax.to(levelChannel, 0, {volume:0});				TweenMax.to(levelChannel, 2, {volume:.3});				k = 25;				if (difficulty == 1)				{					trace('easy');					i = 650;					j = 35;				}				if (difficulty == 2)				{					trace('medium');					i = 600;					j = 40;				}				if (difficulty == 3)				{					trace('hard');					i = 550;					j = 45;				}				count = j;				TweenLite.delayedCall(1, setBkgAsteroid, []);				TweenLite.delayedCall(2, setAsteroid, []);				setLevelTimer();				backgnd.addChild(Planet);				with (Planet)				{					scaleX = .3;					scaleY = .3;					alpha = .8;					x = 700;					y = 200;				}				TweenLite.to(Planet, 45, {x:-200});			}			else if (level == 2)			{				levelSong = new Sound();				levelSong.load(new URLRequest(levelSongs[1]));				levelChannel = levelSong.play();				levelChannel.soundTransform = songtransform;				TweenMax.to(levelChannel, 2, {volume:.5});				k = 75;				if (difficulty == 1)				{					i = 450;					j = 55;				}				if (difficulty == 2)				{					i = 400;					j = 60;				}				if (difficulty == 3)				{					i = 350;					j = 65;				}				count = j;				TweenLite.delayedCall(1, setBkgAsteroid, []);				TweenLite.delayedCall(2, setAsteroid, []);				setLevelTimer();				embarkship.x = 100;				embarkship.y = 230;				with (Planet)				{					scaleX = .6;					scaleY = .6;					alpha = .8;					x = 700;					y = 200;				}				backgnd.addChild(Planet);				TweenLite.to(Planet, 140, {x:-700});			}			else if (level == 3)			{				levelSong = new Sound();				levelSong.load(new URLRequest(levelSongs[2]));				levelChannel = levelSong.play();				levelChannel.soundTransform = songtransform;				TweenMax.to(levelChannel, 2, {volume:.3});				k = 200;				if (difficulty == 1)				{					i = 350;					j = 75;				}				if (difficulty == 2)				{					i = 300;					j = 80;				}				if (difficulty == 3)				{					i = 250;					j = 85;				}				count = j;				TweenLite.delayedCall(1, setBkgAsteroid, []);				TweenLite.delayedCall(2, setAsteroid, []);				setLevelTimer();				embarkship.x = 100;				embarkship.y = 230;				with (Planet)				{					scaleX = 1;					scaleY = 1;					alpha = 1;					x = 800;					y = 200;				}				backgnd.addChild(Planet);				TweenLite.to(Planet, 210, {x:-800});				embarkship.x = 100;				embarkship.y = 230;			}		}		public function setLevelTimer()		{			lvlTimer.addEventListener(TimerEvent.TIMER, checkTimer);			lvlTimer.start();		}		public function setAsteroid()		{			nextAsteroid = new Timer(i+Math.random()*i,1);			nextAsteroid.addEventListener(TimerEvent.TIMER_COMPLETE,newAsteroid);			nextAsteroid.start();		}		public function setBkgAsteroid()		{			nextBkgAsteroid = new Timer(i+Math.random()*k,1);			nextBkgAsteroid.addEventListener(TimerEvent.TIMER_COMPLETE,newBkgAsteroid);			nextBkgAsteroid.start();		}		public function checkTimer(event:TimerEvent):void		{			if (countDown.text == "Time: 0 seconds")			{				for (var i:int=asteroid.length-1; i>=0; i--)				{					TweenLite.to(asteroid[i], 1, {x:"-35", alpha:0});				}				TweenMax.to(levelChannel, 2, {volume:0, onComplete:stopLevelSong});				function stopLevelSong()				{					TweenLite.killTweensOf(levelChannel);				}				if (level != 3)				{					TweenLite.killTweensOf(Planet);					backgnd.removeChild(Planet);					countDown.text = "Level Complete";					lvlTimer.stop();					lvlTimer.reset();					hitsTimer.stop();					hitsTimer.reset();					asteroid = null;					embarkship.deleteShip();					embarkship = null;					stage.removeEventListener(KeyboardEvent.KEY_DOWN,keyDownFunction);					removeEventListener(Event.ENTER_FRAME,checkForHits);					removeEventListener(Event.ENTER_FRAME,checkForShipHits);					removeEventListener(TimerEvent.TIMER, checkTimer);					nextAsteroid.stop();					nextAsteroid = null;					bkgAsteroid = null;					nextBkgAsteroid.stop();					nextBkgAsteroid = null;					nextFrame();				}				else				{					asteroid = null;					restore.text = "You Win!";					TweenLite.killTweensOf(Planet);					backgnd.removeChild(Planet);					countDown.text = "Level Complete";					lvlTimer.stop();					lvlTimer.reset();					hitsTimer.stop();					hitsTimer.reset();					removeEventListener(Event.ENTER_FRAME,checkForHits);					removeEventListener(Event.ENTER_FRAME,checkForShipHits);					removeEventListener(TimerEvent.TIMER, checkTimer);					nextAsteroid.stop();					nextAsteroid = null;					bkgAsteroid = null;					nextBkgAsteroid.stop();					nextBkgAsteroid = null;					TweenLite.delayedCall(2, afterTween, []);					function afterTween()					{						TweenLite.to(embarkship, 5, {x:800 ,ease:Back.easeIn, onComplete:youWin});					}				}			}			else			{				countDown.text = String("Time: " + ((count)-lvlTimer.currentCount) + " seconds");			}		}		public function newBkgAsteroid(event:TimerEvent)		{			// random side, speed and altitude			var side:String = "right";			var altitude:Number = Math.random() * 320 + 60;			var speed:Number = Math.random() * 80 + 80;			// create plane			var q:backgroundAsteroid = new backgroundAsteroid(side,speed,altitude);			this.addChildAt(q, 1);			bkgAsteroid.push(q);			// set time for next plane;			setBkgAsteroid();		}		public function newAsteroid(event:TimerEvent)		{			// random side, speed and altitude			var side:String = "right";			var altitude:Number = Math.random() * 320 + 60;			var speed:Number = Math.random() * 150 + 150;			// create plane			var p:Asteroid = new Asteroid(side,speed,altitude);			addChild(p);			asteroid.push(p);			// set time for next plane;			setAsteroid();		}		// check for collisions		public function checkForHits(event:Event)		{			for (var blastersNum:int=blasters.length-1; blastersNum>=0; blastersNum--)			{				for (var asteroidNum:int=asteroid.length-1; asteroidNum>=0; asteroidNum--)				{					if (blasters[blastersNum].hitTestObject(asteroid[asteroidNum]))					{						asteroid[asteroidNum].asteroidHit();						blasters[blastersNum].deleteBlaster();						shotsHit++;						explosionSound = new Sound();						explosionSound.load(new URLRequest(explosion));						explosionChannel = explosionSound.play();						explosionChannel.soundTransform = effectstransform;						showGameScore();						break;					}				}			}		}		public function checkForShipHits(event:Event)		{			for (var asteroidNumb:int=asteroid.length-1; asteroidNumb>=0; asteroidNumb--)			{				if (asteroid[asteroidNumb].hitTestObject(embarkship.hitShip))				{					removeEventListener(Event.ENTER_FRAME,checkForShipHits);					embarkship.play();					asteroid[asteroidNumb].deleteAsteroid();					shipShot = true;					damage++;					if (damage == 4)					{						shipLives--;						shipLivesLeft();						damage = 0;						explosionSound = new Sound();						explosionSound.load(new URLRequest(explosion));						explosionChannel = explosionSound.play();						explosionChannel.soundTransform = effectstransform;						TweenLite.to(damageBar, 1, {x:0});						refillHp();					}					else					{						explosionSound = new Sound();						explosionSound.load(new URLRequest(explosion));						explosionChannel = explosionSound.play();						explosionChannel.soundTransform = effectstransform;						takeDamage();					}					Shield = new shield();					embarkship.addChild(Shield);					with (Shield)					{						x = -50;						alpha = 0;					}					if (shipLives >= 1)					{						waitForHits();						restore.text = "Shields Up!";						TweenLite.to(Shield, 2, {alpha:1, delay:1});						shipShot = false;						return;					}					else					{						endGame();						return;					}					break;				}			}		}		public function takeDamage()		{			TweenLite.to(damageBar, 1, {x:"-35", alpha:"-.10"});		}		public function refillHp()		{			with (damageBar)			{				alpha = 0;			}			TweenLite.to(damageBar, 1, {x:202.70, alpha:1, delay:1});		}		public function waitForHits()		{			hitsTimer.addEventListener(TimerEvent.TIMER, timerListener);			function timerListener(e:TimerEvent):void			{				TweenLite.to(Shield, 1, {alpha:0});				restore.text = "";				TweenLite.delayedCall(1, sheildDelayHits, []);			}			hitsTimer.start();		}		public function sheildDelayHits()		{			addEventListener(Event.ENTER_FRAME,checkForShipHits);		}		// key pressed		public function keyDownFunction(event:KeyboardEvent)		{			if (event.keyCode == 38)			{				upArrow = true;			}			else if (event.keyCode == 40)			{				downArrow = true;			}			else if (event.keyCode == 37)			{				leftArrow = true;			}			else if (event.keyCode == 39)			{				rightArrow = true;			}			else if (event.keyCode == 32)			{				fireBullet();			}		}		// key lifted		public function keyUpFunction(event:KeyboardEvent)		{			if (event.keyCode == 38)			{				upArrow = false;			}			else if (event.keyCode == 40)			{				downArrow = false;			}			else if (event.keyCode == 37)			{				leftArrow = false;			}			else if (event.keyCode == 39)			{				rightArrow = false;			}		}		// new bullet created		public function fireBullet()		{			if (shipShot == false)			{				var b:Blaster = new Blaster(embarkship.x,embarkship.y,-500);				addChild(b);				blasters.push(b);				shots++;				zapSound = new Sound();				zapSound.load(new URLRequest(zap));				zapChannel = zapSound.play();				zapChannel.soundTransform = effectstransformtwo;				showGameScore();			}		}		public function showGameScore()		{			showScore.text = String("Score: "+shotsHit);		}		public function shipLivesLeft()		{			showLives.text = String("Lives: "+shipLives);		}		// take a plane from the array		public function removeAsteroid(asteroids:Asteroid)		{			for (var i in asteroid)			{				if (asteroid[i] == asteroids)				{					asteroid.splice(i,1);					break;				}			}		}		public function removeBkgAsteroid(bkgAsteroids:backgroundAsteroid)		{			for (var i in bkgAsteroid)			{				if (bkgAsteroid[i] == bkgAsteroids)				{					bkgAsteroid.splice(i,1);					break;				}			}		}		// take a bullet from the array		public function removeBlaster(blasterEach:Blaster)		{			for (var i in blasters)			{				if (blasters[i] == blasterEach)				{					blasters.splice(i,1);					break;				}			}		}		// game is over, clear movie clips		public function youWin()		{			stage.removeEventListener(KeyboardEvent.KEY_DOWN,keyDownFunction);			stage.removeEventListener(KeyboardEvent.KEY_UP,keyUpFunction);			TweenLite.killTweensOf(embarkship);			TweenLite.killTweensOf(Planet);			asteroid = null;			bkgAsteroid = null;			embarkship.deleteShip();			embarkship = null;			gotoAndStop("win");		}		public function endGame()		{			TweenLite.killTweensOf(Planet);			lvlTimer.stop();			lvlTimer.reset();			hitsTimer.stop();			hitsTimer.reset();			for (var i:int=asteroid.length-1; i>=0; i--)			{				TweenLite.to(asteroid[i], 1, {x:"-35", alpha:0});			}			bkgAsteroid = null;			nextBkgAsteroid.stop();			nextBkgAsteroid = null;			asteroid = null;			embarkship.deleteShip();			embarkship = null;			stage.removeEventListener(KeyboardEvent.KEY_DOWN,keyDownFunction);			stage.removeEventListener(KeyboardEvent.KEY_UP,keyUpFunction);			removeEventListener(Event.ENTER_FRAME,checkForHits);			removeEventListener(Event.ENTER_FRAME,checkForShipHits);			removeEventListener(TimerEvent.TIMER, checkTimer);			nextAsteroid.stop();			nextAsteroid = null;			embarkship.x = 100;			embarkship.y = 230;			gotoAndStop("gameover");		}	}}