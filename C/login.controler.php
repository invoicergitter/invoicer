<?php
class controler extends abstractcontroler
{
	public static function action()
	{
		$_SESSION['articles'][] = "<p>un utilisateur souhaite se loguer</p>";
	}
}