<?php

interface  StoreInterface
{

	public function addRole(RoleInterface $role, $parent);
	public function deleteAllRoles();
	public function deleteAllResources();
	public function deleteAllPermissions();
	public function deleteAllRules();

}

?>