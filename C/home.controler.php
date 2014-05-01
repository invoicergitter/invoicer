<?php
class controlerhome extends abstractcontroler
{
	public static function action()
	{
		$_SESSION['articles'][] = "<p>je suis la page d'accueil blablabla</p>";
	}
}