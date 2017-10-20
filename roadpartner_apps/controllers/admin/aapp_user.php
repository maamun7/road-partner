<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aapp_user extends CI_Controller {
	
	function __construct() {
      parent::__construct();
        $this->load->library('admin/app_user');
        $this->load->model('admin/app_users');
	    $this->admin_template->current_menu = 'app_user';
    }

	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		//$this->a_auth->check_permission('manage_app_user');

		$base_url = base_url()."admin/app_user/index";
		$total_rows = $this->app_users->total_app_user();	
		$limit_per_page = 100;
		$config = get_pagination_config($base_url,$total_rows,$limit_per_page,$uri_segment=4);
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	    $links = $this->pagination->create_links();
		
        $content = $CI->app_user->get_list_view($limit_per_page,$page,$links);
        $bred_cumb = array(
			array('label'=> 'Manage App User', 'url' => 'admin/app_user','class' =>'active')
		);
        $page_title = "App User Management";
		$this->admin_template->full_html_view($content,$bred_cumb,$page_title);
	}
	
	public function search()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manage_app_user');
		$CI->load->library('admin/app_user');	
		$key_word = trim($this->input->post('key_word'));
		if($key_word =="") {
			$this->session->set_userdata(array('warning_message'=>"You didn't type any user name or mobile number !"));
			redirect(base_url('admin/app_user'));
		}		
        $content = $CI->app_user->get_search_view($key_word);
        $bred_cumb = array(
			array('label'=> 'Manage App User', 'url' => 'admin/app_user'),
			array('label'=> 'Search App User', 'url' => 'admin/app_user','class' =>'active')
		);
        $page_title = "App User Management";
		$this->admin_template->full_html_view($content,$bred_cumb,$page_title);
	}

    public function change_status()
    {
        $this->a_auth->check_auth();
        //$this->a_auth->check_permission('manage_course');
        $user_id =  $_POST['app_user_id'];
        $this->app_users->do_change_status($user_id);
        $this->session->set_userdata(array('message'=>"Successfully Status Changed !"));
        //redirect(base_url('admin/app_user'));
        return true;
    }
}