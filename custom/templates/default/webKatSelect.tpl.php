{tpl html_head}
{tpl site_head}

<main role="main">
<h1>{tpl title}</h1>
{tpl msg}
<div id="form">
        <div class="textblock">{tpl welcheKatlernen}</div>
        <div id="form2" class="metavalueForm_spacer">
                <div class="">{tpl loadSet} <select id="benutzerset" onChange="loadSet_send()"><option value="">--- keine ---</option>{tpl sets}</select></div>
                <div class="">{tpl setname} <input type="text" id="setname"> <button class="formfieldSubmit" id="saveSet" onClick="saveSet_send()">{tpl speichern}</div>
        </div><br>
	<form method="post" action="{tpl lernenlink}">
		<div id="form" class="metavalueForm_spacer">
			{tpl options}
		</div>
		<div class="metadata_spacerb">&nbsp;</div><div class="metavalueForm_spacerb"><input type="submit" name="submit" id="submit" value="{tpl lernen}" class="formfieldSubmit" onclick="submit"></div>
	</form>
</div>
</main>
{tpl site_foot}
{tpl html_foot}
