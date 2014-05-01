<?php
class formule extends table
{
	
	public 	$name = "";
	public	$permonth = 0;
	public	$peruser = 0;
	public	$feature = "";
	public 	$maxuser = 0;

	public function __construct($id = null)
	{
		parent::__construct("formules");
				
		if ($id != null and is_int($id))
		{
			$this->load('id',$id);
		}
	}
	
	public function load($array)
	{
		/*
		 * TO DO IMPLEMENTED
		*/
	}
	
	public function insert()
	{
		$db = new db();
		$query = "
				INSERT INTO ".$this->table." (
					`id` ,`name` ,`permonth` ,`peruser` ,`feature` `maxuser`)
				VALUES (
					NULL , '".$this->name."' , '".$this->permonth."',  '".$this->peruser."','".$this->feature."' ,'".$this->maxuser."');";
		$this->id = $db->exec($query);
	}
	
	public function update()
	{
		$db = new db();
		$query = "UPDATE ".$this->table." SET `name`= '".$this->name."',`permonth`='".$this->permonth."',`peruser`='".$this->peruser."',`feature`='".$this->feature."' ,`maxuser`='".$this->maxuser."' WHERE `id` = ".$this->id;
		$result = $db->exec($query);
		
		return ($result > 0)?true:false;
	}

	
	public function all()
	{
		$db = new db();
		$query = "SELECT * FROM ".$this->table;
		$result = $db->query($query);
		return $result;
	}
}