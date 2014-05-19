<?php
/*
		Controller Name: Users.

		Description: 

		Functions:

		Methods:
*/
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('redirect');
	}
	public function index()
	{
		$this->load->library('session');
		$this->load->helper('url');
		// this will become a view
		if($this->session->userdata('username') !== false)
		{
			$logout_href = base_url().'users/logout';
			echo "<pre>\t <a href = \"{$logout_href}\">Logout</a>\n\nWelcome ". strtok($this->session->userdata('name'), " ")."</pre>";
		}
		else
		{
			$login_href = base_url().'users/login';
			$regiser_href = base_url().'users/register';
			echo"<pre>\t<a href = \"{$login_href}\">Login</a>\t<a href = \"{$regiser_href}\">Register</a><br/></pre>";
		}
		echo "This is the index<br/>";
	}

	// public function show($user_id = 0)
	// {
	// 	$user_id = (int)$user_id;
	// 	$this->load->library('user_factory');
	// 	$data = array(
	// 		"users" => $this->user_factory->get_user($user_id)
	// 	);
	// 	$this->load->view("user_view", $data);
	// }

	function login()
	{
		$this->load->helper('form');
		$this->load->library('session');
		if($this->session->userdata('username') !== false)
		{
			// this will become a view
			echo "You need to logout in order to login.<br/>";
			$this->redirect->redirect('users', 'index');
			return;
		}
		$this->load->view('user_login');
	}

	function check_login()
	{		
		// $this->load->helper('url');	
		$this->load->library('user_factory');
		if($this->input->post('cancel') != null)
		{
			echo "Returning to index...<br/>Have a good time!<br/>";
			$this->redirect->redirect('users', 'index');
			return;
		}

		$query = $this->user_factory->check_login();
		// this will become a view
		if($query === true)
		{
			echo "Welcome ". strtok($this->session->userdata('name'), " "). ". Have a good time!<br/>";
			$this->redirect->redirect('users', 'show');
		}
		else
		{
			echo "Credentials invalid. Redirecting to main page...<br/>";
			$this->redirect->redirect('users', 'index');
		}
	}

	function register()
	{	
		$this->load->helper('form');
		$this->load->library('session');

		// this will become a view
		if($this->session->userdata('username') !== false)
		{
			echo "You need to logout in order to register.<br/>";
			$this->redirect->redirect('users', 'index');
			return;
		}
		$this->load->view('user_registration');
	}

	function process_register()
	{	
		$this->load->library('form_validation');
		$this->load->library('user_factory');

		if($this->input->post('cancel') != null)
		{
			echo "Returning to index...<br/>Have a good time!<br/>";
			$this->redirect->redirect('users', 'index');
			return;
		}
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');	
		$this->form_validation->set_rules('email', 'Email', 'trim|required');	
				
		$query = $this->user_factory->create_user();		
		
		// this will become a view
		if($query === true)
		{
			echo "Welcome ". strtok($this->session->userdata('name'), " "). ". Have a good time!<br/>";
			$this->redirect->redirect('users', 'index');
		}
		else
		{			
			echo "Passed data not valid. Try again... Have a good time!<br/>";
			$this->redirect->redirect('users', 'index');	
		}
	}
	
	function logout()
	{
		$this->load->library('session');
		$this->session->sess_destroy();
		echo "Have a nice day!<br/>";
		$this->redirect->redirect('users', 'index');	
	}
}
?>