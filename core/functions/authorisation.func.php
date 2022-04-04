<?php

function fcAuthorisation($type, $object_id, $user_id)
{
	$auth = true;

	if (function_exists("fcCustAuthorisation"))
	{
		$auth = fcCustAuthorisation($type, $object_id, $user_id);
	}
	
	return $auth;
}

?>