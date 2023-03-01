<?php

$tpl = new clsTemplate("appDeleteItem", $this->user->getTemplateset());
$retCode = "0";

$item = $this->params->get("item");
if (substr($item, 0, 4) == "item")
    $type = "kategorie";
else if (substr($item, 0, 3) == "del")
    $type = "frage";
else
    $type = "error";

if ($type == "kategorie")
{
    $par[0] = substr($item, 4);
    $par[1] = substr($item, 4);
    $res = $this->sql->get("DELETE FROM kategorie WHERE parent_id = ? OR id = ?", "ii", $par);

    if($this->sql->getAffectedRows() > 0)
    {
        $par2[0] = substr($item, 4);
        $res = $this->sql->get("DELETE FROM karte WHERE kategorie_id = ?", "i", $par2);
        $retCode = "4007";
    }
    else
    {
        $retCode = "4008";
    }
}
elseif ($type == "frage")
{
    $par[0] = substr($item, 3);
    $res = $this->sql->get("DELETE FROM karte WHERE id = ?", "i", $par);

    if($this->sql->getAffectedRows() > 0)
    {
        $retCode = "4010";
    }
    else
    {
        $retCode = "4011";
    }
}
else
{
    $retCode = "4009";
}

$tpl->setValue("code", $retCode);
$tpl->setValue("message", $this->lang->get("message", "code".$retCode));
$tpl->setValue("data", $item);

$site = $tpl->parse(); 

?>
