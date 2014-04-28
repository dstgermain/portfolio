﻿package {	import flash.display.*;	import flash.events.*;	import flash.utils.getTimer;		public class Asteroid extends MovieClip {		private var dx:Number; // speed and direction		private var lastTime:int; // animation time				public function Asteroid(side:String, speed:Number, altitude:Number) {		    if (side == "right") {				this.x = 600; // start to the right				dx = -speed; // fly right to left				this.scaleX = 1; // not reverse			}			this.y = altitude; // vertical position						// choose a random plane			this.gotoAndStop(Math.floor(Math.random()*3+1));						// set up animation			addEventListener(Event.ENTER_FRAME,moveAsteroid);			lastTime = getTimer();		}				public function moveAsteroid(event:Event) {			// get time passed			var timePassed:int = getTimer()-lastTime;			lastTime += timePassed;						// move plane			this.x += dx*timePassed/1000;						// check to see if off screen			if ((dx < 0) && (x < -50)) {				deleteAsteroid();			} 		}				// plane hit, show explosion		public function asteroidHit() {			removeEventListener(Event.ENTER_FRAME,moveAsteroid);			MovieClip(parent).removeAsteroid(this);			gotoAndPlay("explode");		}				// delete plane from stage and plane list		public function deleteAsteroid() {			removeEventListener(Event.ENTER_FRAME,moveAsteroid);			MovieClip(parent).removeAsteroid(this);			parent.removeChild(this);		}			}}