<?php
class controlertenant extends abstractcontroler
{
	public static function action()
	{
		
		if (isset($_POST['signup_tenant']))
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
					$GLOBALS['articles'][] = log::showfail("le code du propri�taire n'existe pas");
				}
			}
			else 
			{
				$GLOBALS['articles'][] = log::showfail("un compte utilise d�ja cette adresse mail");
			}
		}
		else 
		{
			
		}
		$GLOBALS['articles'][] = "<img class=\"img_presentation\"src=\"".$GLOBALS['param']['link_style_rep']."images/tenant.jpg\" alt=\"Locataire\"/>";
		$GLOBALS['articles'][] = theme::login("tenant");
		$GLOBALS['articles'][] = theme::signuptenant();
	}
}