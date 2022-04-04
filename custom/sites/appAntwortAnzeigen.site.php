<?php

$tpl = new clsTemplate("appAntwortAnzeigen", $this->user->getTemplateset());
$retCode = "5002";

$id = $this->params->get("id");
$antwort = "";

$par[0] = $id;
$res = $this->sql->get("SELECT antwort FROM karte WHERE id = ?", "i", $par);

if ($res->num_rows > 0)
{
	while($row = $res->fetch_array(MYSQLI_ASSOC))
	{
        $retCode = "5001";
		$antwort = nl2br($row['antwort']);
    }
}

if ($antwort == "")
{
	$antwort = " ";
}

$tpl->setValue("code", $retCode);
$tpl->setValue("message", $this->lang->get("message", "code".$retCode));
$tpl->setValue("answer", $antwort);

$site = $tpl->parse(); 

?>
