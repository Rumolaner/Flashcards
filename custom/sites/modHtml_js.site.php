<?php

$tpl = new clsTemplate("modHtml_js");

$tpl->setValue("jspath", fcJsLink($params));

$site = $tpl->parse();

?> 