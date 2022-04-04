<?php

$tpl = new clsTemplate("appDefault", $this->user->getTemplateset());
$retCode = "0";

$login = $this->params->get("login");

$par[0] = $login;

$res = $this->sql->get("SELECT count(name) as anzahl, id FROM benutzer WHERE id = ?", "i", $par);

if ($res->num_rows > 0)
{
	while($row = $res->fetch_array(MYSQLI_ASSOC))
	{
		if ($row['anzahl'] <= 0)
		{
			$retCode = "3018";
		}
		else
		{
			$retCode = "3019";
			$this->params->setSession("userid", $login);
		}
	}
}
else
{
	$retCode = "3001";
}

$tpl->setValue("code", $retCode);
$tpl->setValue("message", $this->lang->get("message", "code".$retCode));

$site = $tpl->parse(); 

?>
