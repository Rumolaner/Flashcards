<?php 

class clsUser
{
	protected $id;
	protected $name;
	protected $lang;
	protected $guest;
	protected $templateset;
	
	function __construct()
	{
		GLOBAL $confUserDefaultId, $confUserDefaultName, $confLangDefault;
		
		$this->id = $confUserDefaultId;
		$this->name = $confUserDefaultName;
		$this->lang = $confLangDefault;
		$this->templateset = "";
		$this->guest = true;
	}
	
	function getId()
	{
		return $this->id;
	}

	function getName()
	{
		return $this->name;
	}
	
	function getLang()
	{
		return $this->lang;
	}

	function getActiveLang()
	{
		GLOBAL $params;
		
		$lg = $params->get("lg");
		
		if ($lg == "")
			return $this->lang;
		else
			return $lg;
	}
	
	function getTemplateset()
	{
		return $this->templateset;
	}
	
	function isGuest()
	{
		return $this->guest;	
	}
	
	function isAuthorized($site)
	{
		return true;
	}
}

?>