﻿package {	import flash.display.*;	import flash.events.*;	import flash.utils.getTimer;		public class Blaster extends MovieClip {		private var dy:Number; // vertical speed		private var lastTime:int;				public function Blaster(x:Number,y, speed: Number) {			// set start position			this.x = x;			this.y = y;			// get speed			dy = speed;			// set up animation			lastTime = getTimer();			addEventListener(Event.ENTER_FRAME,moveBlaster);		}				public function moveBlaster(event:Event) {			// get time passed			var timePassed:int = getTimer()-lastTime;			lastTime += timePassed;						// move bullet			this.x -= dy*timePassed/1000;						// bullet past top of screen			if (this.x < 0) {				deleteBlaster();			}					}		// delete bullet from stage and plane list		public function deleteBlaster() {			MovieClip(parent).removeBlaster(this);			parent.removeChild(this);			removeEventListener(Event.ENTER_FRAME,moveBlaster);		}	}}