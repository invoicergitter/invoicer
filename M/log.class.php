<?php
class log
{
	public static function errorDB($msg)
	{
		$link = $GLOBALS['param']['link_data']."log/db.log";
		$msg = date("d-m-Y h:m:s",time()). "  //  ".$msg."\n";
		self::write($link, $msg);
		if($GLOBALS['param']['mail_error_db'])
		{
			mail("abdelrhamane@invoicer.fr", "bot : bd error", $msg);
		}
	}
	
	public static function newAccount($name,$formule,$mail)
	{
		$link = $GLOBALS['param']['link_data']."log/user.log";
		$msg  =" new account name : ".$name.", mail : ".$mail.", formule ".$formule;
		$msg = date("d-m-Y h:m:s",time()). "  //  ".$msg."\n";
		self::write($link, $msg );
		
		if($GLOBALS['param']['mail_new_account'])
		{
			mail("abdelrhamane@invoicer.fr", "bot : new account", $msg);
		}
	}
	
	public static function errorTransaction($msg)
	{
		$link = $GLOBALS['param']['link_data']."log/transaction.log";
		$msg = date("d-m-Y h:m:s",time()). "  //  ".$msg."\n";
		self::write($link, $msg);
		
		if($GLOBALS['param']['mail_error_transaction'])
		{
			mail("abdelrhamane@invoicer.fr", "bot : new account", $msg);
		}
	}
	
	private static function write($link,$msg)
	{
		file_put_contents($link, $msg , FILE_APPEND);
	} 
}