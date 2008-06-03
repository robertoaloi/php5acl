<?php

interface  StoreInterface
{

	public function addRole(RoleInterface $role, $parent);
	public function deleteAllEntries($etryType);

}

?>