<?php

Class menu {
	
	public static function gridMenu() {
		
		$menu = array();
		$menu["home"] = array('name' => ucfirst(voc('home')), 'sub' => array("lien1" =>"action1","lien2" =>"action2"));
		$menu["signup"] = array('name' => ucfirst('Signup'), 'sub' => array("lien1" =>"créer un compte ","lien2" =>"desinscrire ","lien3" =>"demander aide"));
		$menu["contact"] = array('name' => ucfirst('Contact Us'), 'sub' => array("newsletter" => "newsletter"));
		
		if (!isset($_SESSION['user']))
		{
			$menu["login"] = array('name' => ucfirst('Login'), 'sub' => array());
		}
		else 
		{
			$menu["logout"] = array('name' => ucfirst('Logout'), 'sub' => array());
			
		}	
		return $menu;
	}
}
?>