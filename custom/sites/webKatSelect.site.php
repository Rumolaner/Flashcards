<?php

$tpl = new clsTemplate("webKatSelect", $this->user->getTemplateset());

$headpar['title'] = "lernen";
$headpar['css'][0]['a'] = "css_general";
$headpar['css'][1]['a'] = "css_overlay";
$headpar['css'][2]['a'] = "css_lernen";
$headpar['js'][0]['a'] = "js_general";
$headpar['js'][1]['a'] = "js_lernen";
$headpar['titlevalues'] = Array();
$tpl->setValue("html_head", $this->perform("modHtml_head", $headpar));

$headpar = NULL;
$headpar['title'] = "main";
$tpl->setValue("site_head", $this->perform("modSite_head", $headpar));

$footpar['site'] = "main";
$tpl->setValue("site_foot", $this->perform("modSite_foot", $footpar));
$tpl->setValue("html_foot", $this->perform("modHtml_foot"));

if (false)
{
	$tpl->setValue("msg", $this->lang->get("main", "msg1"));
}
else
{
	$tpl->setValue("msg", "");
}

$tpl->setValue("title", $this->lang->get("lernen", "title"));
$tpl->setValue("welcheKatlernen", $this->lang->get("lernen", "welcheKatlernen"));
$tpl->setValue("loadSet", $this->lang->get("lernen", "loadSet"));
$tpl->setValue("setname", $this->lang->get("lernen", "setname"));
$tpl->setValue("lernen", $this->lang->get("button", "lernen"));
$tpl->setValue("speichern", $this->lang->get("button", "speichern"));

$sets = "";
$setpar[0] = $this->user->getId();
$opt2 = $this->sql->get("SELECT DISTINCT id, name FROM benutzerset where benutzer_id = ? ORDER BY name", "i", $setpar);

if ($opt2->num_rows > 0)
{
        while($row2 = $opt2->fetch_array(MYSQLI_ASSOC))
        {
                $selpar2['id'] = $row2['id'];
                $selpar2['name'] = $row2['name'];
		$selpar2['selected'] = "";
                $sets .= $this->perform("modSelectOption", $selpar2);
        }
}
$tpl->setValue("sets", $sets);

$options = "";
$opt = $this->sql->get("SELECT kategorie.id, kategorie.name, benutzer2kategorie.kategorie_id, count(karte.id) as karten FROM kategorie left join karte on karte.kategorie_id = kategorie.id left join benutzer2kategorie on kategorie.id = benutzer2kategorie.kategorie_id where parent_id = -1 GROUP BY kategorie.id, kategorie.name, benutzer2kategorie.kategorie_id order by name");

if ($opt->num_rows > 0)
{
        while($row = $opt->fetch_array(MYSQLI_ASSOC))
        {
		$selpar['id'] = $row['id'];
		$selpar['name'] = $row['name'];
		$selpar['spaces'] = "";
		$selpar['selected'] = ($row['kategorie_id'] == ""?"":" checked");
		$selpar['ebene'] = 1;
		$selpar['karten'] = $row['karten'];
		$options .= $this->perform("modKatSelectOption", $selpar);
        }
}

$par['a'] = "appKatSelect";
$lernenlink = fcLink($par);
$tpl->setValue("lernenlink", $lernenlink);

$selpar['id'] = "-1";
$selpar['name'] = "";
$selpar['selected'] = " selected";
$tpl->setValue("options", $options);

$site = $tpl->parse();

?>
