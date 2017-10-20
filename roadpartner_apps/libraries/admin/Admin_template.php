<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_template {
	var $current_menu = 'home';
	// View Message
	function flash_message()
	{
		$CI =& get_instance();
		$CI->load->library('parser');
		
		$message = '';
		$message_class = '';
		$html = '';
		
		if($CI->session->userdata('message') != '')
		{
			$message = $CI->session->userdata('message');
			$message_class = 'alert-success';
		}elseif($CI->session->userdata('info_message') != '')
		{
			$message = $CI->session->userdata('info_message');
			$message_class = 'alert-info';
		}elseif($CI->session->userdata('warning_message') != '')
		{
			$message = $CI->session->userdata('warning_message');
			$message_class = 'alert-warning';
		}elseif($CI->session->userdata('error_message') != '')
		{
			$message = $CI->session->userdata('error_message');
			$message_class = 'alert-danger';
		}

		$data = array(
			'message' => $message,
			'message_class' => $message_class
		);

		if($message != '')
			$html = $CI->parser->parse('admin/include/flash_message',$data,true);

		$CI->session->unset_userdata('message');
		$CI->session->unset_userdata('info_message');
		$CI->session->unset_userdata('warning_message');
		$CI->session->unset_userdata('error_message');

		return $html;
	}
	//Admin Html View....
	public function full_html_view($content,$breadcrumb='',$page_title=''){
	
		$CI =& get_instance();
		$message = $this->flash_message();
		$logged_info='';
		$top_menu='';
		$left_menu='';
		
		if ($CI->a_auth->is_logged())
		{
			$menu_template = 'admin/include/top_nav';
			$left_menu_template = 'admin/include/left_sidebar';			
			$log_info = array(
				'email'     => $CI->session->userdata('user_name'),
				'logout'    => base_url().'admin/auth/logout',
				'full_name' => $CI->a_auth->get_user_full_name(),
			);
			$logged_info = $CI->parser->parse('admin/include/loggedin_info',$log_info,true);	
			// parse menu
			$menu_data = array(
				'active' => $this->current_menu,
				'login_data' 	=> $logged_info,
                'full_name' => $CI->a_auth->get_user_full_name(),
			);
			$top_menu = $CI->parser->parse($menu_template,$menu_data,true);
			$left_menu = $CI->parser->parse($left_menu_template,$menu_data,true);
		}
		//Sub Menu
		if ($breadcrumb != '')
		{
			// insert empty text to non assigned elments
			foreach($breadcrumb as $k=>$bread){
				if(!isset($bread['title']))$breadcrumb[$k]['title']='';
				if(!isset($bread['class']))$breadcrumb[$k]['class']='';
			}
			$breadcrumb = $CI->parser->parse('admin/include/breadcrumb', array('breadcrumbs'=>$breadcrumb), true);
		}
		
		$data = array (
			'top_menus' 	    => $top_menu,
			'left_menus' 	    => $left_menu,
			'page_title' 	    => $page_title,
			'breadcrumb' 		=> $breadcrumb,
			'main_content' 		=> $content,
			'flash_message' 	=> $message
		);
		$CI->parser->parse('admin/master_template',$data);
	}
	
	public function admin_login_view(){
	
		$CI =& get_instance();
		$message = $this->flash_message();
		$data = array (
			'msg_content' 	=> $message
		);
		$CI->parser->parse('admin/include/login_form',$data);
	}
	
	
}