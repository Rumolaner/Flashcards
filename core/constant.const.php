<?php

$path = $_SERVER["PHP_SELF"];
if (substr($path, -4, 4) == ".php")
{
	$file = substr($path, strrpos($path, '/'));
	$path = substr($path, 0, strlen($path) - strlen($file));
}

define("constAppPath", "http://".$_SERVER["SERVER_NAME"].$path."/");
define("constAppPathSSL", "https://".$_SERVER["SERVER_NAME"].$path."/");

?>