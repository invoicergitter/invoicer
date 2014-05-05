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
				$user->psw = $_POST['signup_mdp'];
				
				$account->insert();
				if ($account->id > 0)
				{
					$user->id_account = $account->id;
					$user->insert();
					if ($user->id > 0)
					{
						$GLOBALS['articles'][] = log::showsuccess("new account created");
					}
					else 
					{
						
						$GLOBALS['articles'][] = log::showfail("la création de compte est actuellemet indisponible");
						log::errorDB("error  user not inserted but account yes");
					}
				}
				else
				{
					$GLOBALS['articles'][] = log::showfail("la création de compte est actuellemet indisponible");
					log::errorDB("error account not inserted");
				}
				
			}
			else
			{
				
				$GLOBALS['articles'][] = log::showfail("un compte est déja créé avec cette adresse mail");
			}			      
			
		}
		elseif (isset($_POST['signup_tenant']))
		{
			$account = new account();
			$account->load(array('id' => $_POST['signup_code_owner'] ));
			
			$tenant = new tenant();
			$tenant->load( array('mail' => $_POST['signup_mail']));
			
			
			
			if($tenant->id <= 0)
			{
				if ($account->id > 0)
				{
					$tenant->address = $_POST['signup_address'];
					$tenant->psw = $_POST['signup_mdp'];
					$tenant->country = $_POST['signup_country'];
					$tenant->id_account = $account->id;
					$tenant->mail = $_POST['signup_mail'];
					$tenant->name = $_POST['signup_name'];
					$tenant->insert();
					
					if ($tenant->id > 0)
					{
						$GLOBALS['articles'][] = log::showsuccess("new account created");
					}
					else 
					{
						$GLOBALS['articles'][] = log::showfail("");
					}
				}
				else
				{
					$GLOBALS['articles'][] = log::showfail("le code du propriétaire n'existe pas");
				}
			}
			else 
			{
				$GLOBALS['articles'][] = log::showfail("un compte utilise déja cette adresse mail");
			}
		}
		$GLOBALS['articles'][] = theme::signup();
	}
}