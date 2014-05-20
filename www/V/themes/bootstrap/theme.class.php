<?php
class theme extends abstracttheme {
	
	public function __construct($page) {
		parent::__construct($page);
		$this->js[] = "jquery.min.js";
	}
	
	public static function showfail($msg)
	{
		return array( 'type' => 'message','data' =>"<div class=\"panel panel-danger\">
		<div class=\"panel-heading\">
		<h3 class=\"panel-title\">Erreur</h3>
		</div>
		<div class=\"panel-body\">".$msg."</div>
		</div>");
	}
	public static function showsuccess($msg)
	{
		return array( 'type' => 'message','data' =>"<div class=\"panel panel-success\">
		<div class=\"panel-heading\">
		<h3 class\"panel-title\">Message</h3>
		</div>
		<div class=\"panel-body\">".$msg."</div>
		</div>");
	}
	
	public static function separateur()
	{
		return "<hr/>";
	}
	
	private function head()
	{
		$head = "<!DOCTYPE html>
			<html lang=\"en\">
  				<head>
				    <meta charset=\"utf-8\">
				    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
				    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
				    <meta name=\"description\" content=\"\">
				    <meta name=\"author\" content=\"\">
				    <link rel=\"shortcut icon\" href=\"../../assets/ico/favicon.ico\">
				    <title>Invoicer</title>
	";
		foreach($this->js as $js)
		{
			$head .= "<script src=\"".$GLOBALS['param']['link_theme_rep']."style/js/".$js."\"></script>";
		}
		$head .= "<!-- Bootstrap core CSS -->
		<link href=\"".$GLOBALS['param']['link_style_rep']."css/bootstrap.css\" rel=\"stylesheet\">
		<!--<link href=\"".$GLOBALS['param']['link_style_rep']."css/bootstrap-theme.min.css\" rel=\"stylesheet\">-->
		
		<!-- Custom styles for this template -->
		<link href=\"".$GLOBALS['param']['link_style_rep']."css/common.css\" rel=\"stylesheet\">
		 <link href=\"".$GLOBALS['param']['link_style_rep']."css/datepicker.css\" rel=\"stylesheet\">
    <!-- Just for debugging purposes. Don't actually copy this line! -->
		    <!--[if lt IE 9]><script src=\"../../assets/js/ie8-responsive-file-warning.js\"></script><![endif]-->
		
		    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		    <!--[if lt IE 9]>
		    <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
		    <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
		    		<![endif]-->
		    		</head><body>";
		return $head;
	}
	
	private function contents()
	{
		$contents =  "<div class=\"container\">";
		foreach ($this->articles as $article)
		{
			if(is_array($article))
			{
				switch($article['type'])
				{
					case "message":
					case "band":
						$contents .= $article['data'];
						break;
					case "border":
						$contents .= "<div class=\"thumbnail\">".$article['data']."</div>";
						break;
					case "block":
					default:
						$contents .= "<div class=\"jumbotron\">".$article['data']."</div>";
				}
			}
			else 
			{
				$contents .= "<div class=\"jumbotron\">".$article."</div>";
			}
			
		}
		$contents .= "</div>";
	return $contents;
	}
	
	public static function Title($title)
	{
		return "<center><h2>".$title."</h2 ></center><br>";
	} 
	public static function formaddtransaction()
	{
		$tenant = new tenant();
		$all = $tenant->all();	
		$form = "<form action=\"\" method=\"POST\" class=\"form-horizontal\">
<fieldset>
<!-- Form Name -->
<legend>Ajouter une Transaction</legend>
<!-- Multiple Checkboxes -->
<div class=\"control-group\">
  <label class=\"control-label\" for=\"tenant[]\">Locataire</label>
  <div class=\"controls\"><table class=\"table table-bordered table-striped table-condensed\"><thead><th>Nom</th><th>Adresse</th><th>Montant</th></thead>";
		$i = 0;
		foreach($all as $t)
		{
			$form .="<tr><td>".$t->name."</td><td>".$t->address."</td><td><input id=\"amount\" name=\"transaction[".$t->id."]\" class=\"input-large\" type=\"text\"></td></tr>";
			$i++;
		}
		$form .= "</table>
<!-- Text input-->
  <label class=\"control-label\" for=\"comment\">Commentaire</label>
  <div class=\"controls\">
    <input id=\"comment\" name=\"comment\" placeholder=\"loyer plein\" class=\"input-large\" type=\"text\">   
  </div>
<!-- Appended Input-->
  <label class=\"control-label\" for=\"levy\">Date Prélévement</label>
  <div class=\"controls\">
      <input required=\"\" id=\"levy\" name=\"levy\" class=\"input-large\"  type=\"text\">
  </div>
<!-- Appended Input-->
  <label class=\"control-label\" for=\"reminder\">Date rappel</label>
  <div class=\"controls\">
      <input id=\"reminder\" name=\"reminder\" class=\"input-large\"  type=\"text\">
  </div>
<!-- Button -->
    <button id=\"form_addtransaction\" name=\"form_addtransaction\" class=\"btn btn-primary\">Enregistrer</button></div>
</fieldset>
				
</form>";
		return $form;
	}
	
	public  static function login($controler)
	{
		return "<center><form method=\"POST\" action=\"\" class=\"col-lg-5\">
					<legend>Vous avez un compte? Connectez vous</legend>
					mail :<input type=\"text\" required=\"\" class=\"form-control\" name=\"".$controler."_mail\" />
					mot de passe : <input required=\"\" type=\"password\" class=\"form-control\" name=\"".$controler."_psw\" />
					<input type=\"submit\" value=\"connection\" class=\"form-control btn btn-primary\" name=\"".$controler."_submit\" />
				</form></center>";
	}
	
	public static function signupowner()
	{
		return   "<center><form method=\"POST\"  class=\"col-lg-5\" action=\"".urlpage("signup")."\">
						<legend>Sinon inscrivez vous rapidement</legend>
						societe/nom : <input required=\"\" class=\"form-control\" type=\"text\" name=\"signup_name\">
						nom : <input required=\"\" class=\"form-control\" type=\"text\" name=\"signup_lastname\">
						prenom : <input class=\"form-control\" type=\"text\" name=\"signup_firstname\">
						mail : <input required=\"\" class=\"form-control\" type=\"text\" name=\"signup_mail\">
						mdp : <input required=\"\" class=\"form-control\"type=\"password\" name=\"signup_mdp\">
						<input class=\"form-control btn btn-primary\" type=\"submit\" value=\"enregistrer\" name=\"signup_account\">
					</form></center>";
	}
	
	public static function signuptenant()
	{
		return "<center><form method=\"POST\"  class=\"col-lg-5\" action=\"".urlpage("signup")."\">
						<legend>Sinon inscrivez vous gratuitement</legend>
						nom : <input required=\"\" type=\"text\" class=\"form-control\" name=\"signup_name\">
						mail : <input required=\"\" type=\"text\" class=\"form-control\" name=\"signup_mail\">
						mdp : <input required=\"\" type=\"password\" class=\"form-control\" name=\"signup_mdp\">
						code du propriétaire : <input required=\"\" class=\"form-control\" type=\"text\" name=\"signup_code_owner\">
						adresse : <input type=\"text\" required=\"\" class=\"form-control\" name=\"signup_address\">
						pays : <input type=\"text\" required=\"\" class=\"form-control\" name=\"signup_country\">
						<input class=\"form-control btn btn-primary\" type=\"submit\" value=\"enregistrer\" name=\"signup_tenant\">
					</form></center>";
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
		$sm = "<li class=\"dropdown\">
              <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Actions<b class=\"caret\"></b></a>
              <ul class=\"dropdown-menu\">";
		foreach( $sub['sub'] as $lien => $name)
		{
			$sm .= "<li><a href=\"".urlpage($lien)."\">".$name."</a></li>";
		}
			
		$sm .="</ul></li>";
	
		return $sm;
	}
		
	protected function  footer()
	{
		return "<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src=\"".$GLOBALS['param']['link_style_rep']."js/jquery.min.js\"></script>
    <script src=\"".$GLOBALS['param']['link_style_rep']."js/bootstrap.min.js\"></script>
    <script src=\"".$GLOBALS['param']['link_style_rep']."js/bootstrap-datepicker.js\"></script>
  	<center>created by abdelrhamane</center>
    </body>
</html>
	";
	}
	
	protected function nav()
	{
		$menu = " <!-- Fixed navbar -->
    <div class=\"navbar navbar-default navbar-fixed-top\" role=\"navigation\">
      <div class=\"container\">
        <div class=\"navbar-header\">
          <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
            <span class=\"sr-only\">Toggle navigation</span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </button>
          <a class=\"navbar-brand\" href=\"index.php\">Invoicer.fr</a>
        </div>
        <div class=\"navbar-collapse collapse\">
          <ul class=\"nav navbar-nav\">";
		foreach (menu::gridMenu() as $lien => $categorie)
		{
			$menu .="<li ";
			$menu .= ($this->page == $lien)?"class=\"active\" ":"";
			$menu .= "><a href=\"".urlpage($lien)."\">".$categorie['name']."</a></li>";
		}
		$menu .= $this->submenu()."</ul>";
		if (isset($_SESSION['account']))
		{
			$menu .="<ul class=\"nav navbar-nav navbar-right\"><li class=\"active\"><a href=\"".urlpage("logout")."\">Déconnection</a></li></ul>"; 
		}
		$menu .= "</div></div></div>";
		return $menu;
	}
	
	public  function built() 
	{
		print_r( $this->head());
		print_r( $this->nav());
		print_r ($this->contents());
		print_r( $this->footer());
	}
  }
  
 class Calendar { 	
 	public function __construct()
 	{
 	}
 	
 	public static function built($name = "")
 	{
 		return "";
 	}
 }
?>