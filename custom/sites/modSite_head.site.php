<?php

$tpl = new clsTemplate("modSite_head", $this->user->getTemplateset());

$linkpar = Array();
$nmainlink = fcLink($linkpar);
$tpl->setValue("nav_mainlink", $nmainlink);
$tpl->setValue("nav_maintext", $this->lang->get("nav", "main"));

$linkpar['a'] = "webKategorien";
$nkategorienlink = fcLink($linkpar);
$tpl->setValue("nav_kategorienlink", $nkategorienlink);
$tpl->setValue("nav_kategorientext", $this->lang->get("nav", "kategorien"));

$linkpar['a'] = "webTodo";
$ntodolink = fcLink($linkpar);
$tpl->setValue("nav_todolink", $ntodolink);
$tpl->setValue("nav_todotext", $this->lang->get("nav", "todo"));

$linkpar['a'] = "webKatSelect";
$nlernenlink = fcLink($linkpar);
$tpl->setValue("nav_lernenlink", $nlernenlink);
$tpl->setValue("nav_lernentext", $this->lang->get("nav", "lernen"));

if ($this->user->getID() < 1)
{
	$linkpar['a'] = "webLogin";
        $nloginoutlink = fcLink($linkpar);
        $tpl->setValue("nav_loginoutlink", $nloginoutlink);
        $tpl->setValue("nav_loginouttext", $this->lang->get("nav", "login"));
}
else
{
        $linkpar['a'] = "appLogout";
	$nloginoutlink = fcLink($linkpar);
	$textpar['name'] = $this->user->getName();
	$tpl->setValue("nav_loginoutlink", $nloginoutlink);
	$tpl->setValue("nav_loginouttext", $this->lang->get("nav", "logout", $textpar));
}
$site = $tpl->parse();

?>
