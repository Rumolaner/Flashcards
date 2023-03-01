<?php

$kat= $this->params->get("kat");

$par[0] = $this->user->getId();
$this->sql->insert("DELETE FROM benutzer2kategorie where benutzer_id = ?", "i", $par);

$keys = array_keys($kat);
for ($i = 0; $i < count($keys); $i++)
{
    $par[1] = $keys[$i];
    $this->sql->insert("INSERT INTO benutzer2kategorie (benutzer_id, kategorie_id) VALUES (?, ?)", "ii", $par);
}

$linkpar['a'] = "webLernen";
$link = fcLink($linkpar);

header('Location: '.$link);

?>
