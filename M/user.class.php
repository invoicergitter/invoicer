<?php
class user extends table
{
	
	public 	$firstname = "";
	public	$lastname = "";
	public	$mail ="";
	public	$psw = "";
	public	$id_account = 0;
	public  $access = 0;
	public  $date;

	public function __construct($id = null)
	{
		parent::__construct("users");
		
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
			$this->firstname = isset($result['firstname'])?$result['firstname']:$this->firstname;
			$this->lastname = isset($result['lastname'])?$result['lastname']:$this->lastname;
			$this->id = isset($result['id'])?$result['id']:$this->id;
			$this->id_account = isset($result['id_account'])?$result['id_account']:$this->id_account;
			$this->access = isset($result['access'])?$result['access']:$this->access;
			$this->mail = isset($result['mail'])?$result['mail']:$this->mail;
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
					`id` ,`firstname` ,`lastname` ,`mail` ,`id_account` ,`access` ,`date`,`psw`)
				VALUES (
					NULL , '".$this->firstname."' , '".$this->lastname."',  '".$this->mail."','".$this->id_account."', '".$this->access."' , '".$this->date."', '".md5($this->psw)."');";
		$this->id = $db->exec($query);
	}
	
	public function update()
	{
		$db = new db($this);
		$query = "UPDATE ".$this->table." SET 
				`firstname`= '".$this->firstname."' ,
				`lastname`='".$this->lastname."',
				`mail`='".$this->mail."',
				`access`='".$this->access."' 
				WHERE `id` = ".$this->id;
		$result = $db->exec($query);
		return ($result > 0)?true:false;
	}
		
}