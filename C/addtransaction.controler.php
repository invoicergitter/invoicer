<?php
class controleraddtransaction extends abstractcontroler
{
	public static function action()
	{
		if (!have_user_access())
		{
			log::errorTransaction("tentative d'accés a l'ajout de transaction d'un non autorisé");
			cassetoi();
		}
		$account = unserialize($_SESSION['account']);
		$user = unserialize($_SESSION['user']);
		if (isset($_POST['tenant']))
		{
			if(!isset($_POST['amount']) or empty($_POST['amount']) )
			{
				$GLOBALS['articles'][] = theme::showfail("le montant n'est pas saisie");
			}
			elseif(!isset($_POST['levy']) or empty($_POST['levy']))
			{
				$GLOBALS['articles'][] = theme::showfail("la date de prélévement n'est pas saisie");
			}
			else 
			{
				$nbinserted = 0;
				foreach ($_POST['tenant'] as $id_tenant)
				{
					$tenant = new tenant();
					$tenant->load(array('id' => $id_tenant));
					if($tenant->id > 0)
					{
						if ($tenant->id_account != $account->id)
						{
							log::errorTransaction("utilisateur non autorisé a tenter de créer une transaction iduser :".$user->id);
							cassetoi();
						}
						$transaction = new transaction();
						$transaction->amount_payable = $_POST['amount'];
						$transaction->date_begin = $_POST['levy'];
						$transaction->date_end = isset($_POST['reminder'])?$_POST['reminder']:0;
						$transaction->libelle = isset($_POST['comment'])?$_POST['comment']:"";
						$transaction->id_tenant = $tenant->id;
						$transaction->id_account = unserialize($_SESSION['account'])->id;
						$transaction->insert();						
						if ($transaction->id > 0)
						{
							$nbinserted++;
						}
						$GLOBALS['articles'][] = theme::showsuccess("il y a ".$nbinserted." transaction(s) enregistrées");
					}
				}	
			}
		}
		$GLOBALS['articles'][] = "<p>ajouter une nouvelle transaction</p>";
		$GLOBALS['articles'][] = theme::formaddtransaction();
	}
}