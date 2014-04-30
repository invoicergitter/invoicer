<?php
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

if(file_exists($page.".controler.php"))
{
	include $page.".controler.php";
}
else
{
	include "404.controler.php" ;
}

controler::action();

header('location:../www/index.php');