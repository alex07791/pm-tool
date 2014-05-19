<?php
/*
		Model Name: User_Model

		Description: This model is the object representation of an user object.

		Fields:
		- _id;
		- _username;
		- _password;
		- _name;
		- _is_active;

		Function:
		- commit().
*/
class User_Model extends CI_Model
{
	private $_id;
	private $_username;
	private $_password;
	private $_name;
	private $_email;
	private $_is_active;

	function __construct()
	{
		parent::__construct();
	}

	public function get_id()
	{
		return $this->_id;
	}
	public function set_id($value)
	{
		$this->_id = $value;
	}

	public function get_username()
	{
		return $this->_username;
	}
	public function set_username($value)
	{
		$this->_username = $value;
	}

	public function get_password()
	{
		return $this->_password;
	}
	public function set_password($value)
	{
		$this->_password = $value;
	}

	public function get_active()
	{
		return $this->_is_active;
	}
	public function set_active($value)
	{
		$this->_is_active = $value;
	}

	public function get_name()
	{
		return $this->_name;
	}
	public function set_name($value)
	{
		$this->_name = $value;
	}

	public function get_email()
	{
		return $this->_email;
	}
	public function set_email($value)
	{
		$this->_email = $value;
	}

	public function commit()
	{
		$data = array(
			'username' => $this->_username,
			'password' => $this->_password,
			'name' => $this->_name,
			'email' => $this->_email,
			'is_active' => $this->_is_active
		);
		if($this->_id > 0)
		{
			if($this->db->update("username", $data, array('id' => $this->_id)))
			{
				return true;
			}
		}
		else
		{				
			if($this->db->insert("users", $data))
			{
				$this->_id = $this->db->insert_id();
				// var_dump($this);
				return true;
			}
		}
		return false;
	}
	
}
?>