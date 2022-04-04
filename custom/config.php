<?php

//Maintenance
$confMaintenance = false;								//Wenn true werden keine Aktionen ausgeführt und nur die Wartungsseite angezeigt

//Debug-Mode
$confDebug = true;										//Wenn false werden keine Log-Einträge geschrieben, nur Einträge mit der expliziten Anweisung werden geschrieben

//Applicationname
$confAppName = "Saardolls - Flashcards";						//Der Name der Applikation

//Datenbank
$confUseDB = true;										//Wenn false wird keine Verbindung zur Datenbank aufgebaut. $mysql ist nicht existent
$confDbHost = "<dbhost>";
$confDbUser = "<dbuser>";
$confDbDatabase = "<dbname>";
$confDbPwd = "<dbpwd>";

//Templates
$confTemplateDefaultset = "default";					//Standardwert für das Templateset
$confTemplateTagStart = "{tpl";							//Wie wird ein Platzhalter im Template eingeleitet?
$confTemplateTagEnd = "}";								//Wie wird ein Platzhalter im Template abgeschlossen?

//Email
$confMailSendhtml = true;								//Sollen Email im HTML-Format versendet werden?
$confMailFromAdresse = '<emailsenderadress>';			//Absenderadresse der Emails
$confMailFromName = '<emailsendername>';						//Absendername der Emails
$confMailReplytoAdresse = '<emailreplytoadress>';		//Reply to-Adresse der Emails^
$confMailReplytoName = '<emailreplytoname>';					//Reply to-Name der Emails

//Benutzer
$confUserDefaultName = "Gast";							//Wie soll ein Besucher ohne Benutzeraccount genannt werden?
$confUserDefaultId = 0;									//Wie wird der Benutzer referenziert?

//Sprache
$confLangDefault = "deutsch";							//Welche Sprache bekommen neue Besucher angezeigt?

//Action
//Der folgende Block an Werten definiert wie das Framework reagieren soll wenn die übergebene action ungültig ist
//Für jeden Seitentyp kann ein separater Block definiert werden. Ein spezieller Seitentyp wird bestimmt, indem im aufrufenden Link der Parameter "app" mitgegeben wird.
//Seitentyp default steht für alle, die nicht extra definiert wurden
$confAction['default']['Empty'] = "webMain";			//Default-Seite, wenn keine Action angegeben wird
$confAction['default']['NoFile'] = "webMain";			//Default-Seite, wenn eine nicht existierende Action angegeben wird
$confAction['default']['NoAuthGuest'] = "webLogin";		//Default-Seite, wenn der Benutzer keine Berechtigung für die Seite hat, und auch nicht als Benutzer registriert ist
$confAction['default']['NoAuthUser'] = "webNoaccess";		//Default-Seite, wenn der Benutzer keine Berechtigung für die Seite hat, aber als Benutzer registriert ist

$confAction['app']['Empty'] = "appEmpty";				//Default-Seite, wenn keine Action angegeben wird
$confAction['app']['NoFile'] = "appEmpty";				//Default-Seite, wenn eine nicht existierende Action angegeben wird
$confAction['app']['NoAuthGuest'] = "appEmpty";			//Default-Seite, wenn der Benutzer keine Berechtigung für die Seite hat, und auch nicht als Benutzer registriert ist
$confAction['app']['NoAuthUser'] = "appEmpty";			//Default-Seite, wenn der Benutzer keine Berechtigung für die Seite hat, aber als Benutzer registriert ist

//Bilder
$confPicWasserzeichen = false;

?>
