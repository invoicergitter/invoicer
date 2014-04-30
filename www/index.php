<?php
session_start();
/*
 * you must define special param before include.php
 */
include "include.php";

/*
 * if there is a article to show else ask to whatshow
 */
if(isset($_SESSION['articles']))
{
	$theme = new Theme($_SESSION['page']);
	foreach($_SESSION['articles'] as $articles)
	{
		$theme->addArticle($articles);
	}
	
	if(isset($_SESSION['widgets']))
	{
		foreach($_SESSION['widgets'] as $widget)
		{
			$theme->addWidget($widget);
		}	
	}
	
	$theme->built();
	unset($_SESSION['widgets']);
	unset($_SESSION['articles']);
}
else
{
	header('location:../C/whatshow.php');
}


?>