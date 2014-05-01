<?php
class theme extends abstracttheme {
	
	public function __construct($page) {
		parent::__construct($page);
	}
	
	
	private function head()
	{
		return "<!doctype html>
		<html lang=\"en\">
		<head>
		<meta charset=\"utf-8\" />
		<title>Biller </title>
		<link rel=\"stylesheet\" href=\"".$GLOBALS['param']['link_style_rep']."css/styles.css\" type=\"text/css\" media=\"screen\" />
		<link rel=\"stylesheet\" type=\"text/css\" href=\"".$GLOBALS['param']['link_style_rep']."css/print.css\" media=\"print\" />
		<!--[if IE]><script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script><![endif]-->
		</head>";
	}
	

	private function contents()
	{
		$contents =  "<section id=\"main\"><section id=\"content\">";
		foreach ($this->articles as $article)
		{
			$contents .= "<article>".$article."</article>";
		}
		$contents .= "</section>";
	return $contents;
	}
	
	public  static function login()
	{
		return "formulaire connection ici";
	}
	
	
	public static function signup()
	{
		$form =  "
				<div>
					<form method=\"POST\" action=\"".urlpage("signup")."\">
					<table>
						<tr><td>societe/nom : </td><td><input type=\"text\" name=\"signup_name\"></td></tr>
						<tr><td>nom : </td><td><input type=\"text\" name=\"signup_lastname\"></td></tr>
						<tr><td>prenom : </td><td><input type=\"text\" name=\"signup_firstname\"></td></tr>
						<tr><td>mail : </td><td><input type=\"text\" name=\"signup_mail\"></td></tr>
						<tr><td>mdp : </td><td><input type=\"password\" name=\"signup_mdp\"></td></tr>
						<tr><td></td><td><input type=\"submit\" value=\"enregistrer\" name=\"signup_account\"></td></tr>
					</table>
					</form>
				</div><br>
				";
		
		return $form;
		
	}
	
	
	public function newsletter()
	{
		return "<center><form method=\"POST\" action=\"".urlpage("newsletter")."\">mail : <input type=\"text\" name=\"newsletter_mail\" /><br><input type=\"hidden\" name=\"a\" value=\"0\" /><input type=\"submit\" value=\"enregistrer\"></form></center>";
	}
	
	public  function built() 
	{
		print_r( utf8_encode($this->head()));
		print_r( utf8_encode($this->nav()));
		print_r( utf8_encode($this->header()));
		print_r( utf8_encode($this->contents()));
		print_r( utf8_encode($this->sidebar()));
		print_r( utf8_encode($this->footer()));
	}
	
	
	protected function connect()
	{
		return "";
	}
	
	
	protected function submenu()
	{
		$menu = menu::gridMenu();
		;
	
		if (!array_key_exists($this->page,$menu) or empty($menu[$this->page]['sub']))
		{
			return "";
		}
	
		$sub = $menu[$this->page];
		$sm = "<h3>Things To Do</h3><ul>";
		foreach( $sub['sub'] as $lien => $name)
		{
			$sm .= "<li><a href=\"".urlpage($lien)."\">".$name."</a></li>";
		}
			
		$sm .="</ul>";
	
		return $sm;
	}
	
	protected function sidebar()
	{
		$side = "<aside id=\"sidebar\">".$this->submenu();
		foreach($this->widgets as $widget)
		{
			$side .= "<aside id=\"widget\">".$widget."</aside>";
		}
		$side .=	"</aside></section>";
		return $side;
	}
	
	protected function  footer()
	{
		return 
	"<footer>
		<section id=\"footer-area\">
			<section id=\"footer-outer-block\">
				<aside class=\"footer-segment\">
					<h4>Partenaire</h4>
					<ul>
						<li><a href=\"#\">Googlo Co</a></li>
						<li><a href=\"#\">IBM</a></li>
						<li><a href=\"#\">crédit Mutuel</a></li>
					</ul>
				</aside>
				<aside class=\"footer-segment\">
					<h4>Plan du site</h4>
					<ul>
						<li><a href=\"#\">inscription</a></li>
						<li><a href=\"#\">connection</a></li>
						<li><a href=\"#\">administration</a></li>
					</ul>
				</aside>
				<aside class=\"footer-segment\">
					<h4>Contact</h4>
					<ul>
						<li><a href=\"#\">165 avenue bretagne</a></li>
						<li><a href=\"#\">59000 Lille Cedex</a></li>
					</ul>
				</aside>
			</section>
		</section>
	</footer>
	</div>
	</body>
</html>";
	}
	
	protected function nav()
	{
		$menu = "<body><div id=\"wrapper\"><nav>
		<div class=\"menu\">
			<ul>";
		foreach (menu::gridMenu() as $lien => $categorie)
		{
			$menu .="<li><a href=\"".urlpage($lien)."\">".$categorie['name']."</a></li>";
		}
		$menu .= "</ul>
					</div>
					</nav><!-- end of top nav -->";
		return $menu;
	}
	
	protected function header()
	{
		return "";
	}
}