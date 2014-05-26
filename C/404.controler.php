<?php
/*
  Copyright (C)  2014 Abdelrhamane benhammou
*/
class controler404 extends controler
{
	public static function action()
	{
		$GLOBALS['articles'][] = array("type"=>"block","data"=>"<h3>erreur 404 : page introuvable</h3>");
	}
}