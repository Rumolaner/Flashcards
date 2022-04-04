{tpl html_head}
{tpl site_head}

<main role="main">
<h1>{tpl title}</h1>
{tpl msg}
<div id="form">
	<form>
		<div class="metadata_spacer">{tpl loginname}</div><div class="metavalueForm_spacer"><select name="login" id="login" class="formfield">{tpl options}</select></div>
		<div class="metadata_spacerb">&nbsp;</div><div class="metavalueForm_spacerb"><input type="button" name="submit" id="submit" value="{tpl login}" class="formfieldSubmit" onclick="login_send()"></div>
	</form>
</div>
</main>
{tpl site_foot}
{tpl html_foot}
