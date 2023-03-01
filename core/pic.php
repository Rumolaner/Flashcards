<?php 

//Config einbinden
include("custom/config.php");
include("core/constant.const.php");

//Funktionen einbinden
include_once 'core/functions/log.func.php';

//Klassen einbinden
include_once 'core/classes/parameter.cls.php';
include_once('core/classes/user.cls.php');
include_once('core/classes/template.cls.php');
include_once('core/classes/mysql.cls.php');

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
	$session = Array();
$params = new clsParameter($_POST, $_GET, $_COOKIE, $session);

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
		fcLog("pic.php", "Das Templateset '".$templateset."' existiert nicht!");
	}

	$templateset = $confTemplateDefaultset;
}

$pic = $params->get("pic");

if (!file_exists("custom/templates/".$templateset."/pics/".$pic))
{
	$path = "custom/pics/".$pic;
}
else
{
	$path = "custom/templates/".$templateset."/pics/".$pic;
}

$pictype = @exif_imagetype($path);

//Bild laden
switch($pictype)
{
	case IMAGETYPE_JPEG:
		$image = imagecreatefromjpeg ($path);
		break;
	case IMAGETYPE_PNG:
		$image = imagecreatefrompng ($path);
		imagealphablending($image, false);
        imagesavealpha($image, true);
		break;
	case IMAGETYPE_GIF:
		$image = imagecreatefromgif ($path);
		break;
}

//Bild bearbeiten
if ($confPicWasserzeichen)
{
	
}

//Bild ausgeben
switch($pictype)
{
	case IMAGETYPE_JPEG:
		header("Content-type: image/jpeg");
		imagejpeg($image); 
		break;
	case IMAGETYPE_PNG:
		header("Content-type: image/png");
		imagepng($image); 
		break;
	case IMAGETYPE_GIF:
		header("Content-type: image/gif");
		imagegif($image); 
		break;
}

@ImageDestroy($imgage);

?>
