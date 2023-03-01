<?php

if (class_exists('clsUser'))
{
	class clsCustUser extends clsUser
	{
		protected $id;

		function __construct($id = 0)
		{
			if (isset($_SESSION))
				$session = $_SESSION;
			else
				$session = NULL;
			$params = new clsParameter($_POST, $_GET, $_COOKIE, $session);
			$id = $params->get("userid");

			if ($id == 0)
			{
				parent::__construct();
				$this->idate = new DateTime();
				$this->guest = true;
				$this->id = 0;
			}
			else
			{
				$sql = new clsMysql();
				$res = $sql->get("SELECT id, name, idate FROM benutzer where id = ?", "i", $id);
				if ($res->num_rows > 0)
				{
					while($row = $res->fetch_array(MYSQLI_ASSOC))
					{
						$this->id = $row["id"];
						$this->name = $row["name"];
						$this->idate = date_create_from_format("Y-m-d H:i:s", $row["idate"]);

						$this->guest = false;
					}
				}
			}
		}

		function isAuthorized($site)
		{
			GLOBAL $confSitesGuest;
			GLOBAL $confSitesUser;

			if ($this->id < 1)
			{
                if (in_array($site, $confSitesGuest))
                {
	               return true;
                }
                else
                {
                    return false;
                }
			}
			else
			{
                if (in_array($site, $confSitesUser))
                {
                	return true;
                }
                else
                {
                	return false;
				}
			}
		}
	}
}

?>
