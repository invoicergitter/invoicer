<?php
class controler404 extends abstractcontroler
{
	public static function action()
	{
		$_SESSION['articles'][] = "<h3>page introuvable</h3>";
	}
}