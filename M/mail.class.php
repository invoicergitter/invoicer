<?php
Class mail 
{
	private $to;
	function __construct($to)
	{
		$this->to;
	}
	
	public function sendcheckmail($name,$code)
	{
		return theme::showfail("veuillez confirmer votre adresse mail, <br>un mail vient de vous ètre envoyé");
	}
}