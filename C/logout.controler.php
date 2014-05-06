<?php
class controlerlogout extends abstractcontroler
{
	public static function action()
	{
		
					unset($_SESSION['user']);
					unset($_SESSION['account']);
					session_destroy();
					header('location:index.php');
	}
}