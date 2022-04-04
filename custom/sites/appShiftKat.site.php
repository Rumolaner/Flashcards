<?php

$tpl = new clsTemplate("appShiftKat", $this->user->getTemplateset());
$retCode = "0";

$kat = $this->params->get("kat");
$parent = $this->params->get("parent");

$par[0] = substr($parent, 4);
$par[1] = substr($kat, 4);
$res = $this->sql->get("UPDATE kategorie SET parent_id = ? WHERE id = ?", "ii", $par);

if($this->sql->getAffectedRows() > 0)
{
	$retCode = "4001";
}
else
{
	$retCode = "4002";
}

$tpl->setValue("code", $retCode);
$tpl->setValue("message", $this->lang->get("message", "code".$retCode));
$tpl->setValue("kat", $kat);
$tpl->setValue("parent", $parent);

$site = $tpl->parse(); 

?>
