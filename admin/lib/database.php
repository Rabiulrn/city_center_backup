<?php
/**
* create a class name Database
*/
class Database
{
	public $host 	= HOST;
	public $user 	= USER;
	public $pass 	= PASS;
	public $db_name = DB_NAME;

	public $link;
	public $error;

	function __construct()
	{
		$this->connectDB();
	}

	public function connectDB()
	{
		$this->link = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
		if (!$this->link) 
		{
			$this->link = 'Connection failed';
			return false;
		}
	}

	public function insert($value)
	{
		$insert = $this->link->query($value) or die($this->link->error.__LINE__);
		if ($insert) 
		{
			return $insert;
		}
		else
		{
			return false;
		}
	}

	public function select($value)
	{
		$select = $this->link->query($value) or die($this->link->error.__LINE__);
		if ($select) 
		{
			return $select;
		}
		else
		{
			return false;
		}
	}

	public function delete($value)
	{
		$delete = $this->link->query($value) or die($this->link->error.__LINE__);
		if ($delete) 
		{
			return $delete;
		}
		else
		{
			return false;
		}
	}

	public function update($value)
	{
		$update = $this->link->query($value) or die($this->link->error.__LINE__);
		if($update)
		{
			return $update;
		}
		else
		{
			return false;
		}
	}
	
	public function login($value)
	{
		$login = $this->link->query($value) or die($this->link->error.__LINE__);
		if($login)
		{
			return $login;
		}
		else
		{
			return false;
		}
	}

}



?>