<?php

function fcCustBreadcrumb($sql, $id)
{
    $ret = "";
    $pars[0] = $id;
    $res = $sql->get("SELECT kategorie.name, kategorie.parent_id from kategorie where id = ?", "i", $pars);
    if ($res->num_rows > 0)
    {
        while($row = $res->fetch_array(MYSQLI_ASSOC))
        {
            $ret = fcCustBreadcrumb($sql, $row['parent_id']).' \\ '.$row['name'];
        }
    }

    return $ret;
}

?>