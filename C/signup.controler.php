<?php
class controlersignup extends abstractcontroler
{
	public static function action()
	{
		
		if(isset($_POST['signup_account']))
		{
			
			$account = new account();
			$account->iban = (isset($_POST['signup_iban']))?$_POST['signup_iban']:0;
			$account->name = $_POST['signup_name'];
			if($account->insert())
			{
				$_SESSION['articles'][] = "<center><p style=\"color:green;\">new account created</p></center>";
			}
			else
			{
				$_SESSION['articles'][] = "<center><p style=\"color:red;\">new account failed</p></center>";
			}
		}
		$_SESSION['articles'][] = theme::signup();
	}
}