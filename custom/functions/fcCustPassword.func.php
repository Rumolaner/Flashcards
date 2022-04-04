<?php

function fcCustPwdCheckComplexity($pwd)
{
	$length = false;
	$upper = false;
	$lower = false;
	$number = false;
	$special = false;
	
	if (strlen($pwd) >= 6)
		$length = true;
	
	for ($counter = 0; $counter < strlen($pwd); $counter ++)
	{
		if (ctype_digit($pwd[$counter]))
		{
			$number = true;
		}
		elseif (ctype_lower($pwd[$counter]))
		{
			$lower = true;
		}
		elseif (ctype_upper($pwd[$counter]))
		{
			$upper = true;
		}
		elseif (ctype_punct($pwd[$counter]))
		{
			$special = true;
		}
	}
	
	if (!$length || !$upper || !$lower || !$number || !$special)
	{
		return false;
	}
	else
	{
		return true;
	}
}

?>