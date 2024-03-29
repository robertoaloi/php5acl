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
$store = new MysqlStore(array('dbhost' => '127.0.0.1',
							  'dbport' => '8889', 
							  'dbname' => 'acl_test',
							  'dbuser' => 'root',
							  'dbpass' => 'root',
							  'prefix' => ''));
$acl = new Acl($store);

// Resetting acl
echo "Resetting Acl...";
echo $acl->reset() ? 'ok' : 'error';
echo "<br />";

// Add some new roles
echo "Adding role 'user'...";
echo $acl->addRole(new Role('user')) ? 'ok' : 'error';
echo "<br />";
echo "Adding role 'guest' as child of 'user'...";
echo $acl->addRole(new Role('guest'), $acl->getRole('user')) ? 'ok' : 'error';
echo "<br />";
echo "Adding role 'registered' as child of 'user'...";
echo $acl->addRole(new Role('registered'), $acl->getRole('user')) ? 'ok' : 'error';
echo "<br />";
echo "Adding role 'admin' as child of 'registered'...";
echo $acl->addRole(new Role('admin'), $acl->getRole('registered')) ? 'ok' : 'error';
echo "<br />";

// Create some users
echo "Adding role 'Bob' to group 'registered'...";
echo $acl->addRole(new Role('Bob'), $acl->getRole('registered')) ? 'ok' : 'error';
echo "<br />";
echo "Adding role 'Claire' to group 'guest'...";
echo $acl->addRole(new Role('Claire'), $acl->getRole('guest')) ? 'ok' : 'error';
echo "<br />";

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