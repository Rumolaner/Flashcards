<?php

$id = $this->params->get("id");
$par[0] = $id;
$answer = Array();

$res = $this->sql->insert("UPDATE karte SET todo = 1 WHERE id = ?", "i", $par);

if ($res > 0)
    $retCode = "5004";
else
    $retCode = "5005";

$answer['code'] = $retCode;
$answer['message'] = $this->lang->get("message", "code".$retCode);

echo json_encode($answer);

?>
