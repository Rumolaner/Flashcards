<?php

$tpl = new clsTemplate("appSaveFrage", $this->user->getTemplateset());
$retCode = "0";

$kat = $this->params->get("kat");
$id = $this->params->get("id");
$frage = htmlspecialchars_decode($this->params->get("frage"), ENT_QUOTES);
$hinweis = htmlspecialchars_decode($this->params->get("hinweis"), ENT_QUOTES);
$antwort = htmlspecialchars_decode($this->params->get("antwort"), ENT_QUOTES);
$todo = ($this->params->get("todo") != "true"?0:1);
$action = "";

if ($id == -1)
{
    $par[0] = $kat;
    $par[1] = $frage;
    $par[2] = $hinweis;
    $par[3] = $antwort;
    $par[4] = $todo;
    $res = $this->sql->insert("INSERT INTO karte (kategorie_id, frage, hinweis, antwort, todo) VALUES (?, ?, ?, ?, ?)", "isssi", $par);
    
    if ($res <> -1)
    {
        $retCode = "4014";
    }
    else
    {
        $retCode = "4015";
    }
    $action = "insert";
}
else
{
    $par[0] = $frage;
    $par[1] = $hinweis;
    $par[2] = $antwort;
    $par[3] = $todo;
    $par[4] = $id;

    $res = $this->sql->insert("UPDATE karte SET frage = ?, hinweis = ?, antwort = ?, todo = ? WHERE id = ?", "sssii", $par);
    
    if ($res <> -1)
    {
        $retCode = "4014";
    }
    else
    {
        $retCode = "4015";
    }
    $action = "update";
    $res = $id;
}

$tpl->setValue("code", $retCode);
$tpl->setValue("message", $this->lang->get("message", "code".$retCode));
$tpl->setValue("action", $action);
$tpl->setValue("id", $res);

$site = $tpl->parse(); 

?>
