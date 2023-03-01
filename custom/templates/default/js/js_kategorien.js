function allowDrop(ev) 
{
  ev.preventDefault();
}
  
function drag(ev) 
{
  ev.dataTransfer.setData("text", ev.target.id);
}
  
function droptrash(ev) 
{
  ev.preventDefault();

  var data = ev.dataTransfer.getData("text");
  if (data.substring(0, 4) == "item")
	var type = "Kategorie";
  else if (data.substring(0, 5) == "frage")
	var type = "Frage";

  var name = document.getElementById(data);

  if (ev.target.id == "trashbin")
  {	
	  if (type == "Kategorie")
	  {
  	    if (confirm("Bist Du sicher dass du die " + type + " \"" + name.innerHTML.split("\n")[0] + "\" mit allen Unterkategorien und darin enthaltenen Fragen löschen willst?"))
	    {
		  delete_send(data);
	    }
	  }
	  else
	  {
		if (confirm("Bist Du sicher dass du die " + type + " \"" + name.innerHTML.split("\n")[0] + "\" löschen willst?"))
	    {
		  delete_send(data);
	    }
	  }
  }
  else if (ev.target.id == 'edit' && type == 'Kategorie')
  {	
	if (name = prompt("Bitte einen neuen Namen für die Kategorie \"" + name.innerHTML.split("\n")[0] + "\" eingeben", name.innerHTML.split("\n")[0]))
	{
      editKat_send(data, name);
	}
  }
  else if (ev.target.id == 'open' && type == 'Kategorie')
  {	
	loadFragen_send(data)
  }
}

function editKat_send(data, name)
{
	var params = "a=appEditKat&kat="+data+"&name="+name.replace("&", "%26");;
	ajax_load(editKat_receive, params);
}

function editKat_receive()
{
	if (this.readyState === 4 && this.status === 200) 
	{
		var parser = new DOMParser();
		var xmlDoc = parser.parseFromString(this.responseText, "application/xml");
		code=xmlDoc.getElementsByTagName("code")[0].childNodes[0].nodeValue;
		text=xmlDoc.getElementsByTagName("message")[0].childNodes[0].nodeValue;
		data=xmlDoc.getElementsByTagName("data")[0].childNodes[0].nodeValue;
		name=xmlDoc.getElementsByTagName("name")[0].childNodes[0].nodeValue;

		js_wait(false);

		if (code == 4013)
		{
			//Kategorie wurde gelöscht
			js_message(text, 3, true);
			var element = document.getElementById(data)
			let old = element.innerHTML;
			element.innerHTML = old.replace(old.split("\n")[0], name)
		}
		else if(code == 4012)
		{
			//Kategorie konnte nicht geändert werden
			js_message(text, 3, true);
		}
		else if(code == 4009)
		{
			//Ein Fehler ist aufgetreten
			js_message(text, 3, true);
		}
	}
}

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

function drop(ev) 
{
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");

  if (ev.target.id == "dropKat")
	loadFragen_send(data)
  else if (data != ev.target.id)
    shiftKat_send(data, ev.target.id);
}

function saveFrage(quelle)
{
	let kat = document.getElementById("aktKatId").innerHTML;
	
	if (kat == "")
	{
		alert("Bitte erst eine Kategorie öffnen!")
	}
	else
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
			var params = "a=appSaveFrage&kat="+kat+"&id="+id+"&frage="+frage+"&hinweis="+hinweis+"&antwort="+antwort+"&todo="+todo;
			ajax_load(saveFrage_receive, params);
		}
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

			if (action == "insert")
			{
				let frage = document.getElementById("frage-1").value;
				let hinweis = document.getElementById("hinweis-1").value;
				let antwort = document.getElementById("antwort-1").value;
				let todo = document.getElementById("todo-1").value;
				let karten = document.getElementById("entries");

				let newDiv = addQuestion(id, frage, hinweis, antwort, todo)
				karten.appendChild(newDiv)

				document.getElementById("frage-1").value = "";
				document.getElementById("hinweis-1").value = "";
				document.getElementById("antwort-1").value = "";
				document.getElementById("status-1").innerHTML = "";
				document.getElementById("todo-1").checked = false;
			}
			else
			{
				document.getElementById("status" + id).innerHTML = "";
			}
		}
		else if(code == 4015)
		{
			//Nicht gespeichert
			js_message(text, 3, true);
		}
	}
}

