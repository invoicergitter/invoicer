<?php
class controler404 extends abstractcontroler
{
	public static function action()
	{
		$GLOBALS['articles'][] = "<h3>page introuvable</h3>";
	}
}