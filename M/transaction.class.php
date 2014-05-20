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
	
	public function form()
	{
		$tenant = new tenant();
		$tenant->load(array('id' => $this->id_tenant));
		$form = "<br><form class=\"modif\" method=\"POST\" action=\"\" ><table>";
		$form .= "<tr><td>Nom locataire : </td><td>".$tenant->name."</td></tr>";
		$form .= "<tr><td>à payé le : </td><td><input type=\"text\" name=\"amount\" value=\"".$this->date_begin."\" /></td></tr>";
		$form .= "<tr><td>commencer les rappels le : </td><td><input type=\"text\" name=\"amount\" value=\"".$this->date_end."\" /></td></tr>";
		$form .= "<tr><td>montant : </td><td><input type=\"text\" name=\"amount\" value=\"".$this->amount_payable."\" /></td></tr>";
		$form .= "<tr><td>montant payé : </td><td> ".(isset($this->amount_paid)?$this->amount_paid:0)."€</td></tr>";
		$form .= "<tr><td>commentaire : </td><td><textarea name=\"libelle\">".$this->libelle."</textarea></td></tr>";
		$form .= "</table><form>";
		return $form;
	}
	
}