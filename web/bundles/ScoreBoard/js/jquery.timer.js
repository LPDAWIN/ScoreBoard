;(function($) {
	$.timer = function(func, time, autostart) {	
	 	this.set = function(func, time, autostart) {
	 		//alert("init");
	 		this.init = true;
	 	 	if(typeof func == 'object') {
		 	 	var paramList = ['autostart', 'time'];
	 	 	 	for(var arg in paramList) {if(func[paramList[arg]] != undefined) {eval(paramList[arg] + " = func[paramList[arg]]");}};
 	 			func = func.action;
	 	 	}
	 	 	if(typeof func == 'function') {this.action = func;}
		 	if(!isNaN(time)) {this.intervalTime = time;}
		 	if(autostart && !this.isActive) {
			 	this.isActive = true;
			 	this.setTimer();
		 	}
		 	return this;
	 	};
	 	this.once = function(time) {
	 		//alert("once");
			var timer = this;
	 	 	if(isNaN(time)) {time = 0;}
			window.setTimeout(function() {timer.action();}, time);
	 		return this;
	 	};
		this.play = function(reset) {
			var btn="play";
			$.post(Routing.generate('match_ScoreBoard', {id: match_id}), {'btn':btn}, function(data, textStatus) {
				console.log(Routing.generate('match_ScoreBoard', {id: match_id}))
				console.log(btn);
			});
			if(!this.isActive) {
				if(reset) {this.setTimer();}
				else {this.setTimer(this.remaining);}
				this.isActive = true;	
			}
			return this;
		};
		this.pause = function() {
			//alert("pause");
			if(this.isActive) {
				this.isActive = false;
				this.remaining -= new Date() - this.last;
				this.clearTimer();
			}
			return this;
		};
		this.stop = function() {
			//alert("stop");
			this.isActive = false;
			this.remaining = this.intervalTime;
			this.clearTimer();
			return this;
		};
		this.toggle = function(reset) {
			
			if(this.isActive) {this.pause();}
			else if(reset) {this.play(true);}
			else {this.play();}
			return this;
		};
		this.reset = function() {
			//alert("reset");
			this.isActive = false;
			this.play(true);
			return this;
		};
		this.clearTimer = function() {
			window.clearTimeout(this.timeoutObject);
		};
	 	this.setTimer = function(time) {
	 		
			var timer = this;
	 	 	if(typeof this.action != 'function') {return;}
	 	 	if(isNaN(time)) {time = this.intervalTime;}
		 	this.remaining = time;
	 	 	this.last = new Date();
			this.clearTimer();
			this.timeoutObject = window.setTimeout(function() {timer.go();}, time);
		};
	 	this.go = function() {
	 		
	 		if(this.isActive) {
	 			this.action();
	 			this.setTimer();
	 		}
	 	};
	 	
	 	if(this.init) {
	 		return new $.timer(func, time, autostart);
	 	} else {
			this.set(func, time, autostart);
	 		return this;
	 	}
	};
})(jQuery);