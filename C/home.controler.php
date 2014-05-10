<?php
class controlerhome extends abstractcontroler
{
	public static function action()
	{
		if( isset($_SESSION['account']) and isset($_SESSION['tenant']) )
		{
			$tenant = unserialize($_SESSION['tenant']);
			$GLOBALS['articles'][] = theme::showsuccess("bonjour ".$tenant 	->name);
		
		}
		elseif( isset($_SESSION['account']) and isset($_SESSION['user']) )
		{
				$user = unserialize($_SESSION['user']);
				$GLOBALS['articles'][] = theme::showsuccess("bonjour ".$user->firstname." ".$user->lastname);
				$GLOBALS['articles'][] = "<p>vous souhaiter réclamer un nouveau loyer : <a href=\"".urlpage("addtransaction")."\">ici</a></p>";
		}
		else 
		{
			$GLOBALS['articles'][] = "HOME PAGE";
		}
	}
}