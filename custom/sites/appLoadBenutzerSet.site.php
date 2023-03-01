<?php

$tpl = new clsTemplate("appDeleteItem", $this->user->getTemplateset());
$retCode = "6005";

$id = $this->params->get("id");

if ($id != "")
{
    $par[0] = $this->user->getId();
    $par[1] = $id;
    $res = $this->sql->get("SELECT fragen_ids FROM benutzerset where benutzer_id = ? and id = ?", "ii", $par);

    if ($res->num_rows > 0)
    {
        while($row = $res->fetch_array(MYSQLI_ASSOC))
        {
            $fragen = $row['fragen_ids'];
        }
        $retCode = "6006";
    }
    else
    {
        $retCode = "6005";
    }
}
else
{
    $retCode = "6005";
}

$tpl->setValue("code", $retCode);
$tpl->setValue("message", $this->lang->get("message", "code".$retCode));
$tpl->setValue("data", $fragen);

$site = $tpl->parse();

?>
