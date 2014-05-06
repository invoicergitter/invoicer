<?php
require "../param.php";

require "V/lang/".$GLOBALS['param']['lang']."/voc.php";


$dh = opendir("../M");
while(false !== ($filename = readdir($dh)))
{
	if($filename != "." and $filename != "..")
	{
		require '../M/'.$filename;
	}
}

closedir($dh);

require $GLOBALS['param']['link_theme_rep']."/theme.class.php";

$dh = opendir("../C");
while(false !== ($filename = readdir($dh)))
{
	if($filename != "." and $filename != "..")
	{
		require '../C/'.$filename;
	}
}

closedir($dh);