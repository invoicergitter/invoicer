<?php

Class menu {
	
	public static function gridMenu() {
		
		$menu = array();
		$menu["home"] = array('name' => ucfirst(voc('home')), 'sub' => array("lien1" =>"action1","lien2" =>"action2"));
		$menu["tenant"] = array('name' => ucfirst('payer votre loyer en ligne'), 'sub' => array("lien1" =>"créer un compte ","lien2" =>"desinscrire ","lien3" =>"demander aide"));
		$menu["owner"] = array('name' => ucfirst('Propriétaire'), 'sub' => array("advantage" => "les avantages","contact" => "contact","newsletter" => "newsletter"));
		
		if (isset($_SESSION['account']))
		{
				$menu["logout"] = array('name' => ucfirst('Logout'), 'sub' => array());	
		}	
		return $menu;
	}
}
?>