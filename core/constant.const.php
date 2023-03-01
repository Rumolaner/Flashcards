<?php

$path = $_SERVER["PHP_SELF"];
$port = ":".$_SERVER["SERVER_PORT"];

if (substr($path, -4, 4) == ".php")
{
	$file = substr($path, strrpos($path, '/'));
	$path = substr($path, 0, strlen($path) - strlen($file));
}

if ($port == ":80")
	$port = "";

define("constAppPath", "http://".$_SERVER["SERVER_NAME"].$port.$path."/");
define("constAppPathSSL", "https://".$_SERVER["SERVER_NAME"].$port.$path."/");

?>