function addQuestion(id, frage, hinweis, antwort, todo)
{
	let mainDiv = document.createElement("div")
	mainDiv.className = "karte"
	mainDiv.id = "karte" + id

	let divStatus = document.createElement("div");
	divStatus.id = "status" + id;
	divStatus.className = "status"
	mainDiv.appendChild(divStatus)

	let lblFrage = document.createElement("label")
	lblFrage.innerHTML = "Frage:";
	lblFrage.htmlFor = "frage" + id;
	mainDiv.appendChild(lblFrage)

	let txtFrage = document.createElement("textarea");
	txtFrage.onchange = function() {changedStat(this)}
	txtFrage.id = "frage" + id;
	txtFrage.className = "textbox";
	txtFrage.value = frage;
	mainDiv.appendChild(txtFrage)

	let lblHinweis = document.createElement("label")
	lblHinweis.innerHTML = "Hinweis:";
	lblHinweis.htmlFor = "hinweis" + id;
	mainDiv.appendChild(lblHinweis)

	let txtHinweis = document.createElement("textarea");
	txtHinweis.onchange = function() {changedStat(this)}
	txtHinweis.id = "hinweis" + id;
	txtHinweis.className = "textbox";
	txtHinweis.value = hinweis;
	mainDiv.appendChild(txtHinweis)

	let lblAntwort = document.createElement("label")
	lblAntwort.innerHTML = "Antwort:";
	lblAntwort.htmlFor = "antwort" + id;
	mainDiv.appendChild(lblAntwort)

	let txtAntwort = document.createElement("textarea");
	txtAntwort.onchange = function() {changedStat(this)}
	txtAntwort.id = "antwort" + id;
	txtAntwort.className = "textbox";
	txtAntwort.value = antwort;
	mainDiv.appendChild(txtAntwort)

	let btn = document.createElement("button")
	btn.id = "btn" + id
	btn.onclick = function(btn) {saveFrage(this)}
	btn.innerHTML = "Speichern"
	btn.className = "btnsave"
	mainDiv.appendChild(btn)

	btn = document.createElement("button")
	btn.id = "del" + id
	btn.onclick = function(btn) {deleteFrage(this)}
	btn.innerHTML = "Löschen"
	btn.className = "btndel"
	mainDiv.appendChild(btn)

	let chk = document.createElement("input")
	chk.id = "todo" + id
	chk.type = "checkbox"
	chk.name = "todo" + id
	chk.checked = todo;
	chk.onchange = function() {changedStat(this)}
	mainDiv.appendChild(chk)

	let lblChk = document.createElement("label")
	lblChk.innerHTML = "ToDo (Diese Frage ist noch zu bearbeiten)";
	lblChk.htmlFor = "todo" + id;
	mainDiv.appendChild(lblChk)


	return mainDiv
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

function loadFragen_send(kat)
{
	var params = "a=appLoadFragen&kat="+kat;
	ajax_load(loadFragen_receive, params);
}

function loadFragen_receive()
{
	if (this.readyState === 4 && this.status === 200) 
	{
		let answer = JSON.parse(this.responseText);
		let code = answer["code"]
		let text = answer["message"]
		let kat = answer["kat"]
		let katid = answer["katid"]
		let fragen = answer["fragen"]

		js_wait(false);

		if (code == 4006)
		{
			label = document.getElementById("aktKat");
			label.innerHTML = kat;
			label = document.getElementById("aktKatId");
			label.innerHTML = katid;
			
			removeQuestions();
			if (fragen != "")
			{
				let karten = document.getElementById("entries");
				for (i = 0; i < fragen.length; i++)
				{
					let newDiv = addQuestion(fragen[i].id, fragen[i].frage, fragen[i].hinweis, fragen[i].antwort, fragen[i].todo);
					karten.appendChild(newDiv)
				}
			}
		}
		else if(code == 4005)
		{
			js_message(text, 3, true);
		}
	}
}

function removeQuestions()
{
	if (checkChanged())
	{
		let text = "Es gibt noch ungespeicherte Änderungen. Diese werden verloren gehen.\nFortfahren?"
		if (!confirm(text))
		{
			return;
		}
	}

	let karten = document.getElementsByClassName("karte")
	for (i = 0; i < karten.length; i++)
	{
		if (karten[i].id != "karte-1")
		{
			karten[i].parentElement.removeChild(karten[i]);
			i--;
		}
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

function shiftKat_send(kat, parent)
{
  var params = "a=appShiftKat&kat="+kat+"&parent="+parent;
  ajax_load(shiftKat_receive, params);
}

function shiftKat_receive()
{
	if (this.readyState === 4 && this.status === 200) 
	{
		var parser = new DOMParser();
		var xmlDoc = parser.parseFromString(this.responseText, "application/xml");
		code=xmlDoc.getElementsByTagName("code")[0].childNodes[0].nodeValue;
		text=xmlDoc.getElementsByTagName("message")[0].childNodes[0].nodeValue;
		kat=xmlDoc.getElementsByTagName("kat")[0].childNodes[0].nodeValue;
		parent=xmlDoc.getElementsByTagName("parent")[0].childNodes[0].nodeValue;

	    js_wait(false);

	    if (code == 4001)
		{
      		//Kat erfolgreich verschoben
      		var ev = document.getElementById(parent);
      		var ul = document.getElementById("ul" + parent);
      		if (ul == null)
      		{
        		var ul = document.createElement('ul');
        		ul.setAttribute('id','ul' + parent);
        		ev.appendChild(ul);
      		}
    
      		ul.appendChild(document.getElementById(kat));
		}
	}
}

function newKat_send()
{
  if (document.getElementById('newKatName').value != "")
  {
    var params = "a=appNewKat&kat="+document.getElementById('newKatName').value.replace("&", "%26");;
    document.getElementById('newKatName').value = "";
    ajax_load(newKat_receive, params);
  }
  else
  {
	js_message("Bitte einen Kategorienamen eingeben", 3, true);  
  }
}

function newKat_receive()
{
	if (this.readyState === 4 && this.status === 200) 
	{
		var parser = new DOMParser();
		var xmlDoc = parser.parseFromString(this.responseText, "application/xml");
		code=xmlDoc.getElementsByTagName("code")[0].childNodes[0].nodeValue;
		text=xmlDoc.getElementsByTagName("message")[0].childNodes[0].nodeValue;
		item=xmlDoc.getElementsByTagName("item")[0].childNodes[0].nodeValue;
		name=xmlDoc.getElementsByTagName("name")[0].childNodes[0].nodeValue;

		js_wait(false);
		js_message(text, 3, true);

		if (code == 4003)
		{
      		//Neue Kat unter root anlegen
      		var li = document.createElement('li');
			li.setAttribute('id','item' + item);
			li.setAttribute('draggable','true');
			li.setAttribute('ondragstart','drag(event)');
			li.setAttribute('ondrop','drop(event)');
			li.setAttribute('ondragover','allowDrop(event)');
			li.innerHTML = name + "\n";

			var ul = document.createElement('ul');
			ul.setAttribute('id','ul' + item);
			li.appendChild(ul);

			ev = document.getElementById("ulkat-1")
			ev.appendChild(li);
		}
	}
}

