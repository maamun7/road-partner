<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aservice extends CI_Controller {
	
	function __construct() {
      parent::__construct();
        $this->load->library('admin/service');
        $this->load->model('admin/services');
	    $this->admin_template->current_menu = 'service';
    }

	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		//$this->a_auth->check_permission('manage_service');

		$base_url = base_url()."admin/service/index";
		$total_rows = $this->services->total_service();
		$limit_per_page = 1000;
		$config = get_pagination_config($base_url,$total_rows,$limit_per_page,$uri_segment=4);
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	    $links = $this->pagination->create_links();
        $content = $CI->service->get_list_view($limit_per_page,$page,$links);
        $bred_cumb = array(
			array('label'=> 'Manage bid wins', 'url' => 'admin/service','class' =>'active')
		);
        $page_title = "Service Management";
		$this->admin_template->full_html_view($content,$bred_cumb,$page_title);
	}

	public function details($mobile_no = null)
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		//$this->a_auth->check_permission('manage_service');
		$CI->load->library('admin/service');
        if(!$mobile_no) {
            $CI->session->set_userdata(array('warning_message'=>"Please select user perfectly !"));
            redirect(base_url('admin/service'));
        }
        $content = $CI->service->get_details_view($mobile_no);
        $bred_cumb = array(
			array('label'=> 'Manage Bid wins', 'url' => 'admin/service'),
			array('label'=> 'User details', 'url' => 'admin/service/details/'.$mobile_no,'class' =>'active')
		);
        $page_title = "Bid wins Management";
		$this->admin_template->full_html_view($content,$bred_cumb,$page_title);
	}
}