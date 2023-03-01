<?php

$tpl = new clsTemplate("modSelectOption", $this->user->getTemplateset());

$tpl->setValue("id", $params['id']);
$tpl->setValue("name", $params['name']);
$tpl->setValue("selected", $params['selected']);
$site = $tpl->parse();

?>
