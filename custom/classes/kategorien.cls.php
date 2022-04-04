<?php

class clsKategorien
{
    private $id;
    private $name;
    private $idate;
    private $udate;
    private $benutzer;
    private $parent_id;
    private $description;
    private $children;
    private $sql;

    function readChildren()
    {
        $res = $this->sql->get("SELECT id FROM kategorie WHERE parent_id = ?", "i", $this->id);

        if ($res->num_rows > 0)
        {
            while($row = $res->fetch_array(MYSQLI_ASSOC))
            {
                $this->children[] = new clsKategorien($this->sql, $row['id']);
            }
        }
    }

    function __construct($sql, $id)
	{
        $this->id = $id;
        $this->sql = $sql;

        $res = $this->sql->get("SELECT id, name, idate, udate, benutzer_id, parent_id, description FROM kategorie WHERE id = ?", "i", $this->id);

        if ($res->num_rows > 0)
        {
            while($row = $res->fetch_array(MYSQLI_ASSOC))
            {
                
                $this->name = $row['name'];
                $this->idate = $row['idate'];
                $this->udate = $row['udate'];
                $this->benutzer = new clsUser($row['benutzer_id']);
                $this->parent_id = $row['parent_id'];
                $this->description = $row['description'];
            }
        }
        else
        {
            $this->name = "nicht gefunden";
        }
        $this->readChildren();
    }

	function getId()
	{
		return $this->id;
	}    

	function getName()
	{
		return $this->name;
	}    
    
	function getIdate()
	{
		return $this->idate;
	}    
    
	function getUdate()
	{
		return $this->Udate;
	}    
    
	function getBenutzer()
	{
		return $this->benutzer;
	}    

    function getParent()
	{
		return $this->parent_id;
	}    

    function getChildren()
    {
        return $this->children;
    }
}

?>