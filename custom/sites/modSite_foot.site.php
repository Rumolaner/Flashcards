<?php

$tpl = new clsTemplate("modSite_foot", $this->user->getTemplateset());

$tpl->setValue("year", date("Y"));

$site = $tpl->parse();

?>
