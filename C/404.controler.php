<?php
class controler404 extends controler
{
	public static function action()
	{
		$GLOBALS['articles'][] = "<h3>erreur 404 : page introuvable</h3>";
	}
}