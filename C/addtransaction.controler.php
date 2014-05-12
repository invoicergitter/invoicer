<?php
class controleraddtransaction extends abstractcontroler
{
	public static function action()
	{
		$GLOBALS['articles'][] = "<p>ajouter une nouvelle transaction</p>";
		$GLOBALS['articles'][] = theme::formaddtransaction();
	}
}