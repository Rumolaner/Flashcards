{tpl html_head}
{tpl site_head}

<main role="main">
<h1>{tpl title}</h1>
{tpl msg}
<div id="form">
	<form method="post" action="{tpl lernenlink}">
		<div class="textblock">{tpl welcheKatlernen}</div>
		<div id="form" class="metavalueForm_spacer">
			{tpl options}
		</div>
		<div class="metadata_spacerb">&nbsp;</div><div class="metavalueForm_spacerb"><input type="submit" name="submit" id="submit" value="{tpl lernen}" class="formfieldSubmit" onclick="submit"></div>
	</form>
</div>
</main>
{tpl site_foot}
{tpl html_foot}
