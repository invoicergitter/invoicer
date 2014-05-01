<?php
abstract class table 
{
	public $id;
	
	public function __construct()
	{
		$this->id = 0;
	}
	
	public abstract function load($key,$value);
	public abstract function insert();
	public abstract function update();
	public abstract function delete();
}