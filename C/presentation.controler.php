<?php
class controlerpresentation extends controler
{
	public static function action()
	{
		$GLOBALS['articles'][] = array("type"=>"block","data"=>"<h3>presetation blabla</h3>");
	}
}