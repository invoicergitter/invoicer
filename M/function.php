<?php
function voc($str)
{
	if(array_key_exists($str, $GLOBALS['voc']))
	{
		return $GLOBALS['voc'][$str];
	}
	else 
	{
		throw new Exception($str." undefined in voc");
	}
}


function urlpage($page)
{
	return "../C/whatshow.php?page=".$page;
}