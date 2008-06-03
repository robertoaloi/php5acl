<?php

require_once 'Role/Interface.php';

class Role implements RoleInterface
{
	private $_id;
	
	public function Role($id)
    {
        $this->_id = (string) $id;
    }
	
	public function getId()
	{
		return $this->_id;
	}
}

?>