<?php

$tpl = new clsTemplate("appNewKat", $this->user->getTemplateset());
$retCode = "0";

$kat = $this->params->get("kat");

$par[0] = $kat;
$par[1] = $this->user->getID();
$res = $this->sql->insert("INSERT INTO kategorie (name, benutzer_id) VALUES (?, ?)", "si", $par);

if ($res <> -1)
{
    $retCode = 4003;
}
else
{
	$retCode = "4004";
}

$tpl->setValue("code", $retCode);
$tpl->setValue("message", $this->lang->get("message", "code".$retCode));
$tpl->setValue("item", $res);
$tpl->setValue("name", $kat);

$site = $tpl->parse(); 

?>
