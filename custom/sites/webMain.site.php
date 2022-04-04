<?php

$tpl = new clsTemplate("webMain", $this->user->getTemplateset());

$headpar['title'] = "main";
$headpar['css'][0]['a'] = "css_general";
$headpar['css'][1]['a'] = "css_main";
$headpar['css'][2]['a'] = "css_lernen";
$headpar['js'][0]['a'] = "js_general";
$headpar['titlevalues'] = Array();
$tpl->setValue("html_head", $this->perform("modHtml_head", $headpar));

$headpar = NULL;
$headpar['title'] = "main";
$headpar['linkpar'] = "";
$tpl->setValue("site_head", $this->perform("modSite_head", $headpar));

$footpar['site'] = "main";
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
$tpl->setValue("statistiken", $this->lang->get("main", "statistiken"));
$tpl->setValue("karten", $this->lang->get("main", "karten"));
$tpl->setValue("inkategorien", $this->lang->get("main", "inkategorien"));
$tpl->setValue("offene", $this->lang->get("main", "offen"));
$tpl->setValue("offeneMorgen", $this->lang->get("main", "offenMorgen"));
$tpl->setValue("offeneUebermorgen", $this->lang->get("main", "offenUebermorgen"));
$tpl->setValue("gewusst", $this->lang->get("main", "gewusst"));
$tpl->setValue("nichtgewusst", $this->lang->get("main", "nichtgewusst"));
$tpl->setValue("todo", $this->lang->get("main", "todo"));

$kartenValue = "";
$inkategorienValue = "";
$gewusstValue = "";
$nichtgewusstValue = "";
$res = $this->sql->get("SELECT COUNT(id) as anzahl FROM karte");
if ($res->num_rows > 0)
{
    while($row = $res->fetch_array(MYSQLI_ASSOC))
    {
		$kartenValue = $row['anzahl'];
	}
}

$res = $this->sql->get("SELECT COUNT(id) as anzahl FROM kategorie");
if ($res->num_rows > 0)
{
    while($row = $res->fetch_array(MYSQLI_ASSOC))
    {
		$inkategorienValue = $row['anzahl'];
	}
}

$pars[0] = $this->user->getId();
$res = $this->sql->get("SELECT COUNT(karte.id) as anzahl FROM benutzer2kategorie inner join kategorie on benutzer2kategorie.kategorie_id = kategorie.id inner join karte on kategorie.id = karte.kategorie_id left join benutzer2karte on benutzer2karte.karte_id = karte.id and benutzer2karte.benutzer_id = benutzer2kategorie.benutzer_id where benutzer2kategorie.benutzer_id = ? and (benutzer2karte.karte_id is null or convert(DATE_ADD(benutzer2karte.datum, INTERVAL benutzer2karte.fortschritt DAY), date) <= CURDATE())", "i", $pars);
if ($res->num_rows > 0)
{
    while($row = $res->fetch_array(MYSQLI_ASSOC))
    {
		$offenValue = $row['anzahl'];
	}
}

$pars[0] = $this->user->getId();
$res = $this->sql->get("SELECT COUNT(karte.id) as anzahl FROM benutzer2kategorie inner join kategorie on benutzer2kategorie.kategorie_id = kategorie.id inner join karte on kategorie.id = karte.kategorie_id left join benutzer2karte on benutzer2karte.karte_id = karte.id and benutzer2karte.benutzer_id = benutzer2kategorie.benutzer_id where benutzer2kategorie.benutzer_id = ? and (benutzer2karte.karte_id is null or convert(DATE_ADD(benutzer2karte.datum, INTERVAL benutzer2karte.fortschritt DAY), date) <= DATE_ADD(CURDATE(), INTERVAL 1 DAY))", "i", $pars);
if ($res->num_rows > 0)
{
    while($row = $res->fetch_array(MYSQLI_ASSOC))
    {
		$offenMorgenValue = $row['anzahl'];
	}
}

