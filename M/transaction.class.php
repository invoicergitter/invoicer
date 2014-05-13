<?php
class transaction extends table
{
	
	public 	$id_tenant = 0;
	public	$id_account = 0;
	public	$date ="" ;
	public	$amount_payable = 0;
	public	$amount_paid = 0;
	public  $status = 0;
	public  $date_begin = "";
	public  $date_end = "";
	public  $libelle = "";

	public function __construct($id = null)
	{
		parent::__construct("transaction",__CLASS__);		
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
					`id` ,`id_tenant` ,`id_account` ,`amount_payable`, `date_begin`, `date_end`, `status`, `libelle`)
				VALUES ( NULL , '".$this->id_tenant."' , ".$this->id_account." , '".$this->amount_payable."' , '".$this->date_begin."' , '".$this->date_end."' , '".$this->status."' , '".$this->libelle."' );";
		
		$this->id = $db->exec($query);	
		log::Transaction("nouvelle transaction id:".$this->id." montant:".$this->amount_payable." prélever le:".$this->date_begin);
	}
	
	public function update()
	{
		$db = new db();
		$query = "UPDATE ".$this->table." 
				SET `id_tenant`= '".$this->id_tenant."',
					`id_account`='".$this->id_account."',
					`amount_payable`='".$this->amount_payable."',
					`date_begin`='".$this->date_begin."',
					`date_end`='".$this->date_end."' ,
					`status`='".$this->status."' ,
					`libelle`='".$this->libelle."' 
					 WHERE `id` = ".$this->id;
		$result = $db->exec($query);
		
		return ($result > 0)?true:false;
	}
	
}