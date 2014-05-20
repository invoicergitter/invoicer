<?php

Class menu {
	
	public static function gridMenu() {
		
		$menu = array();
		$menu["home"] = array('name' => ucfirst(voc('home')), 'sub' => array());
		
		$ownerchoose = array();
		$tenantchoose = array();
		
		if(isset($_SESSION['user']))
		{
			$menu['transactions'] = array('name' => ucfirst('transactions'), 'sub' => array('addtransaction'=>"ajouter loyer",'transactions' => "voir les transactions"));
			$menu['configuration'] = array('name' => ucfirst('configuration'), 'sub' => array());
		}
		elseif(isset($_SESSION['tenant']))
		{
			$menu['transactions'] = array('name' => ucfirst('transactions'), 'sub' => array());
			$menu['configuration'] = array('name' => ucfirst('configuration'), 'sub' => array());
		}
		else 
		{
			$menu["tenant"] = array('name' => ucfirst('payer votre loyer en ligne'), 'sub' => array());
			$menu["owner"] = array('name' => ucfirst('Propriétaire'), 'sub' => array());
		}	
		return $menu;
	}
}
?>