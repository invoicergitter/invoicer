<?php
class controlerlogout extends controler
{
	public static function action()
	{
		$lang = $_SESSION['lang'];
		unset($_SESSION['user']);
		unset($_SESSION['tenant']);
		unset($_SESSION['account']);
		session_destroy();
		$_SESSION['lang'] = $lang;
		header('location:index.php');
	}
}