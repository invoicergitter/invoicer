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
	public  $code ;
	public  $tel ;

	public function __construct($id = null)
	{
		parent::__construct("tenants",__CLASS__);
		
		$this->date = date( "Y-m-d",time());
		$this->code = md5(time());
		if ($id != null and is_int($id))
		{
			$this->load('id',$id);
		}
	}
	
	public function insert()
	{
		$db = new db();
		$query = "
				INSERT INTO ".$this->table." (
					`id` ,`name` ,`address` ,`country` ,`id_account` ,`mail`,`psw`  ,`date`, `code`, `tel`)
				VALUES ( NULL , '".$this->name."' , '".$this->address."' , '".$this->country."' , ".$this->id_account." , '".$this->mail."' , '".md5($this->psw)."' , '".$this->date."' , '".$this->code."' '".$this->tel."' );";
		
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