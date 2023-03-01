<?php

class clsTemplate
{
	private $templateset;
	private $template;
	private $tagStart;
	private $tagEnd;
	private $values;

	function __construct($template, $templateset = "")
	{
		GLOBAL $confTemplateDefaultset, $confTemplateTagStart, $confTemplateTagEnd;

		$this->tagStart = $confTemplateTagStart;
		$this->tagEnd = $confTemplateTagEnd;

		if (!file_exists("custom/templates/".$templateset) || $templateset == "")
		{
			$this->templateset = $confTemplateDefaultset;

			if ($templateset != "")
			{
				fcLog("clsTemplate", "Das Templateset '".$templateset."' existiert nicht!");
			}
		}
		else
		{
			$this->templateset = $templateset;
		}

		if (!file_exists("custom/templates/".$this->templateset."/".$template.".tpl.php"))
		{
			fcLog("clsTemplate", "Das Template '".$template."' im Templateset '".$this->templateset."' existiert nicht!");
			die("An error occured, please call an administrator");
		}
		else
		{
			$this->template = $template;
		}
	}

	function setValue($name, $value)
	{
		$this->values[$name] = $value;
	}

	function parse()
	{
		$site = "";
		$siteArray = file("custom/templates/".$this->templateset."/".$this->template.".tpl.php");

		foreach($siteArray AS $zeile)
		{
			//Values einsetzen
			if (is_array($this->values))
			{
				$keys = array_keys($this->values);
				foreach($keys as $key) 
				{
					$zeile = str_replace($this->tagStart." ".$key.$this->tagEnd, $this->values[$key], $zeile);
				}
			}

			$site .= $zeile;
		}

		return $site;
	}
}

?>
