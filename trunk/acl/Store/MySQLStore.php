<?php

require_once 'Interface.php';

class MySQLStore implements StoreInterface
{
	
	private $_dbhost;
	private $_dbport;
	private $_dbname;
	private $_dbuser;
	private $_dbpass;
	private $_prefix;
	
	private $_map = array('ROLE' => 'roles',
						  'RESOURCE' => 'resources',
						  'PERMISSION' => 'permissions',
						  'RULE' => 'rules');
	
	private $_link; //FIXME: close connections!!!
	
	public function MySQLStore($options = array())
	{
		$this->_dbhost = $options['dbhost'];
		$this->_dbport = $options['dbport'];
		$this->_dbname = $options['dbname'];
		$this->_dbuser = $options['dbuser'];
		$this->_dbpass = $options['dbpass'];
		$this->_prefix = $options['prefix'];

		$this->connect(); // FIXME: connect at each request?
	}
	
	private function connect()
	{
    	$this->_link = mysql_pconnect($this->_dbhost . ":" . $this->_dbport, $this->_dbuser, $this->_dbpass);
	}

	private function query($query)
	{
		if ($this->_link)
		{
			if (mysql_select_db($this->_dbname))
			{
				return mysql_query($query);
			}
			throw new Exception('Impossible to connect to database.');
		}
		throw new Exception('MySQL Link error');

	}
	
	private function disconnect()
	{
		
	}
	
	public function addEntry($entry, $parent, $entryType)
	{
		if (!is_object($parent))
			$parentId = null;
		else
			$parentId = $parent->getId();
		//FIXME: Type check for $entry!!!
		return $this->query("INSERT INTO " . $this->_map[(string) $entryType] . " VALUES ('" . $entry->getId() . "', '" . $parentId . "')") ? true : false;
	}
	
	public function deleteAllEntries($entryType)
	{
		return $this->query("TRUNCATE TABLE " . $this->_map[(string) $entryType]) ? true : false;
	}
	
	public function getEntry($entryId, $entryType)
	{
		$result = $this->query("SELECT id FROM " . $this->_map[(string) $entryType] . " WHERE id = '" . $entryId . "'");
		if ($row = mysql_fetch_object($result)){
			return new Role($row->id); // FIXME: Break encapsulation
		}
		return null;
	}
	
	public function entryExists($entryId, $entryType)
	{
		if ($this->getEntry($entryId, (string) $entryType))
			return true;
		else
			return false;
	}
	
}

?>