<?php

interface AclInterface
{

	public function check(RoleInterface $role, ResourceInterface $resource, PermissionInterface $permission);
	
	public function addRole(RoleInterface $role, $parents = array());
	public function deleteRole(string $roleId);
	public function deleteAllRoles();
	public function roleExists($roleId);
	public function getRole($roleId);
	
	public function addResource(Resource $resource, $parents = array());
	public function deleteResource(string $resourceId);
	public function deleteAllResources();
	public function resourceExists(string $resourceId);
	
	public function addPermission(Permission $resource);
	public function deletePermission(string $permissionId);
	public function deleteAllPermissions();
	public function permissionExists(string $permissionId);
	
	public function addRule(Rule $rule);
	public function deleteRule(string $ruleId);
	public function deleteAllRules();
	public function ruleExists(string $ruleId); // FIXME: Not sure about its utility
}

?>