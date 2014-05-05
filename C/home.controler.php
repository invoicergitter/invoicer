<?php
class controlerhome extends abstractcontroler
{
	public static function action()
	{
		$GLOBALS['articles'][] = "<p>je suis la page d'accueil blablabla</p>";
	}
}