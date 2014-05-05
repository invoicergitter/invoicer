<?php
class tenant extends table
{
	
	public 	$name = "";
	public	$address = 0;
	public	$country = "NULL";
	public	$id_account = 0;
	public	$mail = "";
	public  $psw = "";
	public  $date ;
	public  $check = 0;

	public function __construct($id = null)
	{
		parent::__construct("tenants");
		
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
			$this->address = isset($result['address'])?$result['address']:$this->address;
			$this->country = isset($result['country'])?$result['country']:$this->country;
			$this->id_account = isset($result['id_account'])?$result['id_account']:$this->id_account;
			$this->mail = isset($result['mail'])?$result['mail']:$this->mail;
			$this->psw = isset($result['psw'])?$result['psw']:$this->psw;
			$this->date = isset($result['date'])?$result['date']:$this->date;
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
					`id` ,`name` ,`address` ,`country` ,`id_account` ,`mail`,`psw`  ,`date`)
				VALUES ( NULL , '".$this->name."' , '".$this->address."' , '".$this->country."' , ".$this->id_account." , '".$this->mail."' , '".md5($this->psw)."' , '".$this->date."' );";
		
		$this->id = $db->exec($query);	
	}
	
	public function update()
	{
		$db = new db();
		$query = "UPDATE ".$this->table." SET `name`= '".$this->name."' ,`check`='".$this->check."' ,`mail`='".$this->mail."' ,`address`='".$this->address."' ,`country`='".$this->country."'   WHERE `id` = ".$this->id;
		$result = $db->exec($query);
		
		return ($result > 0)?true:false;
	}
	
}