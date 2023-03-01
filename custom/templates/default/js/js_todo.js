function delete_send(data)
{
	var params = "a=appDeleteItem&item="+data;
	ajax_load(delete_receive, params);
}

function delete_receive()
{
	if (this.readyState === 4 && this.status === 200) 
	{
		var parser = new DOMParser();
		var xmlDoc = parser.parseFromString(this.responseText, "application/xml");
		code=xmlDoc.getElementsByTagName("code")[0].childNodes[0].nodeValue;
		text=xmlDoc.getElementsByTagName("message")[0].childNodes[0].nodeValue;
		data=xmlDoc.getElementsByTagName("data")[0].childNodes[0].nodeValue;

		js_wait(false);

		if (code == 4007)
		{
			//Kategorie wurde gelöscht
			js_message(text, 3, true);
			var element = document.getElementById(data)
			element.parentNode.removeChild(element)
		}
		else if (code == 4010)
		{
			//Frage wurde gelöscht
			js_message(text, 3, true);

			var element = document.getElementById("karte" + data.substring(3))
			element.parentNode.removeChild(element)
		}
		else if(code == 4008)
		{
			//Kategorie konnte nicht gelöscht werden
			js_message(text, 3, true);
		}
		else if(code == 4009)
		{
			//Ein Fehler ist aufgetreten
			js_message(text, 3, true);
		}
		else if(code == 4011)
		{
			//Frage konnte nicht gelöscht werden
			js_message(text, 3, true);
		}
	}
}

function saveFrage(quelle)
{
	let id = quelle.id.substring(3);
	let frage = document.getElementById("frage"+id).value;
	let hinweis = document.getElementById("hinweis"+id).value;
	let antwort = document.getElementById("antwort"+id).value;
	let todo = document.getElementById("todo"+id).checked;

	frage = frage.replaceAll("&", "%26");
	hinweis = hinweis.replaceAll("&", "%26");
	antwort = antwort.replaceAll("&", "%26");
	frage = frage.replaceAll("\"", "%22");
	hinweis = hinweis.replaceAll("\"", "%22");
	antwort = antwort.replaceAll("\"", "%22");

	if (frage.length <= 0)
	{
		alert("Bitte eine Frage eingeben!");
	}
	else
	{
		var params = "a=appSaveFrage&id="+id+"&frage="+frage+"&hinweis="+hinweis+"&antwort="+antwort+"&todo="+todo;
		ajax_load(saveFrage_receive, params);
	}
}

function saveFrage_receive()
{
	if (this.readyState === 4 && this.status === 200) 
	{
		var parser = new DOMParser();
		var xmlDoc = parser.parseFromString(this.responseText, "application/xml");
		code=xmlDoc.getElementsByTagName("code")[0].childNodes[0].nodeValue;
		text=xmlDoc.getElementsByTagName("message")[0].childNodes[0].nodeValue;
		action=xmlDoc.getElementsByTagName("action")[0].childNodes[0].nodeValue;
		id=xmlDoc.getElementsByTagName("id")[0].childNodes[0].nodeValue;

		js_wait(false);

		if (code == 4014)
		{
			//Gespeichert
			js_message(text, 3, true);

			document.getElementById("status" + id).innerHTML = "";
            if (!document.getElementById("todo" + id).checked)
            {
                let karte = document.getElementById("karte" + id);
                document.getElementById("karte" + id).parentNode.removeChild(karte)
            }
		}
		else if(code == 4015)
		{
			//Nicht gespeichert
			js_message(text, 3, true);
		}
	}
}

function changedStat(obj)
{
	let id = obj.id

	if (id.substring(0, 5) == "frage")
		id = id.substring(5)
	else if (id.substring(0, 7) == "hinweis")
		id = id.substring(7)
	else if (id.substring(0, 7) == "antwort")
		id = id.substring(7)
	else if (id.substring(0, 4) == "todo")
		id = id.substring(4)

	let stat = document.getElementById("status" + id)
	stat.innerHTML = "**geändert**"
}

function deleteFrage(obj)
{
	let id = obj.id
	
	if (confirm	("Bist du sicher dass du die Frage löschen willst?"))
	{
		delete_send(id);
	}
}

function checkChanged()
{
	let res = false;
	let status = document.getElementsByClassName("status")
	
	for (i = 0; i < status.length; i++)
	{
		if (status[i].innerHTML != "" && status[i].id != "status-1")
			res = true;
	}

	return res;
}