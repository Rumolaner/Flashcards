<?php 

$tpl = new clsTemplate("webTodo", $this->user->getTemplateset());

$headpar['title'] = "main";
$headpar['css'][0]['a'] = "css_general";
$headpar['css'][1]['a'] = "css_overlay";
$headpar['css'][2]['a'] = "css_kategorie";
$headpar['js'][0]['a'] = "js_general";
$headpar['js'][1]['a'] = "js_todo";
$headpar['titlevalues'] = Array();
$tpl->setValue("html_head", $this->perform("modHtml_head", $headpar));

$headpar = NULL;
$headpar['title'] = "todo";
$tpl->setValue("site_head", $this->perform("modSite_head", $headpar));

$footpar['site'] = "todo";
$tpl->setValue("site_foot", $this->perform("modSite_foot", $footpar));
$tpl->setValue("html_foot", $this->perform("modHtml_foot"));

if (false)
{
	$tpl->setValue("msg", $this->lang->get("main", "msg"));
}
else
{
	$tpl->setValue("msg", "");
}

$titpar['name'] = $this->user->getName();
$tpl->setValue("title", $this->lang->get("todo", "title"));

$karten = "";

$res = $this->sql->get("SELECT id, frage, hinweis, antwort, todo from karte WHERE todo = 1 order by id");
if ($res->num_rows > 0)
{
    while($row = $res->fetch_array(MYSQLI_ASSOC))
    {
        $kartepar['id'] = $row['id'];
        $kartepar['frage'] = $row['frage'];
        $kartepar['hinweis'] = $row['hinweis'];
        $kartepar['antwort'] = $row['antwort'];
        $kartepar['todo'] = $row['todo'];
        $karten .= $this->perform("modTodoKarte", $kartepar);
    }
}

$tpl->setValue("karten", $karten);

$site = $tpl->parse();

?>
