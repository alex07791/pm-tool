<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Redirect
{
	private $_ci;

	public function __construct()
	{
		$this->_ci = &get_instance();
	}

	public function redirect($controller = "", $page = "")
	{
		$this->_ci->load->helper('url');
		echo "Redirect called {$controller} {$page} <br/>";
		// $this->load->helper('url');	
		if($controller === "") 
		{
			// header('refresh:5;URL='.base_url().'users');
			header('refresh:1;URL='.base_url());
			return;
		}
		switch ($controller) 
		{
			case 'users':
				if($page === "") header('refresh:1;URL='.base_url().'users');
				else
				{
					switch ($page) 
					{
						case 'index':							
							header('refresh:1;URL='.base_url().'users');
							break;
						case 'login':							
							header('refresh:1;URL='.base_url().'users/'.$page);
							break;
						case 'check_index':							
							header('refresh:3;URL='.base_url().'users/'.$page);
							break;
						case 'regiser':							
							header('refresh:1;URL='.base_url().'users/'.$page);
							break;
						case 'process_regiser':							
							header('refresh:3;URL='.base_url().'users/'.$page);
							break;
						case 'logut':							
							header('refresh:3;URL='.base_url().'users/'.$page);
							break;
						
						default:
							header('refresh:1;URL='.base_url());
							break;
					}
				} 
				break;
			
			default:
				# code...
				break;
		}
	}
}
?>