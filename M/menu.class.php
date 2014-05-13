<?php

Class menu {
	
	public static function gridMenu() {
		
		$menu = array();
		$menu["home"] = array('name' => ucfirst(voc('home')), 'sub' => array("lien1" =>"action1","lien2" =>"action2"));
		
		$ownerchoose = array();
		$tenantchoose = array();
		
		if(isset($_SESSION['user']))
		{
			$menu['transaction'] = array('name' => ucfirst('transaction'), 'sub' => array('addtransaction'=>"ajouter loyer"));
			$menu['configuration'] = array('name' => ucfirst('cofiguration'), 'sub' => array());
		}
		elseif(isset($_SESSION['tenant']))
		{
			$menu['transaction'] = array('name' => ucfirst('transaction'), 'sub' => array('addtransaction'=>"ajouter loyer",'transaction' => "voir les transactions"));
			$menu['configuration'] = array('name' => ucfirst('cofiguration'), 'sub' => array());
		}
		else 
		{
			$menu["tenant"] = array('name' => ucfirst('payer votre loyer en ligne'), 'sub' => array());
			$menu["owner"] = array('name' => ucfirst('Propriétaire'), 'sub' => array());
		}
		
		
		
		if (isset($_SESSION['account']))
		{
				$menu["logout"] = array('name' => ucfirst('Logout'), 'sub' => array());	
		}	
		return $menu;
	}
}
?>