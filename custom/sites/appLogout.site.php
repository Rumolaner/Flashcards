<?php

$this->params->unsetSession("userid");

$link = fcLink("");

header('Location: '.$link);

?>
