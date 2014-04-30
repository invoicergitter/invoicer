<?php

Class menu {
	
	public static function gridMenu() {
		
		return array( "home" => array('name' => ucfirst(voc('home')), 'sub' => array("lien1" =>"action1","lien2" =>"action2"))
					, "signup" => array('name' => ucfirst('Signup'), 'sub' => array("lien1" =>"action1"))
					, "login" => array('name' => ucfirst('Login'), 'sub' => array("lien1" =>"action1","lien2" =>"action2"))
					, "contact" => array('name' => ucfirst('Contact Us'), 'sub' => array())
					);
	}
}
?>