<?php

interface  StoreInterface
{

	public function addRole($roleId);
	public function deleteAllRoles();
	public function deleteAllResources();
	public function deleteAllPermissions();
	public function deleteAllRules();

}

?>