<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Adashboard extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		//Clear all cache
        $this->output->nocache();
	}
	
	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('dashboard');
		$CI->load->library('admin/dashboard');
		if (!$this->a_auth->is_logged())
		{
			$this->output->set_header("Location: ".base_url().'admin/auth/login', TRUE, 302);
		}
		$this->a_auth->check_auth();
		$content = $CI->dashboard->admin_home_page();
        $bred_cumb = array(
            array('label'=> 'Manage Dashboard', 'url' => 'admin','class' =>'active')
        );
        $page_title = "Dashboard";
        $this->admin_template->full_html_view($content,$bred_cumb,$page_title);
	}

}