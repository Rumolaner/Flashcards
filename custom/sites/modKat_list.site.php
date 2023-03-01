<?php

$tpl = new clsTemplate("modKat_list", $this->user->getTemplateset());

$kat = $params['kat'];
$tpl->setValue("id", $kat->getId());
$tpl->setValue("name", $kat->getName());

$children = $kat->getChildren();

$kids = "";

if (!is_array($children))
    $children = Array();

foreach($children as $child)
{
    $katpar['kat'] = $child;
    $kids .= $this->perform("modKat_list", $katpar);
}
$tpl->setValue("childs", $kids);

$site = $tpl->parse();

?>
