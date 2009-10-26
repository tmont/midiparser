(function(){
	
	var currentPage = 0;
	var numPages    = {numItems};
	var pageHistory = [];
	
	var init = function() {
		window.onresize = setDivHeight;
		window.setPageCoordinates = setPageCoordinates;
		
		document.getElementById("nav-previous").onclick = previousPage;
		document.getElementById("nav-next").onclick = nextPage;
		
		document.onkeypress = handleKeyPress;
		
		nextPage();
		setDivHeight();
		
		window.setTimeout(setPageCoordinates, 500);
	}
	
	var setPageCoordinates = function() {
		var content = document.getElementById("content");
		var coords = getGlobalPosition(content);
		var page = document.getElementById("page");
		
		page.style.top = (coords[1] + 2) + "px";
		page.style.left = (coords[0] + content.clientWidth - page.clientWidth + 1) + "px";
	}
	
	var getGlobalPosition = function(element) {
		var pos = (typeof(element.offsetLeft) == "undefined") ? [0, 0] : [element.offsetLeft, element.offsetTop];
		while (element = element.offsetParent) {
			pos[0] += parseInt(element.offsetLeft);
			pos[1] += parseInt(element.offsetTop);
		}
		
		return pos;
	}
	
	var handleKeyPress = function(e) {
		e = e || window.event;
		
		switch (e.keyCode) {
			case 37:
				previousPage();
				break;
			case 39:
				nextPage();
				break;
		}
	}
	
	var createLoadingOverlay = function() {
		var parent = document.getElementById("content");
		var loader = document.createElement("div");
		loader.id = "loader";
		loader.style.top = (Math.floor(parent.offsetHeight / 2) - 30) + "px";
		loader.style.left = (Math.floor(parent.offsetWidth / 2) - 50) + "px";
		
		parent.appendChild(loader);
	}
	
	var removeLoadingOverlay = function() {
		var loader = document.getElementById("loader");
		if (loader) {
			loader.parentNode.removeChild(loader);
		}
	}
	
	var setDivHeight = function() {
		var parseResults = document.getElementById("content");
		var windowHeight = typeof(window.innerHeight) != "undefined" ? window.innerHeight : document.documentElement.clientHeight;
		
		parseResults.style.height = Math.max(100, (windowHeight - 100)) + "px";
		setPageCoordinates();
	}
	
	var gotoPage = function(pageNumber) {
		if (typeof(pageHistory[pageNumber]) != "undefined") {
			setParseResultsContents(pageNumber);
		} else {
			var request = createAjaxRequest("data" + pageNumber + ".html", "GET", true, pageHandler);
			if (request) {
				createLoadingOverlay();
				request.send(null);
			} else {
				alert("EPIC FAIL");
			}
		}
	}
	
	var pageHandler = function(request, e) {
		if (request.readyState === 4 && request.status === 200) {
			removeLoadingOverlay();
			pageHistory[currentPage] = request.responseText;
			setParseResultsContents(currentPage);
		}
	}
	
	var setParseResultsContents = function(pageNumber) {
		var page = document.getElementById("page");
		
		if (window.event) {
			//ie hackery
			var parseResults = document.getElementById("parse-results");
			parseResults.parentNode.removeChild(parseResults);
			document.getElementById("content").innerHTML = "<table id=\"parse-results\">" + pageHistory[pageNumber] + "</table>";
			if (!page.firstChild) {
				page.appendChild(document.createTextNode("dummy"));
			}
		} else {
			document.getElementById("parse-results").innerHTML = pageHistory[pageNumber];
		}
		
		page.replaceChild(document.createTextNode("page " + pageNumber + "/" + numPages), page.firstChild);
	}
	
	var previousPage = function() {
		if (currentPage - 1 > 0) {
			currentPage--;
			gotoPage(currentPage);
		}
	}
	
	var nextPage = function() {
		if (currentPage + 1 <= numPages) {
			currentPage++;
			gotoPage(currentPage);
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
	
	var createAjaxRequest = function() {
		var requestFactory = null;
		if (window.XMLHttpRequest) {
			//Firefox, IE7, Opera, Chrome
			requestFactory = new XMLHttpRequest();
			if (typeof(requestFactory.constructor) == "undefined" || window.opera) {
				//not checking for constructor breaks IE8
				//why is everything so difficult?
				requestFactory.constructor = XMLHttpRequest; //IE7/8 and Opera needsthis
			}
		} else if (window.ActiveXObject) {
			try {
				//IE6 (h4x0rz!)
				requestFactory = new ActiveXObjectWrapper("Msxml2.XMLHTTP");
			} catch (e) {
				//anything else, whatev
				requestFactory = false;
			}
		} else {
			requestFactory = false;
		}
		
		return function(url, method, async, callback) {
			if (!requestFactory) {
				return false;
			}
			
			var request = new requestFactory.constructor();
			method      = method.toUpperCase();
			
			request.open(method, url, async);
			if (async && callback) {
				request.onreadystatechange = function(e) {
					callback.apply(null, [request, e || window.event]);
				}
			}

			request.setRequestHeader("Accept", "text/html");
			
			if (method === "POST") {
				request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				request.setRequestHeader("Connection", "close");
			}
			
			return request;
		}
	}();
	
	var ActiveXObjectWrapper = function(type) {
		this.constructor = function() {
			return new ActiveXObject(type);
		}
	}

	window.onload = init;
	
}());