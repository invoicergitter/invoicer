<?php
/*
  Copyright (C)  2014 Abdelrhamane benhammou
*/
class controlerhome extends controler
{
	public static function action()
	{
		if( isset($_SESSION['account']) and isset($_SESSION['tenant']) )
		{
			$tenant = unserialize($_SESSION['tenant']);
			$GLOBALS['articles'][] = theme::showsuccess("bonjour ".$tenant 	->name);
		
		}
		elseif( isset($_SESSION['account']) and isset($_SESSION['user']) )
		{
				$user = unserialize($_SESSION['user']);
				$GLOBALS['articles'][] = theme::showsuccess("bonjour ".$user->firstname." ".$user->lastname);
				$GLOBALS['articles'][] = array("type"=>"block","data"=>"<p>vous souhaiter réclamer un nouveau loyer : <a href=\"".urlpage("addtransaction")."\">ici</a></p>");
		}
		else 
		{
			$GLOBALS['articles'][] = "<div class=\"media col-lg-12\">
					  					<div class=\"media-body pull-left\">
					    						<h3 class=\"media-heading\">La gestion de bien immobilier ne sera plus jamais pareil.</h3>
												<h4>payer simplement votre loyer sur internet. Plus d'information, vous êtes ?</h4>
					 				    </div>
									</div>";
			
			$GLOBALS['articles'][] =  array("type"=>"simple" ,'data' => "
							<div class=\"row\">
									<center><div class=\"col-md-4 pull-middle\">
  											<img class=\"img img-thumbnail\" src=\"".$GLOBALS['param']['link_style_rep']."images/present-tenant.jpg\" alt=\"tenant\" style=\"width: 140px; height: 140px;\" />
											<h2>Locataire</h2>	<br>
											payer votre loyer en ligne<br>
											<a class=\"btn btn-success\" role=\"button\" href=\"".urlpage("presentation&visitor=entreprise")."\">plus d'info</a>
									</div>
									<div class=\"col-md-4 pull-center\">
											<img  class=\"img img-thumbnail\" src=\"".$GLOBALS['param']['link_style_rep']."images/present-owner.jpg\" alt=\"homeowner\" style=\"width: 140px; height: 140px;\" />
  											<h2>Propriétaire</h2><br>
											gérer vos biens immobilier simplement<br>
											<a class=\"btn btn-success\" role=\"button\" href=\"".urlpage("presentation&visitor=entreprise")."\">plus d'info</a>
									</div>
									<div class=\"col-md-4 pull-center\">
											<img class=\"img img-thumbnail\" src=\"".$GLOBALS['param']['link_style_rep']."images/present-notaire.jpg\" alt=\"entreprise\" style=\"width: 140px; height: 140px;\" />
  											<h2>Entreprise</h2><br>
											Notaire, Agence immobiliaire<br>
											ce site vous est aussi destiné <br>
											<a class=\"btn btn-success\" role=\"button\" href=\"".urlpage("presentation&visitor=entreprise")."\">plus d'info</a>
									</div></center>
							</div><br><hr><br><br>
									 ");
		}
	}
}