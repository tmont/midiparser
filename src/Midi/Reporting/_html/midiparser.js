(function(){
	
	var currentTrack = 0;
	var numTracks = {numItems};
	
	var init = function() {
		setDivHeight();
		window.onresize = setDivHeight;
		
		numTracks = getElementsByClassName("track", document.getElementById("content"), "a").length;
		
		document.getElementById("nav-previous").onclick = previousTrack;
		document.getElementById("nav-next").onclick = nextTrack;
		
		document.onkeypress = handleKeyPress;
	}
	
	var handleKeyPress = function(e) {
		e = e || window.event;
		
		switch (e.keyCode) {
			case 37:
				previousTrack();
				break;
			case 39:
				nextTrack();
				break;
		}
	}
	
	var setDivHeight = function() {
		var parseResults = document.getElementById("content");
		var windowHeight = typeof(window.innerHeight) != "undefined" ? window.innerHeight : document.body.clientHeight;
		parseResults.style.height = Math.max(100, (windowHeight - 100)) + "px";
	}
	
	var gotoTrack = function(trackNumber) {
		var track = document.getElementById("track" + trackNumber);
		track.scrollIntoView(true);
	}
	
	var previousTrack = function() {
		if (currentTrack - 1 > 0) {
			currentTrack--;
			gotoTrack(currentTrack);
		}
	}
	
	var nextTrack = function() {
		if (currentTrack + 1 <= numTracks) {
			currentTrack++;
			gotoTrack(currentTrack);
		}
	}
	var getElementsByClassName = function(cls, root, tag) {
		root = root || document;
		tag  = tag || "*";
		
		var els     = root.getElementsByTagName(tag);
		var matches = [];
		for (var i = 0, len = els.length, regex = new RegExp("(^|\\s)" + cls + "($|\\s)", "i"); i < len; i++) {
			if (els[i].className.match(regex) != null) {
				matches.push(els[i]);
			}
		}
		
		return matches;
	}

	
	window.onload = init;
	
}());