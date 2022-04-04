<?php

$tpl = new clsTemplate("modKatSelectOption", $this->user->getTemplateset());

$ebene = $params['ebene'];
$tpl->setValue("id", $params['id']);
$tpl->setValue("name", $params['name']);
$tpl->setValue("spaces", $params['spaces']);
$tpl->setValue("selected", $params['selected']);
$tpl->setValue("kartenValue", $params['karten']);

$tpl->setValue("karten", $this->lang->get("lernen", "karten"));

$par[0] = $params['id'];
$opt = $this->sql->get("SELECT kategorie.id, kategorie.name, benutzer2kategorie.kategorie_id, count(karte.id) as karten FROM kategorie left join karte on karte.kategorie_id = kategorie.id left join benutzer2kategorie on kategorie.id = benutzer2kategorie.kategorie_id where kategorie.parent_id = ? GROUP BY kategorie.id, kategorie.name, benutzer2kategorie.kategorie_id order by name", "i", $par);

$options = "";
if ($opt->num_rows > 0)
{
        while($row = $opt->fetch_array(MYSQLI_ASSOC))
        {
			$spaces = "";

            for ($i = 0; $i < $ebene; $i++)
                $spaces .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

            $selpar['id'] = $row['id'];
			$selpar['name'] = $row['name'];
			$selpar['selected'] = ($row['kategorie_id'] == ""?"":" checked");
			$selpar['spaces'] = $spaces;
			$selpar['karten'] = $row['karten'];
			$selpar['ebene'] = $ebene + 1;
			$options .= $this->perform("modKatSelectOption", $selpar);
        }
}

$tpl->setValue("options", $options);
$site = $tpl->parse();

?>
