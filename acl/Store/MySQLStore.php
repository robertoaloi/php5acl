<?php

require_once 'Interface.php';

class MySQLStore implements StoreInterface
{
	
	private $_dbhost;
	private $_dbport;
	private $_dbname;
	private $_dbuser;
	private $_dbpass;
	
	private $_link; //FIXME: close connections!!!
	
	public function MySQLStore($options = array())
	{
		$this->_dbhost = $options['dbhost'];
		$this->_dbport = $options['dbport'];
		$this->_dbname = $options['dbname'];
		$this->_dbuser = $options['dbuser'];
		$this->_dbpass = $options['dbpass'];
		
		$this->connect();
	}
	
	private function connect()
	{
    	$this->_link = mysql_pconnect($this->_dbhost . ":" . $this->_dbport, $this->_dbuser, $this->_dbpass);
	}

	private function query($query)
	{echo "A"; print_r($this->_link);
		if ($this->_link)
		{echo "B";
			if (mysql_select_db($this->_dbname))
			{echo "C";
				return mysql_query($query);
			}
			throw Exception;
		}
		throw Exception;

	}
	
	private function disconnect()
	{
		
	}
	
	public function addRole(RoleInterface $role, $parents = array())
	{// FIXME: prefix
		// FIXME: create tables
		$this->query("INSERT INTO roles VALUES (null, '" . $role->getId() . "')");
	}
	
}

?>