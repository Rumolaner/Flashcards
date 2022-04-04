<?php

$tpl = new clsTemplate("modHtml_css");

$tpl->setValue("csspath", fcCssLink($params));

$site = $tpl->parse();

?>