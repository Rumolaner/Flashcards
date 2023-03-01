<?php

$tpl = new clsTemplate("webLogin", $this->user->getTemplateset());

$headpar['title'] = "login";
$headpar['css'][0]['a'] = "css_general";
$headpar['css'][1]['a'] = "css_overlay";
$headpar['js'][0]['a'] = "js_general";
$headpar['js'][1]['a'] = "js_login";
$headpar['titlevalues'] = Array();
$tpl->setValue("html_head", $this->perform("modHtml_head", $headpar));

$headpar = NULL;
$headpar['title'] = "main";
$tpl->setValue("site_head", $this->perform("modSite_head", $headpar));

$footpar['site'] = "main";
$tpl->setValue("site_foot", $this->perform("modSite_foot", $footpar));
$tpl->setValue("html_foot", $this->perform("modHtml_foot"));

if (false)
{
	$tpl->setValue("msg", $this->lang->get("main", "msg1"));
}
else
{
	$tpl->setValue("msg", "");
}

$tpl->setValue("title", $this->lang->get("login", "title"));
$tpl->setValue("loginname", $this->lang->get("login", "loginname"));
$tpl->setValue("login", $this->lang->get("button", "login"));

$selpar['id'] = "-1";
$selpar['name'] = "";
$selpar['selected'] = " selected";
$options = $this->perform("modSelectOption", $selpar);

$opt = $this->sql->get("SELECT id, name FROM benutzer order by name");
//$opt = $this->sql->get("show databases;");

if ($opt->num_rows > 0)
{
        while($row = $opt->fetch_array(MYSQLI_ASSOC))
        {
			$selpar['id'] = $row['id'];
			$selpar['name'] = $row['name'];
			$selpar['selected'] = " ";
			$options .= $this->perform("modSelectOption", $selpar);
        }
}

$selpar['id'] = "-1";
$selpar['name'] = "";
$selpar['selected'] = " selected";
$tpl->setValue("options", $options);

$site = $tpl->parse();

?>
