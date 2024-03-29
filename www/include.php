<?php
/*
  Copyright (C)  2014 Abdelrhamane benhammou
*/
require "../param.php";

require "V/lang/".$GLOBALS['param']['lang']."/voc.php";

/*  load abstract class*/
$dh = opendir("../M/abstract");
while(false !== ($filename = readdir($dh)))
{
	if($filename != "." and $filename != "..")
	{
		require '../M/abstract/'.$filename;
	}
}

closedir($dh);

/* load class */
$dh = opendir("../M");
while(false !== ($filename = readdir($dh)))
{
	if($filename != "." and $filename != ".." and $filename != "abstract")
	{
		require '../M/'.$filename;
	}
}
closedir($dh);

require $GLOBALS['param']['link_theme_rep']."/theme.class.php";

/* load all controlers */
$dh = opendir("../C");
while(false !== ($filename = readdir($dh)))
{
	if($filename != "." and $filename != "..")
	{
		require '../C/'.$filename;
	}
}

closedir($dh);