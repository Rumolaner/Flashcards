<?php 

$tpl = new clsTemplate("webKategorien", $this->user->getTemplateset());

$headpar['title'] = "main";
$headpar['css'][0]['a'] = "css_general";
$headpar['css'][1]['a'] = "css_overlay";
$headpar['css'][2]['a'] = "css_kategorie";
$headpar['js'][0]['a'] = "js_general";
$headpar['js'][1]['a'] = "js_kategorien";
$headpar['titlevalues'] = Array();
$tpl->setValue("html_head", $this->perform("modHtml_head", $headpar));

$headpar = NULL;
$headpar['title'] = "kategorien";
$tpl->setValue("site_head", $this->perform("modSite_head", $headpar));

$footpar['site'] = "kategorien";
$tpl->setValue("site_foot", $this->perform("modSite_foot", $footpar));
$tpl->setValue("html_foot", $this->perform("modHtml_foot"));

if (false)
{
	$tpl->setValue("msg", $this->lang->get("main", "msg"));
}
else
{
	$tpl->setValue("msg", "");
}

$titpar['name'] = $this->user->getName();
$tpl->setValue("title", $this->lang->get("kategorien", "title"));

$tpl->setValue("alt", $this->lang->get("kategorien", "alt"));
$tpl->setValue("newkat", $this->lang->get("kategorien", "newkat"));
$tpl->setValue("submit", $this->lang->get("button", "submit"));
$tpl->setValue("openkat", $this->lang->get("kategorien", "openkat"));
$tpl->setValue("aktkat", $this->lang->get("kategorien", "aktuellekat"));
$tpl->setValue("keine", $this->lang->get("kategorien", "keine"));
$tpl->setValue("speichern", $this->lang->get("button", "speichern"));
$tpl->setValue("neueFrage", $this->lang->get("kategorien", "neueFrage"));
$tpl->setValue("hinweis", $this->lang->get("kategorien", "hinweis"));
$tpl->setValue("antwort", $this->lang->get("kategorien", "antwort"));
$tpl->setValue("todo", $this->lang->get("kategorien", "todo"));

$res = $this->sql->get("SELECT id FROM kategorie WHERE parent_id IN (-1, 0)");

$kat = "";
if ($res->num_rows > 0)
{
	while($row = $res->fetch_array(MYSQLI_ASSOC))
	{
		$katpar['kat'] = new clsKategorien($this->sql, $row['id']);
		$kat .= $this->perform("modKat_list", $katpar);
	}
}

$tpl->setValue("kategorien", $kat);

$site = $tpl->parse();

?>
