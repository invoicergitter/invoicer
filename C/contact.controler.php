<?php
class controlercontact extends abstractcontroler
{
	public static function action()
	{
		$GLOBALS['articles'][] = "<p>nous prendrons contact avec vous</p>";
		$GLOBALS['widgets'][] = "<p>widgetssssss</p>";
	}
}