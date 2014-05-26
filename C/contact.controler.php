<?php
/*
  Copyright (C)  2014 Abdelrhamane benhammou
*/
class controlercontact extends controler
{
	public static function action()
	{
		$GLOBALS['articles'][] = array("type"=>"block","data"=>"<p>nous prendrons contact avec vous</p>");
	}
}