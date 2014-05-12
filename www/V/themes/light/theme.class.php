<?php
class theme extends abstracttheme {
	
	public function __construct($page) {
		parent::__construct($page);
		$this->js[] = "jquery.min.js";
		$this->js[] = "mobile.js";
	}
	
	public static function showfail($msg)
	{
		return "<p style=\"color:red;\">".$msg."</p>";
	}
	public static function showsuccess($msg)
	{
		return "<p style=\"color:green;\">".$msg."</p>";
	}
	
	private function head()
	{
		$head = "<!doctype html>
		<html lang=\"fr\">
		<head>
		<meta charset=\"utf-8\" />
		<title>Biller </title>";
		
		foreach($this->js as $js)
		{
			$head .= "<script src=\"".$GLOBALS['param']['link_theme_rep']."style/js/".$js."\"></script>";
		}
		
		$head .= "<link rel=\"stylesheet\" href=\"".$GLOBALS['param']['link_style_rep']."css/styles.css\" type=\"text/css\" media=\"screen\" />
		<link rel=\"stylesheet\" href=\"".$GLOBALS['param']['link_style_rep']."css/mobile.css\" type=\"text/css\" media=\"screen\" />
		<link rel=\"stylesheet\" type=\"text/css\" href=\"".$GLOBALS['param']['link_style_rep']."css/print.css\" media=\"print\" />
		<!--[if IE]><script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script><![endif]-->
		</head><body>";
		return $head;
	}
	
	private function contents()
	{
		$contents =  "<center><section id=\"main\"><div class=\"border\">";
		foreach ($this->articles as $article)
		{
			$contents .= "<article>".$article."</article>";
		}
		$contents .= "<div></section></center>";
	return $contents;
	}
	
	public static function formaddtransaction()
	{
		$tenant = new tenant();
		$all = $tenant->all();	
		$form = "<div class=\"form\">
					<form method=\"POST\" action=\"\">
					<table>
					<tr class=\"table_title\"><td>Nouvelle transaction</td></tr>
					<tr><td>Locataire :</td></tr>";
		
		foreach($all as $t)
		{
			$form .= "<tr><td><input type=\"checkbox\" value=\"".$t->id."\"/></td><td>".$t->name."</td></tr>";
		}
		$form .= "<tr><td>montant :</td><td> <input type=\"text\" name=\"\" /></td></tr>
					<tr><td>Commentaire :</td><td> <input type=\"text\" name=\"\" /></td></tr>
					<tr><td>Date prélevement :</td><td> <input type=\"text\" name=\"\" /></td></tr>
					<tr><td>Date Rappel :</td><td><input type=\"password\" name=\"\" /></td></tr>
					<tr><td></td><td><input type=\"submit\" value=\"connection\" name=\"\" /></td></tr>
					</form>";
		return $form;
	}
	
	public  static function login($controler)
	{
		return "<div class=\"form\">
					<form method=\"POST\" action=\"\">
					<table>
					<tr class=\"table_title\"><td>Vous avez un compte? Connectez vous</td></tr>
					<tr><td>mail :</td><td> <input type=\"text\" name=\"".$controler."_mail\" /></td></tr>
					<tr><td>mot de passe : </td><td><input type=\"password\" name=\"".$controler."_psw\" /></td></tr>
					<tr><td></td><td><input type=\"submit\" value=\"connection\" name=\"".$controler."_submit\" /></td></tr>
					</form>";
	}
	
	public static function signupowner()
	{
		return   "<form method=\"POST\" action=\"".urlpage("signup")."\">
			
						<tr class=\"table_title\"><td>Sinon inscrivez vous rapidement</td></tr>
						<tr><td>societe/nom : </td><td><input type=\"text\" name=\"signup_name\"></td></tr>
						<tr><td>nom : </td><td><input type=\"text\" name=\"signup_lastname\"></td></tr>
						<tr><td>prenom : </td><td><input type=\"text\" name=\"signup_firstname\"></td></tr>
						<tr><td>mail : </td><td><input type=\"text\" name=\"signup_mail\"></td></tr> 
						<tr><td>mdp : </td><td><input type=\"password\" name=\"signup_mdp\"></td></tr>
						<tr><td></td><td><input type=\"submit\" value=\"enregistrer\" name=\"signup_account\"></td></tr>
					</form>
					</table>
				</div><br>";
	}
	
