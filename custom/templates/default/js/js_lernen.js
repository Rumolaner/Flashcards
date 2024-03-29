function anzeigen_send()
{
	let id = document.getElementById('hiddenid').innerHTML
	var params = "a=appAntwortAnzeigen&id="+id;
	ajax_load(anzeigen_receive, params);
}

function anzeigen_receive()
{
	if (this.readyState === 4 && this.status === 200)
	{
		var parser = new DOMParser();
		var xmlDoc = parser.parseFromString(this.responseText, "application/xml");
		code=xmlDoc.getElementsByTagName("code")[0].childNodes[0].nodeValue;
		text=xmlDoc.getElementsByTagName("message")[0].childNodes[0].nodeValue;

		let answer = "";
		for (i = 0; i < xmlDoc.getElementsByTagName("answer")[0].childNodes.length; i++)
		{
			if (xmlDoc.getElementsByTagName("answer")[0].childNodes[i].nodeValue != null)
				answer+=xmlDoc.getElementsByTagName("answer")[0].childNodes[i].nodeValue + '<br>';
		}

		js_wait(false);

		if (code == 5001)
		{
			//Antwort wurde geladen
			var element = document.getElementById('answer').innerHTML = answer
		}
		else if (code == 5002)
		{
			//Antwort konnte nicht geladen werden
			js_message(text, 3, true);
		}
	}
}

function hinweis_send()
{
	let id = document.getElementById('hiddenid').innerHTML
	var params = "a=appHinweis&id="+id;
	ajax_load(hinweis_receive, params);
}

function hinweis_receive()
{
	if (this.readyState === 4 && this.status === 200) 
	{
		let answer = JSON.parse(this.responseText);
		let code = answer["code"]
		let text = answer["message"]
		let hinweis = answer["hinweis"]

		if (code == 5001)
		{
			document.getElementById('question').innerHTML += "<br><br>" + hinweis
		}
		else if (code == 5003)
		{
			//Antwort konnte nicht geladen werden
			js_message(text, 3, true);
		}

		js_wait(false);

	}
}

function todo_send()
{
	let id = document.getElementById('hiddenid').innerHTML
	var params = "a=appTodo&id="+id;
	ajax_load(todo_receive, params);
}

function todo_receive()
{
	if (this.readyState === 4 && this.status === 200) 
	{
		let answer = JSON.parse(this.responseText);
		let code = answer["code"]
		let text = answer["message"]

		//Antwort, egal was
		js_message(text, 3, true);

		js_wait(false);

	}
}

function antworten_send(richtig)
{
	let id = document.getElementById('hiddenid').innerHTML
	var params = "a=appAntworten&id="+id+"&richtig="+richtig;
	ajax_load(antworten_receive, params);
}

function antworten_receive()
{
	if (this.readyState === 4 && this.status === 200) 
	{
		var parser = new DOMParser();
		var xmlDoc = parser.parseFromString(this.responseText, "application/xml");
		code=xmlDoc.getElementsByTagName("code")[0].childNodes[0].nodeValue;
		text=xmlDoc.getElementsByTagName("message")[0].childNodes[0].nodeValue;

		js_wait(false);

		if (code == 5001)
		{
			window.location = "index.php?a=webLernen";
		}
		else if (code == 5002)
		{
			//Antwort konnte nicht geladen werden
			js_message(text, 3, true);
		}
	}
}

function saveSet_send()
{
	let value = "";
	let name = document.getElementById('setname');

	if (name.value == ''){
		alert("Bitte gib einen Namen für das Set ein");
	} else {
	        if (confirm("Bist du sicher dass du dieses Set speichern willst?")){
			let inputs = document.getElementsByTagName("input");
			for (const input of inputs) {
				if (input.name.substring(0, 3) == 'kat'){
					if (input.checked == true){
						if (value != ''){
							value += ',';
						}
						value += input.value;
					}
				}
			}
			var params = "a=appBenutzerSet&name="+name.value+"&wert="+value;
		        ajax_load(saveSet_receive, params);
		}
	}
}

function saveSet_receive()
{
        if (this.readyState === 4 && this.status === 200)
        {
                var parser = new DOMParser();
                var xmlDoc = parser.parseFromString(this.responseText, "application/xml");
                code=xmlDoc.getElementsByTagName("code")[0].childNodes[0].nodeValue;
                text=xmlDoc.getElementsByTagName("message")[0].childNodes[0].nodeValue;

                js_wait(false);

                //Antwort konnte nicht geladen werden
                js_message(text, 3, true);
        }
}

function loadSet_send()
{
        let name = document.getElementById('benutzerset');

	if (name.value != "")
	{
		document.getElementById('setname').value = name.options[name.selectedIndex].text;
	        var params = "a=appLoadBenutzerSet&id="+name.value;

        	ajax_load(loadSet_receive, params);
		name.value = "";
	}
}

function loadSet_receive()
{
        if (this.readyState === 4 && this.status === 200)
        {
                var parser = new DOMParser();
                var xmlDoc = parser.parseFromString(this.responseText, "application/xml");
                code=xmlDoc.getElementsByTagName("code")[0].childNodes[0].nodeValue;
                text=xmlDoc.getElementsByTagName("message")[0].childNodes[0].nodeValue;
                data=xmlDoc.getElementsByTagName("data")[0].childNodes[0].nodeValue;

                js_wait(false);

		if (code == "6005")
		{
	                //Antwort konnte nicht geladen werden
        	        js_message(text, 3, true);
		}
		else
		{
			ids = data.split(",");
                        let inputs = document.getElementsByTagName("input");
                        for (const input of inputs) {
                                if (input.name.substring(0, 3) == 'kat'){
					let katid = '' + input.name.substring(4, input.name.length - 1);

					if (ids.includes(katid))
					{
						input.checked = true;
					}
					else
					{
						input.checked = false;
					}
                                }
                        }
		}
        }
}
