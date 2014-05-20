<?php
class controlerowner extends controler
{
	public static function action()
	{
		if(isset($_SESSION['user']))
		{
			header('location:'.urlpage("homeowner")); 
		}
		elseif(isset($_SESSION['account']))
		{
			header('location:'.urlpage("home"));
		}
		
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
						
						$GLOBALS['articles'][] = log::showfail("la cr�ation de compte est actuellemet indisponible");
						log::errorDB("error  user not inserted but account yes");
					}
				}
				else
				{
					$GLOBALS['articles'][] = log::showfail("la cr�ation de compte est actuellemet indisponible");
					log::errorDB("error account not inserted");
				}
				
			}
			else
			{
				
				$GLOBALS['articles'][] = log::showfail("un compte est d�ja cr�� avec cette adresse mail");
			}			      
			
		}
		elseif(isset($_POST['owner_mail']) and isset($_POST['owner_psw']) )
		{
			$user = new user();
			$user->load( array('mail' => $_REQUEST['owner_mail'] , 'psw' => md5($_REQUEST['owner_psw'])));
			
			if ($user->id > 0) {
				$account = new account();
				$account->load(array('id' => $user->id_account));
				echo "id = ".$account->id;
				if($account->id > 0)
				{
					$_SESSION['user'] = serialize($user);
					$_SESSION['account'] = serialize($account);
					header('location:'.urlpage("home"));
				}
				else
				{
					$GLOBALS['articles'][] = theme::showfail("aucun compte associ� � votre adresse mail");
				}
			}
			else {
				$GLOBALS['articles'][] = theme::showfail("identifiant ou mot de passe incorrect");
			}
		}
		
		$GLOBALS['articles'][] = array('type'=> 'band', 'data'=>"<center><img class=\"img-responsive\" src=\"".$GLOBALS['param']['link_style_rep']."images/homeowner.jpg\" alt=\"Propri�taire\" /></center><br>");
		$GLOBALS['articles'][] = array('type'=> 'block', 'data'=> theme::login("owner"));
		$GLOBALS['articles'][] = array('type'=> 'block', 'data'=> theme::signupowner());
	}
}