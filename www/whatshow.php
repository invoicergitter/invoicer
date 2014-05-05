<?php
/**
 * 
 */
session_start();
require "include.php";


/*
 * define the relevant page with order
 */

$page = "home";
if (isset($_GET['page']))
{
	$page = $_GET['page'];
}
elseif (isset($_SESSION['page']))
{
	$page = $_SESSION['page'];
}

$_SESSION['page'] = $page;
$_SESSION['articles'] = array();
$_SESSION['widgets'] = array();


/*
 * try to load controler$page if not exist load controler404
 */
if(file_exists("../C/".$page.".controler.php"))
{
	include "../C/".$page.".controler.php";
	$nameclasscontroler = "controler".$page;
}
else
{
	include "../C/404.controler.php" ;
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
	foreach($_SESSION['articles'] as $article)
	{
		echo utf8_encode($article);
	}
	exit(0);
}
else
{
	header('location:index.php');
}