$pars[0] = $this->user->getId();
$res = $this->sql->get("SELECT COUNT(karte.id) as anzahl FROM benutzer2kategorie inner join kategorie on benutzer2kategorie.kategorie_id = kategorie.id inner join karte on kategorie.id = karte.kategorie_id left join benutzer2karte on benutzer2karte.karte_id = karte.id and benutzer2karte.benutzer_id = benutzer2kategorie.benutzer_id where benutzer2kategorie.benutzer_id = ? and (benutzer2karte.karte_id is null or convert(DATE_ADD(benutzer2karte.datum, INTERVAL benutzer2karte.fortschritt DAY), date) <= DATE_ADD(CURDATE(), INTERVAL 2 DAY))", "i", $pars);
if ($res->num_rows > 0)
{
    while($row = $res->fetch_array(MYSQLI_ASSOC))
    {
		$offenUebermorgenValue = $row['anzahl'];
	}
}

$pars[0] = $this->user->getId();
$res = $this->sql->get("SELECT COUNT(benutzer_id) as anzahl FROM benutzer2karte where benutzer_id = ? and convert(datum, date) = CURDATE() and gewusst = 1", "i", $pars);
if ($res->num_rows > 0)
{
    while($row = $res->fetch_array(MYSQLI_ASSOC))
    {
		$gewusstValue = $row['anzahl'];
	}
}

$pars[0] = $this->user->getId();
$res = $this->sql->get("SELECT COUNT(benutzer_id) as anzahl FROM benutzer2karte where benutzer_id = ? and convert(datum, date) = CURDATE() and gewusst = 0", "i", $pars);
if ($res->num_rows > 0)
{
    while($row = $res->fetch_array(MYSQLI_ASSOC))
    {
		$nichtgewusstValue = $row['anzahl'];
	}
}

$res = $this->sql->get("SELECT COUNT(id) as anzahl FROM karte where todo = 1");
if ($res->num_rows > 0)
{
    while($row = $res->fetch_array(MYSQLI_ASSOC))
    {
		$todoValue = $row['anzahl'];
	}
}

$tpl->setValue("kartenValue", $kartenValue);
$tpl->setValue("inkategorienValue", $inkategorienValue);
$tpl->setValue("offeneValue", $offenValue);
$tpl->setValue("offeneMorgenValue", $offenMorgenValue);
$tpl->setValue("offeneUebermorgenValue", $offenUebermorgenValue);
$tpl->setValue("gewusstValue", $gewusstValue);
$tpl->setValue("nichtgewusstValue", $nichtgewusstValue);
$tpl->setValue("todoValue", $todoValue);

$headRow = "<tr><th></th>";
$sumRow = "<tr><th>".$this->lang->get("lernen", "karten")."</th>";
$todoRow = "<tr><th>".$this->lang->get("lernen", "zulernen")."</th>";
$gewusstRow = "<tr><th>".$this->lang->get("lernen", "gewusst")."</th>";
$nichtgewusstRow = "<tr><th>".$this->lang->get("lernen", "nichtgewusst")."</th>";

$pars[0] = $this->user->getId();
$res2 = $this->sql->get("SELECT benutzer2karte.fortschritt, count(karte.id) as anzahl, count(IF ((benutzer2karte.karte_id is null or convert(DATE_ADD(benutzer2karte.datum, INTERVAL benutzer2karte.fortschritt DAY), date) <= CURDATE()), karte.id, null)) as todo, count(IF(convert(benutzer2karte.datum, date)  = CURDATE() and benutzer2karte.gewusst = 1, karte.id, null)) as gewusst, count(IF(convert(benutzer2karte.datum, date)  = CURDATE() and benutzer2karte.gewusst = 0, karte.id, null)) as nichtgewusst FROM kategorie inner join karte on kategorie.id = karte.kategorie_id LEFT JOIN benutzer2karte on karte.id = benutzer2karte.karte_id and benutzer2karte.benutzer_id = ? GROUP BY benutzer2karte.fortschritt ORDER BY benutzer2karte.fortschritt", "i", $pars);

if ($res2->num_rows > 0)
{
    while($row2 = $res2->fetch_array(MYSQLI_ASSOC))
    {
		$headRow .= "<th>".($row2['fortschritt'] == null?$this->lang->get("main", "neu"):$row2['fortschritt'])."</th>";
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


$titpar['name'] = $this->user->getName();
if ($this->user->getID() < 1)
	$tpl->setValue("title", $this->lang->get("main", "title"));
else
	$tpl->setValue("title", $this->lang->get("main", "titleuser", $titpar));

$site = $tpl->parse();

?>
