<?php
/*
  Copyright (C)  2014 Abdelrhamane benhammou
*/
class account extends table
{
	
	public 	$name = "";
	public	$id_formule = 0;
	public	$date ;
	public	$check = 0;
	public	$iban = "0";
	public  $mail = "";

	public function __construct($id = null)
	{
		parent::__construct("accounts",__CLASS__);
		
		$this->date = date( "Y-m-d",time());
		
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
					`id` ,`name` ,`id_formule` ,`date` ,`check` ,`iban`,`mail`)
				VALUES ( NULL , '".$this->name."' , ".$this->id_formule." , '".$this->date."' , ".$this->check." , '".$this->iban."' , '".$this->mail."' );";
		
		$this->id = $db->exec($query);
		log::newAccount($this->name, $this->id_formule, $this->mail);		
	}
	
	public function update()
	{
		$db = new db();
		$query = "UPDATE ".$this->table." SET `name`= '".$this->name."',`id_formule`='".$this->id_formule."',`date`='".$this->date."',`check`='".$this->check."',`iban`='".$this->iban."' ,`mail`='".$this->mail."' WHERE `id` = ".$this->id;
		$result = $db->exec($query);
		
		return ($result > 0)?true:false;
	}
	
}