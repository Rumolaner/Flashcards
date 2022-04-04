<?php

$tpl = new clsTemplate("modTodoKarte", $this->user->getTemplateset());

$id = $params['id'];
$frage = $params['frage'];
$hinweis = $params['hinweis'];
$antwort = $params['antwort'];
$todo = $params['todo'];

$tpl->setValue("todo", $this->lang->get("todo", "todo"));
$tpl->setValue("frage", $this->lang->get("todo", "frage"));
$tpl->setValue("hinweis", $this->lang->get("todo", "hinweis"));
$tpl->setValue("antwort", $this->lang->get("todo", "antwort"));
$tpl->setValue("speichern", $this->lang->get("button", "speichern"));
$tpl->setValue("delete", $this->lang->get("button", "delete"));

$tpl->setValue("id", $id);
$tpl->setValue("frageValue", $frage);
$tpl->setValue("hinweisValue", $hinweis);
$tpl->setValue("antwortValue", $antwort);
$tpl->setValue("checked", ($todo == 1?"checked":""));

$site = $tpl->parse();

?>
