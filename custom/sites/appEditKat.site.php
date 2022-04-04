<?php

$tpl = new clsTemplate("appEditKat", $this->user->getTemplateset());
$retCode = "0";

$name = $this->params->get("name");
$kat = $this->params->get("kat");
if (substr($kat, 0, 4) == "item")
{
    $par[0] = $name;
    $par[1] = substr($kat, 4);
    $res = $this->sql->get("UPDATE kategorie set name = ? WHERE id = ?", "si", $par);

    if($this->sql->getAffectedRows() > 0)
    {
        $retCode = "4013";
    }
    else
    {
        $retCode = "4012";
    }
}
else
{
    $retCode = "4009";
}

$tpl->setValue("code", $retCode);
$tpl->setValue("message", $this->lang->get("message", "code".$retCode));
$tpl->setValue("data", $kat);
$tpl->setValue("name", $name);

$site = $tpl->parse(); 

?>
