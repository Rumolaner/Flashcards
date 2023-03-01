function login_send()
{
	var params = "a=appLogin&login="+document.getElementById('login').value;
	ajax_load(login_receive, params);
}

function login_receive()
{
	if (this.readyState === 4 && this.status === 200) 
	{
		var parser = new DOMParser();
		var xmlDoc = parser.parseFromString(this.responseText, "application/xml");
		code=xmlDoc.getElementsByTagName("code")[0].childNodes[0].nodeValue;
		text=xmlDoc.getElementsByTagName("message")[0].childNodes[0].nodeValue;

		js_wait(false);
		js_message(text, 3, true);

		if (code == 3019)
		{
			window.location = "index.php";
		}

		if (code == 3020)
		{
			window.location = "index.php?a=webRegConfirm&t=remind";
		}
	}
}