	public static function signuptenant()
	{
		return "<form method=\"POST\" action=\"".urlpage("signup")."\">
						<tr class=\"table_title\"><td>Sinon inscrivez vous gratuitement</td></tr>
						<tr><td>code du propriétaire : </td><td><input type=\"text\" name=\"signup_code_owner\"></td></tr>
						<tr><td>nom : </td><td><input type=\"text\" name=\"signup_name\"></td></tr>
						<tr><td>mail : </td><td><input type=\"text\" name=\"signup_mail\"></td></tr>
						<tr><td>mdp : </td><td><input type=\"password\" name=\"signup_mdp\"></td></tr>
						<tr><td>adresse : </td><td><input type=\"text\" name=\"signup_address\"></td></tr>
						<tr><td>pays : </td><td><input type=\"text\" name=\"signup_country\"></td></tr>
						<tr><td></td><td><input type=\"submit\" value=\"enregistrer\" name=\"signup_tenant\"></td></tr>
					</form>
				</table></div><br>";
	}
	
	
	public function newsletter()
	{
		return "<center><form method=\"POST\" action=\"".urlpage("newsletter")."\">mail : <input type=\"text\" name=\"newsletter_mail\" /><br><input type=\"hidden\" name=\"a\" value=\"0\" /><input type=\"submit\" value=\"enregistrer\"></form></center>";
	}
	
	protected function connect()
	{
		return "";
	}
	
	
	protected function submenu()
	{
		$menu = menu::gridMenu();
		$sub = array();
		if (!array_key_exists($this->page,$menu) or empty($menu[$this->page]['sub']))
		{
			foreach($menu as $onglet)
			{
				if(array_key_exists($this->page,$onglet['sub']))
				{
					
					$sub = $onglet;
					break;
				}
			}
			if(empty($sub))
			{
				return "";
			}
		}
		else
		{
			$sub = $menu[$this->page];
		}
		$sm = "<div class=\"widget\"><h3>quoi faire ?</h3><ul>";
		foreach( $sub['sub'] as $lien => $name)
		{
			$sm .= "<li><a href=\"".urlpage($lien)."\">".utf8_decode($name)."</a></li>";
		}
			
		$sm .="</ul><div>";
	
		return $sm;
	}
	
	protected function sidebar()
	{
		$side = "<aside id=\"sidebar\">".$this->submenu();
		foreach($this->widgets as $widget)
		{
			$side .= "<aside id=\"widget\">".$widget."</aside>";
		}
		$side .=	"</aside>";
		return $side;
	}
	
	protected function  footer()
	{
		return
		"<footer>
		created by abdelrhamane
	</footer>
	</body>
</html>";
	}
	
	protected function nav()
	{
		$menu = "<nav><div class=\"button_menu\" style=\"display:none;\"><a>Menu</a></div>
			<ul><li class=\"name_site_nav\"><a href=\"index.php\"><img src=\"V/themes/light/style/images/invoicer.jpg"."\" alt=\"invoicer.fr\" /></a></li>";
		foreach (menu::gridMenu() as $lien => $categorie)
		{
			$menu .="<li class=\"item_menu\"><a href=\"".urlpage($lien)."\">".$categorie['name']."</a></li>";
		}
		$menu .= "</ul>
					</nav>";
		return $menu;
	}
	
	
	public  function built() 
	{
		print_r( utf8_decode($this->head()));
		print_r( utf8_decode($this->nav()));
		print_r( utf8_decode($this->sidebar()));
		print_r( utf8_decode($this->contents()));
		print_r( utf8_decode($this->footer()));
	}
	
	
	
}?>