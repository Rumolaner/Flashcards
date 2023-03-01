<?php

$tpl = new clsTemplate("appDeleteItem", $this->user->getTemplateset());
$retCode = "6000";

$name = $this->params->get("name");
$werte = $this->params->get("wert");

if ($name != "")
{
    $par[0] = $this->user->getId();
    $par[1] = $name;
    $res = $this->sql->get("SELECT id FROM benutzerset where benutzer_id = ? and name = ?", "is", $par);

    if ($res->num_rows > 0)
    {
        while($row = $res->fetch_array(MYSQLI_ASSOC))
        {
            $id = $row['id'];
        }

        $par1[0] = $werte;
        $par1[1] = $id;
        $res2 = $this->sql->get("UPDATE benutzerset SET fragen_ids = ?, udate = CURRENT_TIMESTAMP()  WHERE id = ?", "si", $par1);
        $retCode = "6002";
    }
    else
    {
        $par1[0] = $this->user->getId();
        $par1[1] = $name;
        $par1[2] = $werte;
        $res2 = $this->sql->get("INSERT INTO benutzerset (benutzer_id, name, fragen_ids, udate) VALUES (?, ?, ?, CURRENT_TIMESTAMP())", "iss", $par1);
        $retCode = "6002";
    }
}
else
{
    $retCode = "6000";
}

$tpl->setValue("code", $retCode);
$tpl->setValue("message", $this->lang->get("message", "code".$retCode));
$tpl->setValue("data", $name);

$site = $tpl->parse();

?>
