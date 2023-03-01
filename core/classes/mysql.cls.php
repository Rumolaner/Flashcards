<?php

class clsMysql
{
	private $host;
	private $db;
	private $user;
	private $pwd;
	private $mysqli;
	private $affectedrows;

	function __construct()
	{
		GLOBAL $confDbHost, $confDbDatabase, $confDbUser, $confDbPwd;

		$this->host = $confDbHost;
		$this->db = $confDbDatabase;
		$this->user = $confDbUser;
		$this->pwd = $confDbPwd;
		$this->affectedrows = 0;
	}

	function connect()
	{
		$this->mysqli = new mysqli($this->host, $this->user, $this->pwd, $this->db);
		if ($this->mysqli->connect_errno)
		{
			fcLog("clsMysql", "Keine Verbindung zur Datenbank möglich! (".$mysqli->connect_errno.") ".$mysqli->connect_error);
			die("An error occured, please call an administrator");
		}

		/* change character set to utf8 */
		if (!$this->mysqli->set_charset("utf8"))
		{
			fcLog("clsMysql", "Error loading character set utf8: ".$mysqli->error);
		}
	}

	function close()
	{
		$this->mysqli->close();
	}

	function get($statement, $types = NULL, $params = NULL)
	{
		GLOBAL $confDebug;

		$values = false;
		$this->connect();

		/* Create a prepared statement */
		if($stmt = $this->mysqli->prepare($statement))
		{
			try
			{
				if ($types != NULL)
				{
					// Bind parameters
					//s - string, b - boolean, i - int, etc
					if(!is_array($params))
					{
						$temp = $params;
						$params = Array();
						$params[] = $temp;
					}
					array_unshift($params, $types);

					if (!@call_user_func_array(array($stmt, "bind_param"), $this->vref($params)))
					{
						fcLog("clsMysql", "Statement: ".$statement);
						if ($params != NULL)
							fcLog("clsMysql", "Parameter: ".implode("-", $params));
						fcLog("clsMysql", "Fehler beim binden der Values");
						return NULL;
					}
				}

				/* Execute it */
				if ($confDebug == true)
				{
					fcLog("clsMysql", "Debug - Statement: ".$statement);
					if (is_array($params))
						fcLog("clsMysql", "Parameter: ".implode("-", $params));
				}
				$stmt->execute();

				/* Bind results */
				$values = $stmt->get_result();
				$this->affectedrows = $this->mysqli->affected_rows;

				/* Close statement */
				$stmt -> close();
			}
			catch (Exception $ex)
			{
				$this->affectedrows = 0;
				fcLog("clsMysql", "Statement: ".$statement);
				if ($params != NULL)
				{
					if(!is_array($params))
					{
						$temp = $params;
						$params = Array();
						$params[] = $temp;
					}

					fcLog("clsMysql", "Parameter: ".implode("-", $params));
				}
				fcLog("clsMysql", $ex->getMessage());
				fcLog("clsMysql", "(".$this->mysqli->errno.") ".$this->mysqli->error);
			}
		}
		else
		{
			$this->affectedrows = 0;
			fcLog("clsMysql", "Statement: ".$statement);
			if ($params != NULL)
			{
				if(!is_array($params))
				{
					$temp = $params;
					$params = Array();
					$params[] = $temp;
				}

				fcLog("clsMysql", "Parameter: ".implode("-", $params));
			}
			fcLog("clsMysql", "(".$this->mysqli->errno.") ".$this->mysqli->error);
		}

		$this->close();

		return $values;
	}

	function insert($statement, $types = NULL, $params = NULL)
	{
		GLOBAL $confDebug;

		$this->affectedrows = 0;
		$id = -1;
		$rows = 0;
		$this->connect();

		/* Create a prepared statement */
		if($stmt = $this->mysqli->prepare($statement))
		{
			try
			{
				if ($types != NULL)
				{
					// Bind parameters
					//s - string, b - boolean, i - int, etc
					if(!is_array($params))
					{
						$temp = $params;
						$params = Array();
						$params[] = $temp;
					}

					array_unshift($params, $types);
					if (!@call_user_func_array(array($stmt, "bind_param"), $this->vref($params)))
					{
						fcLog("clsMysql", "Statement: ".$statement);
						if ($params != NULL)
							fcLog("clsMysql", "Parameter: ".implode("-", $params));
						fcLog("clsMysql", "Fehler beim binden der Values");
						return $id;
					}
				}

				/* Execute it */
				if ($confDebug == true)
				{
					fcLog("clsMysql", "Debug - Statement: ".$statement);
					if (is_array($params))
						fcLog("clsMysql", "Parameter: ".implode("-", $params));
				}
				$stmt->execute();

				/* Inserted ID */
				$id = $stmt->insert_id;
				$rows = $stmt->affected_rows;

				/* Close statement */
				$stmt -> close();
			}
			catch (Exception $ex)
			{
				fcLog("clsMysql", "Statement: ".$statement);
				if ($params != NULL)
					fcLog("clsMysql", "Parameter: ".implode("-", $params));
				fcLog("clsMysql", $ex->getMessage());
				fcLog("clsMysql", "(".$this->mysqli->errno.") ".$this->mysqli->error);
			}
		}
		else
		{
			fcLog("clsMysql", "Statement: ".$statement);
			if ($params != NULL)
				fcLog("clsMysql", "Parameter: ".implode("-", $params));
			fcLog("clsMysql", "(".$this->mysqli->errno.") ".$this->mysqli->error);
		}

		$this->close();

		return ($id > 0?$id:$rows);
	}

	function vref($arr)
	{
		if (strnatcmp(phpversion(),'5.3') >= 0)
		{	$refs = array();
			foreach($arr as $key => $value) $refs[$key] = &$arr[$key];
			return $refs;
		}
		return $arr;
	}

	function getAffectedRows()
	{
		return $this->affectedrows;
	}
}

?>
