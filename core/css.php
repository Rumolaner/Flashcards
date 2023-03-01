<?php 
//Config einbinden
include("custom/config.php");

//Funktionen einbinden
include_once 'core/functions/log.func.php';

//Klassen einbinden
include_once 'core/classes/parameter.cls.php';
include_once('core/classes/user.cls.php');
include_once('core/classes/template.cls.php');
include_once('core/classes/action.cls.php');
if ($confUseDB == true)
{
	include_once("classes/mysql.cls.php");
}

//Custom-Funktionen einbinden
$verzeichnis=opendir ("custom/functions");
while ($datei = readdir ($verzeichnis)) 
{
	if ($datei != "." && $datei != ".." && $datei != "info.txt")
	{
		include_once("custom/functions/".$datei);
	}
}
closedir($verzeichnis);

//Custom-Klassen einbinden
$verzeichnis=opendir ("custom/classes");
while ($datei = readdir ($verzeichnis)) 
{
	if ($datei != "." && $datei != ".." && $datei != "info.txt")
	{
		include_once("custom/classes/".$datei);
	}
}
closedir($verzeichnis);

//Klassen initialisieren
if (isset($_SESSION))
	$session = $_SESSION;
else
	$session = NULL;
$params = new clsParameter($_POST, $_GET, $_COOKIE, $session);
if ($confUseDB == true)
{
	$sql = new clsMysql();
}

//Benutzer initialisieren, erweiterte und benutzerdefinierte Klasse, oder Standard
if (class_exists("clsCustUser"))
	$user = new clsCustUser();
else
	$user = new clsUser();

$templateset = $user->getTemplateset();
if (!file_exists("custom/templates/".$templateset) || $templateset == "")
{
	if ($templateset != "")
	{
		fcLog("css.php", "Das Templateset '".$templateset."' existiert nicht!");
	}

	$templateset = $confTemplateDefaultset;
}

$file = $params->get("a");
$active = $params->get("ac");

header('Content-type: text/css');

if ($active != "" && file_exists("custom/sites/".$file.".site.php"))
{
	$action = new clsAction();
	echo $action->perform($file);
}
elseif (file_exists("custom/templates/".$templateset."/css/".$file.".css"))

{
	include_once "custom/templates/".$templateset."/css/".$file.".css";
}

?>