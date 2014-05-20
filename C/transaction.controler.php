<?php
class controlertransaction extends controler
{
	public static function action()
	{
		if(have_user_access() and isset($_REQUEST['transaction_id']))
		{
			$account = unserialize($_SESSION['account']);			
			$transaction = new transaction();
			$transaction->load(array('id' => $_REQUEST['transaction_id']));
			if ($transaction->id > 0)
			{
				if ($transaction->id_account == $account->id)
				{
					$GLOBALS['articles'][] = theme::Title("Détail transaction").$transaction->form();
				}
				else 
				{
					cassetoi();
				}
			}
			else 
			{
				$GLOBALS['articles'][] = theme::showfail("cette transaction n'existe pas");
			}
			
		}	
		else 
		{
			cassetoi();
		}
		
	}
}