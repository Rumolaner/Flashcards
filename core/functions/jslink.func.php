<?php

function fcJsLink($params)
{
	$link = "";

	if (is_array($params))
	{
		foreach($params as $key => $val) 
		{
			if ($link == "")
				$link .= "?".$key."=".$val;
			else
				$link .= "&".$key."=".$val;
		}
	}
	
	$link = constAppPath."js.php".$link;
	
	return $link;
}

?>