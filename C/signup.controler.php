<?php
class controlersignup extends abstractcontroler
{
	public static function action()
	{
		
		if(isset($_POST['signup_account']))
		{
			
			$account = new account();
			$user = new user();
			
			$user->load(array('mail' => $_POST['signup_mail']));
			$account->load(array('mail' => $_POST['signup_mail']));
			if ($account->id == 0 and $user->id == 0)
			{
				$account->mail = $_POST['signup_mail'];
				$account->name = $_POST['signup_name'];
				
				$user->lastname = $_POST['signup_lastname'];
				$user->firstname = $_POST['signup_firstname'];
				$user->mail = $_POST['signup_mail'];
				$user->mdp = $_POST['signup_mdp'];
				
				$account->insert();
				if ($account->id > 0)
				{
					$user->id_account = $account->id;
					$user->insert();
					if ($user->id > 0)
					{
						$_SESSION['articles'][] = "<center><p style=\"color:green;\">new account created</p></center>";
					}
					else 
					{
						$_SESSION['articles'][] = "<center><p style=\"color:red;\">la création de compte est actuellemet indisponible</p></center>";
						log::errorDB("error  user not inserted but account yes");
					}
				}
				else
				{
					$_SESSION['articles'][] = "<center><p style=\"color:red;\">la création de compte est actuellemet indisponible</p></center>";
					log::errorDB("error account not inserted");
				}
				
			}
			else
			{
				$_SESSION['articles'][] = "<center><p style=\"color:red;\">un compte est déja créé avec cette adresse mail</p></center>";
			}			      
			
		}
		$_SESSION['articles'][] = theme::signup();
	}
}