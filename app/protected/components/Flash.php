<?php
class Flash extends CWidget
{
	public $flashes = array();
	public $hide = false;
	public $hideTime = 5000;

	public function init()
	{
		
	}
	
	public function run()
	{
		$this->render('flash/index');
	}
}
?>