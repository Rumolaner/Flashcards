<?php

class clsParameter
{
	private $post;
	private $get;
	private $cookie;
	private $session;

	function clsParameter($post, $get, $cookie, $session)
	{
		$this->post = $post;
		$this->get = $get;
		$this->cookie = $cookie;
		$this->session = $session;
	}

	function get($var, $array = "")
	{
		if ($array == "")
		{
			if (is_array($this->get))
			{
				if (array_key_exists ($var, $this->get))
				{
					return $this->secure($this->get[$var]);
				}
			}

			if (is_array($this->post))
			{
				if (array_key_exists ($var, $this->post))
				{
					return $this->secure($this->post[$var]);
				}
			}

			if (is_array($this->session))
			{
				if (array_key_exists ($var, $this->session))
				{
					return $this->secure($this->session[$var]);
				}
			}

			if (is_array($this->cookie))
			{
				if (array_key_exists ($var, $this->cookie))
				{
					return $this->secure($this->cookie[$var]);
				}
			}

			return "";
		}
		elseif (is_array($this->post) && $array == "post")
		{
			return $this->secure($this->post[$var]);
		}
		elseif (is_array($this->cookie) && $array == "cookie")
		{
			return $this->secure($this->cookie[$var]);
		}
		elseif (is_array($this->get) && $array == "get")
		{
			return $this->secure($this->get[$var]);
		}
		elseif (is_array($this->session) && $array == "session")
		{
			return $this->secure($this->session[$var]);
		}
		else
		{
			return "";
		}
	}

	function setSession($var, $value)
	{
		$_SESSION[$var] = $value;
	}

	function unsetSession($var)
	{
		unset($_SESSION[$var]);
	}

	function secure($value)
	{
		if (is_array($value))
		{
			foreach($value as $key => $val) 
			{
				$value[$key] = htmlspecialchars($val, ENT_COMPAT,'ISO-8859-1', true);
			}
		}
		else
		{
			$value = htmlspecialchars($value, ENT_COMPAT,'ISO-8859-1', true);
		}

		return $value;
	}
}

?>
