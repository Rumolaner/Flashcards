{tpl html_head}
{tpl site_head}

<main role="main">
<h1 id="title">{tpl title}</h1>
<section id="main">
	<section id="karten">
		<div class="metadata_spacer" id="aktKatdesc">{tpl aktkat}</div>
		<div class="metadata_spacer" id="aktKat">{tpl keine}</div>
		<div id="aktKatId" style="display: none"></div>
		<div class="metadata_spacer" id="entries">
			<div id="karte-1" style="" class="karte">
				<div id="status-1" class="status"></div>
				<label for="frage-1">{tpl neueFrage}:</label>
				<textarea id="frage-1" class="textbox" onChange="changedStat(this)"></textarea>
				<label for="hinweis-1">{tpl hinweis}:</label>
				<textarea id="hinweis-1" class="textbox" onChange="changedStat(this)"></textarea>
				<label for="antwort-1">{tpl antwort}:</label>
				<textarea id="antwort-1" class="textbox" onChange="changedStat(this)"></textarea>
				<button id="btn-1" onCLick="saveFrage(this)" class="btnsave">{tpl speichern}</button> <input class="todo" type="checkbox" id="todo-1"><label for="todo-1">{tpl todo}</label>
			</div>
		</div>
		<div style="clear:both;"></div>
	</section>
	<section id="kattree">
		<div id="newKat">
			<label class="metadata_spacer" for="newKatName">{tpl newkat}</label><div class="metavalueForm_spacer"><input name="newKatName" id="newKatName" class="formfield"></div>
			<div class="metadata_spacerb">&nbsp;</div><div class="metavalueForm_spacerb"><input type="button" name="submit" id="submit" value="{tpl submit}" class="formfieldSubmit" onclick="newKat_send()"></div>
		</div>
		<div id="titlectrl">
			<img id="trashbin" class="titlectrl" src="pic.php?pic=trashbin.png" ondrop="droptrash(event)" ondragover="allowDrop(event)" alt="{tpl alt}">
			<img id="edit" class="titlectrl" src="pic.php?pic=edit.jpeg" ondrop="droptrash(event)" ondragover="allowDrop(event)" alt="{tpl alt}">
			<img id="open" class="titlectrl" src="pic.php?pic=openfolder.png" ondrop="droptrash(event)" ondragover="allowDrop(event)" alt="{tpl alt}">
		</div>
		<div id="kat-1" ondrop="drop(event)" ondragover="allowDrop(event)">Root
		<ul id="ulkat-1">
		{tpl kategorien}
		</ul>
	</section>
</section>
</main>
{tpl site_foot}
{tpl html_foot}
