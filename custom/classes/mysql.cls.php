<?php

/*
if (class_exists('clsMysql'))
{
	class clsCustMysql extends clsMysql
	{
		function getRezAuth($user, $statement, $types = NULL, $params = NULL)
		{
			$stat = $user->getStatus();
			switch($stat)
			{
				case 0:
					//Gast
					$auth = "rez_status = 1 AND rez_id NOT IN (SELECT rez_id from ayce_kategorie JOIN ayce_rezept_kategorien on ayce_kategorie.kat_id = ayce_rezept_kategorien.kat_id WHERE kat_status IN (3, 4))";
					break;
				case 1:
					//Mitglied
					$auth = "(rez_status = 1 OR rez_status = 2 AND ben_id = ".$user->getId().") AND rez_id NOT IN (SELECT rez_id from ayce_kategorie JOIN ayce_rezept_kategorien on ayce_kategorie.kat_id = ayce_rezept_kategorien.kat_id WHERE kat_status IN (3, 4))";
					break;
				case 2:
					//Moderator
					$auth = "(rez_status = 1 OR rez_status = 2 AND ben_id = ".$user->getId()." OR rez_status = 4) AND rez_id NOT IN (SELECT rez_id from ayce_kategorie JOIN ayce_rezept_kategorien on ayce_kategorie.kat_id = ayce_rezept_kategorien.kat_id WHERE kat_status IN (3))";
					break;
				case 3:
					//Spezial
					$auth = "(rez_status = 1 OR rez_status = 2 AND ben_id = ".$user->getId()." OR rez_status = 3) AND rez_id NOT IN (SELECT rez_id from ayce_kategorie JOIN ayce_rezept_kategorien on ayce_kategorie.kat_id = ayce_rezept_kategorien.kat_id WHERE kat_status IN (4))";
					break;
				case 4:
					//Administrator
					break;
			}
				
			if ($auth != "")
			{
				$whereauth = "WHERE ".$auth;
				$andauth = "AND (".$auth.")";
			}
			
			$statement = str_replace("{WHEREAUTH}", $whereauth, $statement);
			$statement = str_replace("{ANDAUTH}", $andauth, $statement);
			
			$values = $this->get($statement, $types, $params);
			
			return $values;
		}
	}
}
*/

?>
