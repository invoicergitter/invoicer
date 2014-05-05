<?php
class controlerlogin extends abstractcontroler
{
	public static function action()
	{
		if(isset($_REQUEST['login_mail']) and isset($_REQUEST['login_psw']))
		{
			$user = new user();
			echo md5($_REQUEST['login_psw']) ;
			$user->load( array('mail' => $_REQUEST['login_mail'] , 'psw' => md5($_REQUEST['login_psw'])));
			
			if ($user->id > 0) {
				$account = new account();
				$account->load(array('id' => $user->id_account));
				echo "id = ".$account->id;
				if($account->id > 0)
				{
					$_SESSION['user'] = serialize($user);
					$_SESSION['account'] = serialize($account);
					header('location:index.php');
				}
				else
				{
					$GLOBALS['articles'][] = theme::showfail("aucun compte associé à votre adresse mail");
				}
			}
			else {
				$GLOBALS['articles'][] = theme::showfail("identifiant ou mot de passe incorrect");
			}
		}
		$GLOBALS['articles'][] = theme::login();
	}
}