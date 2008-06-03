<?php

require_once 'Acl/Interface.php';
require_once 'Exception.php';

class Acl implements AclInterface
{
	
	private $_store;
	
	public function Acl(StoreInterface $store)
	{
		$this->_store = $store;
	}
	
	public function check(RoleInterface $role, ResourceInterface $resource, PermissionInterface $permission)
	{
		
	}
	
	public function addRole(RoleInterface $role, $parents = array())
	{
		$roleId = $role->getId();
		
		if ($this->roleExists($roleId))
			throw new AclException('Trying to add already existent role (ID: ' . $roleId . ').');
		else
			return $this->_store->addRole($roleId);
	}

	public function getRole($roleId)
	{
		if (!$this->roleExists((string) $roleId))
			throw new AclException('Trying to get a not existing role.');
		else
			return $this->_store->getRole((string) $roleId);
	}
	
	public function deleteRole(string $roleId)
	{
		return $this->_store->deleteRole($roleId);
	}
	
	public function deleteAllRoles()
	{
		return $this->_store->deleteAllRoles();
	}
	
	public function roleExists($roleId)
	{
		return $this->_store->roleExists((string) $roleId);
	}
	
	public function addResource(Resource $resource, $parents = array())
	{
		
	}
	
	public function deleteResource(string $resourceId)
	{
		
	}
	
	public function deleteAllResources()
	{
		
	}
	
	public function resourceExists(string $resourceId){}
	
	public function addPermission(Permission $resource){}
	public function deletePermission(string $permissionId){}
	public function deleteAllPermissions(){}
	public function permissionExists(string $permissionId){}
	
	public function addRule(Rule $rule){}
	public function deleteRule(string $ruleId){}
	public function deleteAllRules(){}
	public function ruleExists(string $ruleId){} // FIXME: Not sure about its utility
	
}
	
?>