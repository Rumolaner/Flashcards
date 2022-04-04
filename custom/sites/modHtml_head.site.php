<?php

$tpl = new clsTemplate("modHtml_head", $this->user->getTemplateset());

$tpl->setValue("html_keywords", $this->lang->get("html", "keywords"));
$tpl->setValue("html_description", $this->lang->get("html", "description"));

if (is_array($params['css']))
{
	$css = "";
	foreach($params['css'] as $key => $val) 
	{
		$css .= $this->perform("modHtml_css", $val);
	}
	$tpl->setValue("html_css", $css);
}
else
{
	$tpl->setValue("html_css", "");
}

if (is_array($params['js']))
{
	$js = "";
	foreach($params['js'] as $key => $val) 
	{
		$js .= $this->perform("modHtml_js", $val);
	}
	$tpl->setValue("html_js", $js);
}
else
{
	$tpl->setValue("html_js", "");
}

$tpl->setValue("html_title", $this->lang->get("html_title", $params['title'], $params['titlevalues']));
$tpl->setValue("nojavascript", $this->lang->get("error", "nojavascript"));

$site = $tpl->parse();

?>