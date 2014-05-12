<?php
class db
{
	function __construct()
	{	
	}
		
	public function query($query)
	{
		$return = array();
		$connnection = mysqli_connect($GLOBALS['param']['db_host'], $GLOBALS['param']['db_user'], $GLOBALS['param']['db_psw'], $GLOBALS['param']['db_name']);
		if($connnection)
		{
			$result = $connnection->query($query);
			
			while(($data = mysqli_fetch_assoc($result)))
			{
				$return[] = $data;
			}
			$result->close();
			mysqli_close($connnection);
			return $return;
		}
		return false;
	}
	
	public function exec($query)
	{
		$connnection = mysqli_connect($GLOBALS['param']['db_host'], $GLOBALS['param']['db_user'], $GLOBALS['param']['db_psw'], $GLOBALS['param']['db_name']);
		if($connnection)
		{
			$result = mysqli_query($connnection, $query);
			$ligne = mysqli_affected_rows($connnection);
			$id = ($ligne>0)?mysqli_insert_id($connnection):0;
			mysqli_close($connnection);
			return $id;
		}
			
		return 0;
	}
	
	private function encode($str)
	{
		return htmlspecialchars(addslashes(trim($str)));
	}
	
	public static function getWhere($array = array())
	{
		if (empty($array))
		{
			return "";
		}
		else 
		{
			$where = array();
			foreach($array as $col => $val)
			{
				$where[] = "`".$col."` = '".$val."' ";
			}
			return  "WHERE ".join(" and ",$where);
		}
	}
}