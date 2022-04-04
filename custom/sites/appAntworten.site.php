<?php

$tpl = new clsTemplate("appDefault", $this->user->getTemplateset());
$retCode = "5001";

$id = $this->params->get("id");
$richtig = $this->params->get("richtig");

if ($richtig == "true" && $id > 0)
{
    $par[0] = $this->user->getId();
    $par[1] = $id;
    $res = $this->sql->insert("INSERT INTO benutzer2karte (benutzer_id, karte_id, fortschritt, gewusst) VALUES(?, ?, 2, 1) ON DUPLICATE KEY UPDATE fortschritt = fortschritt + 1, gewusst = 1", "ii", $par);
}
elseif($richtig == "false" && $id > 0)
{
    $par[0] = $this->user->getId();
    $par[1] = $id;
    $res = $this->sql->insert("INSERT INTO benutzer2karte (benutzer_id, karte_id, fortschritt, gewusst) VALUES(?, ?, 1, 0) ON DUPLICATE KEY UPDATE fortschritt = IF(fortschritt <= 2, 1, fortschritt - 1), datum = NOW(), gewusst = 0", "ii", $par);
}

$tpl->setValue("code", $retCode);
$tpl->setValue("message", $this->lang->get("message", "code".$retCode));

$site = $tpl->parse(); 

?>
