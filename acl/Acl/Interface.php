<?php

interface AclInterface
{

	public function check(RoleInterface $role, ResourceInterface $resource, PermissionInterface $permission);
	
	public function reset();
	
	public function addRole(RoleInterface $role, RoleInterface $parent = null);
	public function deleteRole(string $roleId);
	public function deleteAllRoles();
	public function roleExists($roleId);
	public function getRole($roleId);
	
	public function addResource(ResourceInterface $resource, ResourceInterface $parent = null);
	public function deleteResource(string $resourceId);
	public function deleteAllResources();
	public function ResourceExists($resourceId);
	public function getResource($resourceId);
	
	public function addPermission(PermissionInterface $permission, PermissionInterface $parent = null);
	public function deletePermission(string $permissionId);
	public function deleteAllPermissions();
	public function permissionExists($permissionId);
	public function getPermission($permissionId);

	public function addRule(RuleInterface $rule, RuleInterface $parent = null);
	public function deleteRule(string $ruleId);
	public function deleteAllRules();
	public function ruleExists($ruleId);
	public function getRule($ruleId);

}

?>