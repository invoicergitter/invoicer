<?php
class controlertransaction extends abstractcontroler
{
	public static function action()
	{
		if(have_user_access())
		{
			$account = unserialize($_SESSION['account']);
			$table = "<center><table class=\"summary\"><thead><th>Date</th><th>Nom</th><th>Adresse</th><th>Montant</th><th>Etat</th></thead>";
			$transaction = new transaction();
			$transactions = $transaction->all(array('id_account' => $account->id));
			if(empty($transactions))
			{
				$GLOBALS['articles'][] = theme::showsuccess("il n'y a aucune transaction programmée");
			}
			else 
			{
				foreach($transactions as $t)
				{
					$tenant = new tenant();
					$tenant->load(array('id'=> $t->id_tenant));
					if($tenant->id > 0)
					{
						$table .= "<tr class=\"user\" value=\"".$t->id."\" ><td>".$t->date_begin."</td><td>".$tenant->name."</td><td>".$tenant->address."</td><td>".$t->amount_payable."</td><td>".(($t->status == 1)?"payé":"en cours")."</td></tr>";
					}
					else
					{
						log::errorTransaction("la transaction id:".$t->id." n'est associé à aucun tenant");
					}
				}
			}	
			$table .= "</table></center>";
		}	
		elseif(have_tenant_access())
		{
			$tenant = unserialize($_SESSION['tenant']);
			$table = "<center><table class=\"summary\"><thead><th>Date</th><th>Information</th><th>Montant</th><th>Etat</th></thead>";
			$transaction = new transaction();
			$transactions = $transaction->all(array('id_tenant' => $tenant->id));
			if(empty($transactions))
			{
				$GLOBALS['articles'][] = theme::showsuccess("il n'y a aucune transaction programmée");
			}
			else
			{
				foreach($transactions as $t)
				{
					$ttenant = new tenant();
					$tenant->load(array('id'=> $t->id_tenant));
					$table .= "<tr class=\"tenant\" value=\"".$t->id."\" ><td>".$t->date_begin."</td><td>".$t->libelle."</td><td>".$t->amount_payable."</td><td>".(($t->status == 1)?"payé":"en cours")."</td></tr>";
				}
			}
			$table .= "</table></center>";
		}	
		else 
		{
			cassetoi();
		}
		$GLOBALS['articles'][] = $table;
	}
}