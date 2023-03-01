<?php 

//phpinfo();
//die();

//Config einbinden
include("custom/config.php");
include("core/constant.const.php");
if (file_exists("custom/configCust.php"))
	include("custom/configCust.php");

//Maintenanceseite anzeigen
if ($confMaintenance == true)
{
	@include_once("custom/maintenance.html"); 
	die();
}

//Session start
session_start();

//Funktionen einbinden
include_once 'core/functions/log.func.php';
include_once 'core/functions/link.func.php';
include_once 'core/functions/piclink.func.php';
include_once 'core/functions/csslink.func.php';
include_once 'core/functions/jslink.func.php';
//include_once 'core/functions/email.func.php';
include_once 'core/functions/pwd.func.php';
include_once 'core/functions/authorisation.func.php';

//Klassen einbinden
include_once 'core/classes/parameter.cls.php';
include_once 'core/classes/template.cls.php';
include_once('core/classes/user.cls.php');
include_once('core/classes/languages.cls.php');
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
$params = new clsParameter($_POST, $_GET, $_COOKIE, $_SESSION);
$lang = new clsLanguages();
if ($confUseDB == true)
{
	if (class_exists("clsCustMysql"))
		$sql = new clsCustMysql();
	else
		$sql = new clsMysql();
}

//Benutzer initialisieren, erweiterte und benutzerdefinierte Klasse, oder Standard
if (class_exists("clsCustUser"))
	$user = new clsCustUser();
else
	$user = new clsUser();

//Seitensprache festlegen
$lang->setLang($user->getActiveLang());

//Seitentyp ermitteln
$app = $params->get("app");
if (!array_key_exists($app, $confAction))
{
	$app = "";
}
if ($app == "")
{
	$app = "default";
}

//Action ermitteln und ausführen
$action = new clsAction();
$a = $params->get("a");

if ($a == "")
{
	$action->setMsg("actionEmpty");
	$a = $confAction[$app]["Empty"];
}
elseif (!file_exists("custom/sites/".$a.".site.php"))
{
	$action->setMsg("actionNoFile");
	$a = $confAction[$app]["NoFile"];
}
elseif (!$user->isAuthorized($a))
{
	if ($user->isGuest())
	{
		$action->setMsg("actionNoAuthGuest");
		$a = $confAction[$app]["NoAuthGuest"];
	}
	else
	{
		$action->setMsg("actionNoAuthUser");
		$a = $confAction[$app]["NoAuthUser"];
	}
}

echo $action->perform($a);

?>
