<?php

$tpl = new clsTemplate("webLernen", $this->user->getTemplateset());

$headpar['title'] = "lernen";
$headpar['css'][0]['a'] = "css_general";
$headpar['css'][1]['a'] = "css_overlay";
$headpar['css'][2]['a'] = "css_lernen";
$headpar['js'][0]['a'] = "js_general";
$headpar['js'][1]['a'] = "js_lernen";
$headpar['titlevalues'] = Array();
$tpl->setValue("html_head", $this->perform("modHtml_head", $headpar));

$headpar = NULL;
$headpar['title'] = "lernen";
$tpl->setValue("site_head", $this->perform("modSite_head", $headpar));

$footpar['site'] = "lernen";
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
$tpl->setValue("fortschritt", $this->lang->get("lernen", "fortschritt"));
$tpl->setValue("kategorie", $this->lang->get("lernen", "kategorie"));
$tpl->setValue("lernen", $this->lang->get("button", "lernen"));
$tpl->setValue("hinweis", $this->lang->get("button", "hinweis"));
$tpl->setValue("anzeigen", $this->lang->get("button", "anzeigen"));
$tpl->setValue("nichtgewusst", $this->lang->get("button", "nichtgewusst"));
$tpl->setValue("gewusst", $this->lang->get("button", "gewusst"));
$tpl->setValue("todo", $this->lang->get("button", "todo"));

$pars[0] = $this->user->getId();
$pars[1] = $this->user->getId();
$res = $this->sql->get("SELECT karte.id, karte.frage, karte.hinweis, karte.antwort, benutzer2karte.fortschritt, karte.kategorie_id 
						FROM benutzer2kategorie inner join kategorie on benutzer2kategorie.kategorie_id = kategorie.id
						inner join karte on kategorie.id = karte.kategorie_id 
						LEFT JOIN benutzer2karte on karte.id = benutzer2karte.karte_id and benutzer2karte.benutzer_id = ? 
						where benutzer2kategorie.benutzer_id = ? and (benutzer2karte.karte_id is null or convert(DATE_ADD(benutzer2karte.datum, INTERVAL benutzer2karte.fortschritt DAY), date) <= CURDATE()) order by rand() LIMIT 1", "ii", $pars);
if ($res->num_rows > 0)
{
    while($row = $res->fetch_array(MYSQLI_ASSOC))
    {
		$tpl->setValue("id", $row['id']);
		$tpl->setValue("fortschrittValue", ($row['fortschritt'] == null?$this->lang->get("lernen", "neu"):$row['fortschritt']));
		$tpl->setValue("question", nl2br($row['frage']));
		$tpl->setValue("hint", $row['hinweis']);
		$tpl->setValue("answer", $row['antwort']);
		$tpl->setValue("oDisplay", "none");		
		$tpl->setValue("breadcrumb", fcCustBreadcrumb($this->sql, $row['kategorie_id']));
    }
}
else
{
	$tpl->setValue("oDisplay", "block");
	$tpl->setValue("question", "");
	$tpl->setValue("breadcrumb", "");
	$tpl->setValue("fortschrittValue", "");
}

$headRow = "<tr><th></th>";
$sumRow = "<tr><th>".$this->lang->get("lernen", "karten")."</th>";
$todoRow = "<tr><th>".$this->lang->get("lernen", "zulernen")."</th>";
$gewusstRow = "<tr><th>".$this->lang->get("lernen", "gewusst")."</th>";
$nichtgewusstRow = "<tr><th>".$this->lang->get("lernen", "nichtgewusst")."</th>";
$res2 = $this->sql->get("SELECT benutzer2karte.fortschritt, count(karte.id) as anzahl, count(IF ((benutzer2karte.karte_id is null or convert(DATE_ADD(benutzer2karte.datum, INTERVAL benutzer2karte.fortschritt DAY), date) <= CURDATE()), karte.id, null)) as todo, count(IF(convert(benutzer2karte.datum, date)  = CURDATE() and benutzer2karte.gewusst = 1, karte.id, null)) as gewusst, count(IF(convert(benutzer2karte.datum, date)  = CURDATE() and benutzer2karte.gewusst = 0, karte.id, null)) as nichtgewusst FROM benutzer2kategorie inner join kategorie on benutzer2kategorie.kategorie_id = kategorie.id inner join karte on kategorie.id = karte.kategorie_id LEFT JOIN benutzer2karte on karte.id = benutzer2karte.karte_id and benutzer2karte.benutzer_id = ? where benutzer2kategorie.benutzer_id = ? GROUP BY benutzer2karte.fortschritt ORDER BY benutzer2karte.fortschritt", "ii", $pars);

if ($res2->num_rows > 0)
{
    while($row2 = $res2->fetch_array(MYSQLI_ASSOC))
    {
		$headRow .= "<th>".($row2['fortschritt'] == null?$this->lang->get("lernen", "neu"):$row2['fortschritt'])."</th>";
		$sumRow .= "<td>".$row2['anzahl']."</td>";
		$todoRow .= "<td>".$row2['todo']."</td>";
		$gewusstRow .= "<td>".$row2['gewusst']."</td>";
		$nichtgewusstRow .= "<td>".$row2['nichtgewusst']."</td>";
    }
}

$headRow .= "</tr>";
$sumRow .= "</tr>";
$todoRow .= "</tr>";
$gewusstRow .= "</tr>";
$nichtgewusstRow .= "</tr>";

$tpl->setValue("statistik", $headRow.$sumRow.$todoRow.$gewusstRow.$nichtgewusstRow);


$site = $tpl->parse();

?>
