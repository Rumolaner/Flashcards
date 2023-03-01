<?php

function fcPwd($pwd)
{
	GLOBAL $confPwdSaltPre, $confPwdSaltPost;
	
	$pwd = $confPwdSaltPre.$pwd.$confPwdSaltPost;
	return hash('sha256', $pwd);
}

?>