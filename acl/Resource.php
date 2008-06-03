<?php

require_once 'Resource/Interface.php';

class Resource implements ResourceInterface 
{
	private $_id;
	
	public function __construct(string $id)
	{
		$this->_id = $id;
	}
	
	public function getId()
	{
		return $this->_id;
	}
}
	
?>