<?php
abstract class table 
{
	public $id;
	protected $table;
	
	public function __construct($table)
	{
		$this->id = 0;
		$this->table =$table;
	}
	
	public function load($array = array())
	{
		$query = " SELECT * FROM ".$this->table." WHERE ";
		$where = array();
		foreach($array as $col => $val)
		{
			$where[] = "`".$col."` = '".$val."' ";
		}
		$query .= join(" and ",$where);
		$db = new db();
		$result = $db->query($query);
		if($result != false and !empty($result))
		{
			foreach($result[0] as $col => $val)
			{
				$this->{$col} = $val;
			}			
		}
	}
	
	public abstract function insert();
	public abstract function update();
	public abstract function all();
	public function delete()
	{
		if ($this->id > 0)
		{
			$db = new db($this);
			$query = "DELETE FROM ".$this->table." WHERE `id` = ".$this->id;
			$result = $db->exec($query);
			
			return ($result > 0)?true:false;
		}
		return false;
	}
}