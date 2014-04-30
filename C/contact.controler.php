<?php
class controler extends abstractcontroler
{
	public static function action()
	{
		$_SESSION['articles'][] = "<p>nous prendrons contact avec vous</p>";
		$_SESSION['widgets'][] = "<p>widgetssssss</p>";
	}
}