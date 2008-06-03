<?php

// Error reporting
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 'on');

// Include Acl
require_once 'acl/Acl.php';
require_once 'acl/Role.php';
require_once 'acl/Resource.php';
require_once 'acl/Store/MySqlStore.php';

// Create an Acl instance
$acl = new Acl(new MysqlStore(array('dbhost' => '127.0.0.1',
									'dbport' => '8889', 
									'dbname' => 'acl_test',
									'dbuser' => 'root',
									'dbpass' => 'root',
									'prefix' => ''
									)));

// Add some new roles
echo $acl->addRole(new Role('guest')) ? 'ok' : 'error';
$acl->addRole(new Role('registered'));
$acl->addRole(new Role('admin'));

// Create some users
$acl->addRole(new Role('Bob'), array($acl->getRole('guest'), $acl->getRole('registered')));
$acl->addRole(new Role('Claire'), array('guest'));

// Add some resources
$acl->addResource(new Resource('forum'));
$acl->addResource(new Resource('addressBook'));

// Add some permissions
$acl->addPermission(new Permission($acl->getResource('forum'), 'read'));
$acl->addPermission(new Permission($acl->getResource('forum'), 'post'));
$acl->addPermission(new Permission($acl->getResource('addressBook'), array('display')));

// Add some rules
$acl->addRule(new Allow($acl->getRole('registered'), $acl->getResource('forum')));
$acl->addRule(new Deny($acl->getRole('Claire'), $acl->getResource('forum'), array('post')));

// Let's try some rights
echo $acl->check($acl-getRole('Bob'), $acl->getResource('forum'), new Permission('post')) ? 'allowed' : 'denied'; // Allow
echo $acl->check($acl-getRole('Claire'), $acl->getResource('forum'), new Permission('post')) ? 'allowed' : 'denied'; // Deny

?>