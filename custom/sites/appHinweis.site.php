<?php

$id = $this->params->get("id");
$par[0] = $id;
$res = $this->sql->get("SELECT hinweis FROM karte WHERE id = ?", "i", $par);

$retCode = "5003";
$hinweis = "";
if ($res->num_rows > 0)
{
	while($row = $res->fetch_array(MYSQLI_ASSOC))
	{
		$hinweis = $row['hinweis'];
        $retCode = "5001";
    }
}

$answer['code'] = $retCode;
$answer['message'] = $this->lang->get("message", "code".$retCode);
$answer['hinweis'] = "<b>".$this->lang->get("lernen", "hinweis").":</b><br>".nl2br($hinweis);

echo json_encode($answer);

?>
