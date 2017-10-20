<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Abid_win extends CI_Controller {
	
	function __construct() {
      parent::__construct();
        $this->load->library('admin/bid_win');
        $this->load->model('admin/bid_wins');
	    $this->admin_template->current_menu = 'bid_win';
    }

	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		//$this->a_auth->check_permission('manage_bid_win');

		$base_url = base_url()."admin/bid_win/index";
		$total_rows = $this->bid_wins->total_bid_win();	
		$limit_per_page = 5;
		$config = get_pagination_config($base_url,$total_rows,$limit_per_page,$uri_segment=4);
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	    $links = $this->pagination->create_links();
        $content = $CI->bid_win->get_list_view($limit_per_page,$page,$links);
        $bred_cumb = array(
			array('label'=> 'Manage bid wins', 'url' => 'admin/bid_win','class' =>'active')
		);
        $page_title = "Bid wins Management";
		$this->admin_template->full_html_view($content,$bred_cumb,$page_title);
	}

	public function details($mobile_no = null)
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		//$this->a_auth->check_permission('manage_bid_win');
		$CI->load->library('admin/bid_win');
        if(!$mobile_no) {
            $CI->session->set_userdata(array('warning_message'=>"Please select user perfectly !"));
            redirect(base_url('admin/bid_win'));
        }
        $content = $CI->bid_win->get_details_view($mobile_no);
        $bred_cumb = array(
			array('label'=> 'Manage Bid wins', 'url' => 'admin/bid_win'),
			array('label'=> 'User details', 'url' => 'admin/bid_win/details/'.$mobile_no,'class' =>'active')
		);
        $page_title = "Bid wins Management";
		$this->admin_template->full_html_view($content,$bred_cumb,$page_title);
	}
}