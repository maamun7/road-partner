<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aauth extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		//Clear all cache
        $this->output->nocache();
	}
	
	public function login()
	{	
		if ($this->a_auth->is_logged() )
		{
			$this->output->set_header("Location: ".base_url().'admin/dashboard', TRUE, 302);
		}		
		$content =  "";
		$this->admin_template->admin_login_view($content);
	}
	
	//* Valid User Check..
	public function do_login()
	{	
		$error = '';
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if ( $username == '' || $password == '' || $this->a_auth->login($username, $password) === FALSE )
		{
			$error = 'Wrong user name or password';
		}
		if ( $error != '' )
		{
			$this->session->set_userdata(array('error_message'=>$error));
			$this->output->set_header("Location: ".base_url().'admin/auth/login', TRUE, 302);
		}else{
			$this->output->set_header("Location: ".base_url().'admin/dashboard', TRUE, 302);
        }
	}
	
	public function logout()
	{	
		if ($this->a_auth->logout())
		$this->output->set_header("Location: ".base_url().'admin/auth/login', TRUE, 302);
	}

}