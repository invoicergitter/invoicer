<?php
class controler extends abstractcontroler
{
	public static function action()
	{
		$_SESSION['articles'][] = "<p>ouiiiiiii un nouvelle inscrit</p>";
	}
}