<?php

class clsLanguages
{
	private $default_language;
	private $language;
	private $tagStart;
	private $tagEnd;
	private $values;

	function __construct()
	{
		GLOBAL $confTemplateTagStart, $confTemplateTagEnd;

		$this->tagStart = $confTemplateTagStart;
		$this->tagEnd = $confTemplateTagEnd;
		$this->values = Array();
		$this->setDefault();
	}

	function setLang($lang)
	{
		$this->language = $lang;

		$this->values["lang"] = $this->getValues($this->language);
	}

	function setDefault()
	{
		GLOBAL $confLangDefault;

		$this->default_language = $confLangDefault;

		$this->values["default"] = $this->getValues($this->default_language);
	}

	private function getValues($lang)
	{
		$values = Array();

		$dir = opendir ("custom/languages");

		while ($datei = readdir ($dir)) 
		{
			if ($datei == $lang.".lang.php")
			{
				$xml = simplexml_load_string(utf8_encode(file_get_contents("custom/languages/".$datei))); 

				foreach($xml->children() as $child)
				{
					foreach($child->children() as $conf)
					{
						$name = $conf->getName();

						foreach($conf->children() as $conf2)
				    		{
				    			$values[$name][$conf2->getName()] = utf8_decode($conf2->__toString());
						}
					}
				}
			}
		}

		closedir($dir);

		return $values;
	}

	function get($area, $conf, $params = Array())
	{
		if (isset($this->values["lang"][$area][$conf]))
			$ret = $this->values["lang"][$area][$conf];
		elseif (isset($this->values["default"][$area][$conf]))
			$ret = $this->values["default"][$area][$conf];
		else
			$ret = $area." - ".$conf;

		if (count($params) > 0)
		{
			//Parameter einsetzen
			$keys = array_keys($params);
			foreach($keys as $key) 
			{
				$ret = str_replace($this->tagStart." ".$key.$this->tagEnd, $params[$key], $ret);
			}
		}

		return $ret;
	}
}

?>
