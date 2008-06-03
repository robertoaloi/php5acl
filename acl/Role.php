<?php

require_once 'Role/Interface.php';

class Role implements RoleInterface
{
	private $_id;
	
	public function Role($roleId)
	{
		$this->_id = (string) $roleId;
	}
	
	public function getId()
	{
		return $this->_id;
	}
}

?>