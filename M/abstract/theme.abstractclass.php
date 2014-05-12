<?php

abstract Class abstracttheme {
	protected $articles = array();
	protected $widgets = array();
	protected $page;
	protected $js =array();
	
	
	public function __construct($page) {
		$this->page = $page;
	}
	
	public abstract function built();
	
	public static abstract function formaddtransaction();
	public static abstract function login($controler);
	public static abstract function signuptenant();
	public static abstract function signupowner();

	public static abstract function showfail($msg);
	public static abstract function showsuccess($msg);
	
	
	public function addArticle($content)  {
		$this->articles[] =$content;
	}
	
	public function addjs($js)  {
		$this->js[] =$js;
	}
	
	public function addWidget($content)  {
		$this->widgets[] =$content;
	}
	
}