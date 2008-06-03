<?php

interface  StoreInterface
{

	public function addRole(RoleInterface $role, $parents = array());
	public function roleExists($roleId);
	
}

?>