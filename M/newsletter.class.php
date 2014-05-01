<?php
class newsletter extends table
{
	
	public 	$name = null;
	public	$mail = "";
	public	$tenant = 0;
	public	$company = 0;
	public	$homeowner = 0;
	public  $code = "";

	public function __construct($id = null)
	{
		parent::__construct("newsletter");
		
		$this->date = date( "Y-m-d",time());
		
		if ($id != null and is_int($id))
		{
			$this->load('id',$id);
		}
	}
	
	public function load($array)
	{
		$result = parent::load($array);
		if($result)
		{
			$this->name = isset($result['name'])?$result['name']:$this->name;
			$this->mail = isset($result['mail'])?$result['mail']:$this->mail;
			$this->id = isset($result['id'])?$result['id']:$this->id;
			$this->tenant = isset($result['tenant'])?$result['tenant']:$this->tenant;
			$this->company = isset($result['company'])?$result['company']:$this-company;
			$this->homeowner = isset($result['homeowner'])?$result['homeowner']:$this->homeowner;
			$this->code = isset($result['code'])?$result['code']:$this->code;
		}
	}
	public function all()
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
					`id` ,`name` ,`mail` ,`tenant` ,`company` ,`homeowner`)
				VALUES (
					NULL , '".$this->name."' , '".$this->mail."',  '".$this->tenant."','".$this->company."', '".$this->homeowner."');";
		$this->id = $db->exec($query);
	}
	
	public function update()
	{
		$db = new db();
		$query = "UPDATE ".$this->table." SET `name`= '".$this->name."',`mail`='".$this->mail."',`tenant`='".$this->tenant."',`company`='".$this->company."',`homeowner`='".$this->homeowner."',`code`='".$this->code."' WHERE `id` = ".$this->id;
		$result = $db->exec($query);
		return ($result > 0)?true:false;
	}
	
}