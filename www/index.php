<?php
session_start();
/*
 * define special param before include.php
 */
include "include.php";
$page = "home";
if (isset($_GET['page']))
{
	$page = $_GET['page'];
}
		
$GLOBALS['articles'] = array();
		
/*
 * try to load controler$page if not exist load controler404
 */
$nameclasscontroler = "controler".$page;
		
if(!class_exists($nameclasscontroler))
{
	$nameclasscontroler = "controler404";
}
				
/*
 * call the controler
 */
$nameclasscontroler::action();
		
		
/*
 * return the view to index or if ajax request, it displays result
 */
if (isset($_REQUEST['ajax']) and $_REQUEST['ajax'] == 1)
{
	foreach($GLOBALS['articles'] as $article)
	{
		echo utf8_decode($article);
	}
	exit(0);
	}
	
$theme = new Theme($page);
foreach($GLOBALS['articles'] as $articles)
{
	$theme->addArticle($articles);
}
$theme->built();
?>