<?php
/*
		Factory Name: User_Factory.

		Description: This library is used to create user models.

		Functions:
		- get_user($id = 0):
			This function returns a specific user if the provided id is greater than 0 else it returns all available 
			users.
		- create_object_from_data($data):
			This function creates a new user and sets the passed information.


*/
if(!defined('BASEPATH')) exit('No direct script access allowed'); 
class User_Factory
{
	private $_ci;

	function __construct()
	{
		$this->_ci = &get_instance();
		$this->_ci->load->model('user_model');
	}

	public function get_user($id = 0)
	{
		if($id > 0)
		{
			$query = $this->_ci->db->get_where("users", array('id' => $id));
			if($query->num_rows() > 0)
			{
				return $this->create_object_from_data($query->row());
			}
			return false;
		}
		else
		{
			$query = $this->_ci->db->select('*')->from('users')->get();
			if($query->num_rows() > 0)
			{
				$users = array();
				foreach ($query->result() as $row) 
				{
					$users[] = $this->create_object_from_data($row);
				}
				return $users;
			}
			return false;
		}
	}
	public function create_object_from_data($data)
	{
		// echo "Testing user creation<br/>";
		// var_dump($data);
		$user = new User_Model();		
		$user->set_id($data->id);
		$user->set_username($data->username);
		$user->set_password($data->password);
		$user->set_name($data->name);
		$user->set_email($data->email);
		$user->set_active($data->is_active);
		return $user;
	}

	public function create_object_from_array($data = array())
	{
		// echo "Testing user creation<br/>";
		// var_dump($data);
		$user = new User_Model();	
		$user->set_id(0);
		$user->set_username($data["username"]);
		$user->set_password($data["password"]);
		$user->set_name($data["name"]);
		$user->set_email($data["email"]);
		$user->set_active($data["is_active"]);
		return $user;
	}

	function check_login()
	{
		$post_user = $this->_ci->input->post('username');
		$post_pass = md5($this->_ci->input->post('password'));
		$query = $this->_ci->db->get_where("users", array('username' => $post_user, 'password' => $post_pass));
		if($query->num_rows === 1 && (int)$query->row('is_active') === 1)
		{
			$user = $this->create_object_from_data($query->row());			
			$this->set_session_details($user);
			return true;
		}
		return false;
	}

	function create_user()
	{	

		$post_user = $this->_ci->input->post('username');
		$post_pass = md5($this->_ci->input->post('password'));
		$post_name = $this->_ci->input->post('name');
		$post_email = $this->_ci->input->post('email');

		$query = $this->_ci->db->get_where("users", array('username' => $post_user));
		if($query->num_rows > 0)
		{
			return false;
		} 
		$new_user_data = array(
			'username' => $post_user,
			'password' => $post_pass,
			'name' => $post_name,
			'email' => $post_email,			
			'is_active' => 1				
		);
		$user = $this->create_object_from_array($new_user_data);
		if($user->commit() === true)
		{
			$this->set_session_details($user);
			return true;
		}
		return false;
	}

	function set_session_details($var)
	{
		// var_dump($var);
		$this->_ci->load->library('session');
		$this->_ci->session->set_userdata(array("user_id" => $var->get_id()));
		$this->_ci->session->set_userdata(array("username" => $var->get_username()));
		$this->_ci->session->set_userdata(array("password" => $var->get_password()));
		$this->_ci->session->set_userdata(array("name" => $var->get_name()));
		$this->_ci->session->set_userdata(array("email" => $var->get_email()));
		$this->_ci->session->set_userdata(array("is_active" => $var->get_active()));
		// return $this->session->all_userdata();
	}
}
?>