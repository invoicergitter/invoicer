<?php
class controlertenant extends controler
{
	public static function action()
	{
		if(isset($_SESSION['tenant']))
		{
			header('location:'.urlpage("hometenant"));
		}
		elseif(isset($_SESSION['account']))
		{
			header('location:'.urlpage("home"));
		}
		
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
		elseif(isset($_POST['tenant_mail']) and isset($_POST['tenant_psw']) )
		{
			$tenant = new tenant();
			$tenant->load( array('mail' => $_REQUEST['tenant_mail'] , 'psw' => md5($_REQUEST['tenant_psw'])));
			if ($tenant->id > 0) {
				$account = new account();
				$account->load(array('id' => $tenant->id_account));
				print_r($account);
				if($account->id > 0)
				{
					/*
					 * décommenter pour vérifier les mail
					 *
					 *if($tenant->check > 0)
					{*/
					$_SESSION['tenant'] = serialize($tenant);
					$_SESSION['account'] = serialize($account);
					header('location:'.urlpage("home"));
					/*}
					else
					{
						$mail = new mail($tenant->mail);
						$GLOBALS['articles'][] = $mail->sendcheckmail($tenant->name, $tenant->code);
					}*/
				}
				else
				{
					$GLOBALS['articles'][] = theme::showfail("aucun compte associ� � votre adresse mail");
				}
			}
			else
			{
				$GLOBALS['articles'][] = theme::showfail("identifiant ou mot de passe incorrect");
			}
		}
		$GLOBALS['articles'][] = array('type'=>"band" ,'data' => "<center><img class=\"img-rounded\"src=\"".$GLOBALS['param']['link_style_rep']."images/tenant.jpg\" alt=\"Locataire\"/></center><br>");
		$GLOBALS['articles'][] = array('type'=>"block" ,'data' =>theme::login("tenant"));
		$GLOBALS['articles'][] = array('type'=>"block" ,'data' =>theme::signuptenant()."</center>");
	}
}