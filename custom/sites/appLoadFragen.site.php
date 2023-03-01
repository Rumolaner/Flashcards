<?php

$tpl = new clsTemplate("appLoadFragen", $this->user->getTemplateset());
$retCode = "0";

$kat = $this->params->get("kat");
$par[0] = substr($kat, 4);
$res = $this->sql->get("SELECT name FROM kategorie WHERE id = ?", "i", $par);

$frag = Array();

if ($res->num_rows > 0)
{
	while($row = $res->fetch_array(MYSQLI_ASSOC))
	{
        $retCode = "4006";
		$katname = $row['name'];
    }

    $res2 = $this->sql->get("SELECT id, frage, hinweis, antwort, todo FROM karte WHERE kategorie_id = ? ORDER BY id asc", "i", $par);

    if ($res2->num_rows > 0)
    {
        $count = 0;
        while($row2 = $res2->fetch_array(MYSQLI_ASSOC))
        {
            $frag[$count]['id'] = $row2['id'];
            $frag[$count]['frage'] = $row2['frage'];
            $frag[$count]['hinweis'] = $row2['hinweis'];
            $frag[$count]['antwort'] = $row2['antwort'];
            $frag[$count]['todo'] = ($row2['todo'] == 1);

            $count++;
        }

    }
}
else
{
    $retCode = "4005";
    $katname = $this->lang->get("kategorien", "keine");
}

//$fragen .= "]";
$answer['code'] = $retCode;
$answer['message'] = $this->lang->get("message", "code".$retCode);
$answer['kat'] = $katname;
$answer['katid'] = substr($kat, 4);
$answer['fragen'] = $frag;

echo json_encode($answer);
?>
