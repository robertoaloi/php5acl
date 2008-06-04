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
	
	public function check(RoleInterface $resource, ResourceInterface $resource, PermissionInterface $permission)
	{
		
	}
	
	public function reset()
	{
		if ($this->deleteAllRoles())
			if ($this->deleteAllResources())
				if ($this->deleteAllPermissions())
					if ($this->deleteAllRules())
						return true;
					return false;
				return false;
			return false;
		return false;
	}
	
	public function addRole(RoleInterface $role, RoleInterface $parent = null)
	{
		return $this->addEntry($role, $parent, 'ROLE');
	}

	public function addResource(ResourceInterface $resource, ResourceInterface $parent = null)
	{
		return $this->addEntry($resource, $parent, 'RESOURCE');
	}
	
	public function addPermission(PermissionInterface $permission, PermissionInterface $parent = null)
	{
		return $this->addEntry($permission, $parent, 'PERMISSION');
	}
	
	public function addRule(RuleInterface $rule, RuleInterface $parent = null)
	{
		return $this->addEntry($rule, $parent, 'RULE');
	}
	
	public function getRole($roleId)
	{
		return $this->getEntry($roleId, 'ROLE');
	}
	
	public function getResource($resourceId)
	{
		return $this->getEntry($resourceId, 'RESOURCE');
	}
	
	public function getPermission($permissionId)
	{
		return $this->getEntry($permissionId, 'PERMISSION');
	}
	
	public function getRule($ruleId)
	{
		return $this->getEntry($ruleId, 'RULE');
	}
	
	public function deleteRole(string $roleId)
	{
		return $this->deleteEntry($roleId, 'ROLE');
	}
	
	public function deleteResource(string $resourceId)
	{
		return $this->deleteEntry($resourceId, 'RESOURCE');
	}
	
	public function deletePermission(string $permissionId)
	{
		return $this->deleteEntry($permissionId, 'PERMISSION');
	}
	
	public function deleteRule(string $ruleId)
	{
		return $this->deleteEntry($ruleId, 'RULE');
	}
	
	public function deleteAllRoles()
	{
		return $this->deleteAllEntries('ROLE');
	}
	
	public function deleteAllResources()
	{
		return $this->deleteAllEntries('RESOURCE');
	}
	
	public function deleteAllPermissions()
	{
		return $this->deleteAllEntries('PERMISSION');
	}
	
	public function deleteAllRules()
	{
		return $this->deleteAllEntries('RULE');
	}
	
	public function roleExists($roleId)
	{
		return $this->entryExists((string) $roleId, 'ROLE');
	}
	
	public function resourceExists($resourceId)
	{
		return $this->entryExists((string) $resourceId, 'RESOURCE');
	}
	
	public function permissionExists($permissionId)
	{
		return $this->entryExists((string) $permissionId, 'PERMISSION');
	}
	
	public function ruleExists($ruleId)
	{
		return $this->entryExists((string) $ruleId, 'RULE');
	}
	
	private function addEntry($entry, $parent, $entryType)
	{
		$entryId = $entry->getId();
		
		if ($this->entryExists($entryId, $entryType))
			throw new AclException('Trying to add already existent role' . $entryType . ' (ID: ' . $entryId . ').');
		else if ($parent != null && !$this->entryExists($parent->getId(), $entryType))
			throw new AclException('Trying to link ' . $entryType . ' to non existing parent (ID: ' . $entryId . ', PARENT ID: ' . $parent->getId() . ').');
		else
			return $this->_store->addEntry($entry, $parent, $entryType);
	}
	
	private function getEntry($entryId, $entryType)
	{
		if (!$this->entryExists((string) $entryId, $entryType))
			throw new AclException('Trying to get a not existing ' . $entryType. ' (ID: ' .  $entryId . ').');
		else
			return $this->_store->getEntry((string) $entryId, $entryType);
	}

	private function deleteEntry(string $entryId)
	{
		if (!$this->entryExists((string) $entryId))
			throw new AclException('Trying to delete a not existing ' . $entryType . ' (ID: ' . $entryId . ').');
		else
			return $this->_store->deleteEntry((string) $entryId, $entryType);
	}
	
	private function entryExists($entryId, $entryType)
	{
		return $this->_store->entryExists((string) $entryId, $entryType);
	}

	private function deleteAllEntries($entryType)
	{
		return $this->_store->deleteAllEntries($entryType);
	}
	
}
	
?>