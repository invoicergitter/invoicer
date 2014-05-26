<?php
/*
  Copyright (C)  2014 Abdelrhamane benhammou
*/
class controlerpaiement extends controler
{
	public static function action()
	{
		if (!have_tenant_access())
		{
			log::errorTransaction("tentative d'accés a l'ajout de transaction d'un non autorisé");
			cassetoi();
		}
		
		$GLOBALS['articles'][] = array('type'=> "border",'data' => theme::Title("Payer une facture"));
		$GLOBALS['articles'][] = array("type"=>"block","data"=>theme::formpaiement());
	}
}