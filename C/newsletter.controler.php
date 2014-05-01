<?php
class controlernewsletter extends abstractcontroler
{
	public static function action()
	{
		$return = "<p>";
		if (isset($_REQUEST['a']) and $_REQUEST['a']== 0 and isset($_REQUEST['newsletter_mail']) and !empty($_REQUEST['newsletter_mail']))
		{
			$newsletter = new newsletter();
			$newsletter->load(array('mail' => $_REQUEST['newsletter_mail'] ));
			
			if ($newsletter->id == 0)
			{
				$newsletter->mail = $_REQUEST['newsletter_mail'] ;
				$newsletter->tenant = 1;
				$newsletter->homeowner = 1;
				$newsletter->company = 1;
				$newsletter->insert();
				$return .= "les actualitées seront envoyées à ".$_REQUEST['newsletter_mail'];
			}
			else
			{
				$return .= "l'adresse existe dèja  ".$_REQUEST['newsletter_mail'];
			}
			
			$return .= "</p>" ;
			$_SESSION['articles'][] = $return;
			
		}
		if (isset($_REQUEST['a']) and  $_REQUEST['a']== 777 and isset($_REQUEST['newsletter_mail']) and isset($_REQUEST['c']) and !empty($_REQUEST['newsletter_mail']))
		{
				$newsletter = new newsletter();
				$newsletter->load(array('mail' => $_REQUEST['newsletter_mail'] , 'code' => $_REQUEST['c']));
				if ($newsletter->id > 0)
				{
					$newsletter->delete();
					$return .= "les mails ne seront plus envoyaient à ".$_REQUEST['newsletter_mail'];
				}
				$return .= "</p>";
				$_SESSION['articles'][] = $return;
		}
		else
		{
			$theme = new theme("");
			$_SESSION['articles'][] = $theme->newsletter();
		}
		
	}
}