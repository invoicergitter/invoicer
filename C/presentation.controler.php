<?php
/*
  Copyright (C)  2014 Abdelrhamane benhammou
*/
class controlerpresentation extends controler
{
	public static function action()
	{
		$GLOBALS['articles'][] = array("type"=>"block","data"=>"<h3>presetation blabla</h3>");
	}
}