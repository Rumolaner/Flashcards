<?php

class clsAction
{
	private $params;
	private $user;
	private $lang;
	private $sql;
	private $msgStack;
	
	function __construct()
	{
		GLOBAL $params, $user, $lang, $sql;
		
		$this->params = $params;
		$this->user = $user;
		$this->lang = $lang;
		$this->sql = $sql;
	}
	
	function perform($action, $params = Array())
	{
		$site = "";

		if (is_file("custom/sites/".$action.".site.php"))
		{
			include("custom/sites/".$action.".site.php");
		}
		else
		{
			fclog("clsAction", "Action '".$action."' konnte nicht gefunden werden!");
			die("An error occured, please call an administrator");
		}
		
		return $site;
	}
	
	function setMsg($msg)
	{
		$this->msgStack[] = $msg;
	}
	
	function getMsg()
	{
		return $this->msgStack;
	}
} 

?>
