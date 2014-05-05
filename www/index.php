<?php
session_start();
/*
 * you must define special param before include.php
 */
include "include.php";

if(isset($_GET['c']) and $_GET['c'] == $GLOBALS['param']['online_exception_pass'])
{
	$_SESSION['online'] = true;
}

if ((isset($GLOBALS['param']['online']) and $GLOBALS['param']['online']) or (isset($_SESSION['online'])))
{
	
	
		$page = "home";
		if (isset($_GET['page']))
		{
			$page = $_GET['page'];
		}
		
		$GLOBALS['articles'] = array();
		$GLOBALS['widgets'] = array();
		
		
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
			foreach($GLOBALS['articles'] as $article)
			{
				echo utf8_encode($article);
			}
			exit(0);
		}
		
	
		$theme = new Theme($page);
		foreach($GLOBALS['articles'] as $articles)
		{
			$theme->addArticle($articles);
		}

		if(isset($GLOBALS['widgets']))
		{
			foreach($GLOBALS['widgets'] as $widget)
			{
				$theme->addWidget($widget);
			}
		}
		$theme->built();
			
}
else 
{
	header('location:maintenance.html');
}


?>