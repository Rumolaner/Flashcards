<?php

$tpl = new clsTemplate("modHtml_foot", $this->user->getTemplateset());

$site = $tpl->parse();

?>