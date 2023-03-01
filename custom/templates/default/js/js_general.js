function toggleView(id)
{
	elem = document.getElementById(id);

	if(elem != null)
	{
		if (elem.style.visibility != "visible")
			elem.style.visibility = "visible";
		else
			elem.style.visibility = "hidden";
	}
}

function ajax_load(callback, params)
{
	js_wait(true);

	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	if (typeof callback === "function")
	{
		xmlhttp.onreadystatechange = callback;

		xmlhttp.open("POST", "index.php", true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(params);
	}
}

function js_wait(start)
{
	if (start)
	{
		var overlay = document.createElement("div");
		overlay.id = 'overlay';

		var message = document.createElement("div");
		message.id = "oBackground";
		message.style.maxWidth = screen.width;
		message.style.maxHeight = screen.height;

		var image = document.createElement("img");
		image.id = "oImage";
		image.alt = "Wait";
		image.src = "custom/pics/ajax-loader.gif";

		message.appendChild(image);
		overlay.appendChild(message);
		document.body.appendChild(overlay);
	}
	else
	{
		var overlay = document.getElementById('overlay');
		overlay.parentNode.removeChild(overlay);
	}
}

function js_wait2(start)
{
	var overlay = document.getElementById('overlay2');
	overlay.parentNode.removeChild(overlay);
}

function js_message(message, time, over)
{
	var divMessage = document.createElement("div");
	divMessage.id = "oBackground";
	divMessage.innerHTML = message;

	if (over == true)
	{
		var divOverlay = document.createElement("div");
		divOverlay.id = 'overlay';
		divOverlay.appendChild(divMessage);
		document.body.appendChild(divOverlay);
	}
	else
	{
		document.body.appendChild(divMessage);
	}

	if (time > 0)
	{
		setTimeout("js_messageClose(" + over + ")", time * 1000);
	}
}

function js_messageClose(over)
{
	if (over == true)
	{
		var div = document.getElementById('overlay');
	}
	else
	{
		var div = document.getElementById('oBackground');
	}	
	
	div.parentNode.removeChild(div);
}
