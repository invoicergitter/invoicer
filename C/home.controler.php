<?php
class controlerhome extends controler
{
	public static function action()
	{
		if( isset($_SESSION['account']) and isset($_SESSION['tenant']) )
		{
			$tenant = unserialize($_SESSION['tenant']);
			$GLOBALS['articles'][] = theme::showsuccess("bonjour ".$tenant 	->name);
		
		}
		elseif( isset($_SESSION['account']) and isset($_SESSION['user']) )
		{
				$user = unserialize($_SESSION['user']);
				$GLOBALS['articles'][] = theme::showsuccess("bonjour ".$user->firstname." ".$user->lastname);
				$GLOBALS['articles'][] = "<p>vous souhaiter réclamer un nouveau loyer : <a href=\"".urlpage("addtransaction")."\">ici</a></p>";
		}
		else 
		{
			$GLOBALS['articles'][] = "<div class=\"media col-lg-12\"><div class=\"pull-right\">
    <iframe width=\"420\" height=\"320\" src=\"//www.youtube.com/embed/YXVoqJEwqoQ\" frameborder=\"0\" allowfullscreen></iframe>
  </div>
  <div class=\"media-body pull-left\">
    <h4 class=\"media-heading\">Faite respecter vos droits de Locataire et Propriétaire</h4>
    tout en image...
  </div>
</div>";
		}
	}
}