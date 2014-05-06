<?php
class controlerowner extends abstractcontroler
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
		else 
		{
			
		}
		$GLOBALS['articles'][] = "<img class=\"img_presentation\"src=\"".$GLOBALS['param']['link_style_rep']."images/homeowner.jpg\" alt=\"Propriétaire\"/>";
		$GLOBALS['articles'][] = theme::login("owner");
		$GLOBALS['articles'][] = theme::signupowner();
	}
}