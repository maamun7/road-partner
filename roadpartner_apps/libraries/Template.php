<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template {
	var $current_menu = 'home';
	
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

		if($message != ''){
			$html = $CI->parser->parse('front/include/message',$data,true);
		}

		$CI->session->unset_userdata('message');
		$CI->session->unset_userdata('info_message');
		$CI->session->unset_userdata('warning_message');
		$CI->session->unset_userdata('error_message');
		return $html;
	}
	
	public function home($content,$sub_menu=''){
		$CI =& get_instance();
		$message = $this->flash_message();
		$logged_info='';
		$top_menu='';
        $short_name = '';

        //If user is not logged in
		$menu_template = 'front/include/menu';
		$menu_data = array(
			'active' => $this->current_menu
		);
		$top_menu = $CI->parser->parse($menu_template,$menu_data,true);
        $footer_menu = '';

        //If user is logged in
      /*  if ($CI->auth->is_logged())
        {
            $menu_template = 'common/front/loggedin_top_menu';

            $login_data = $CI->eusers->get_login_info();
            $image = $login_data[0]['image'];
            $short_name = $login_data[0]['first_name'];
            if ($image == "") {
                $image = "default.jpg";
            }

            $account_data = array(
                'name'=> $login_data[0]['first_name']." ".$login_data[0]['last_name'],
                'image'=> $image,
                'address'=> $login_data[0]['address'],
                'phone'=> $login_data[0]['phone'],
                'mobile'=> $login_data[0]['mobile'],
            );

            $menu_data = array(
                'active' => $this->current_menu,
                'image'=> $image,
                'short_name'=> $short_name,
            );

            $top_menu = $CI->parser->parse($menu_template,$menu_data,true);
            $footer_menu = $CI->parser->parse('front/include/menu',[],true);
        }*/
	
		$data = array (
			'login_data' 		=> $logged_info,
			'main_menus' 		=> $top_menu,
            'footer_menus' 	    => $footer_menu,
			'content' 			=> $content,
			'msg_content' 		=> $message
		);
		$CI->parser->parse('front/html_template',$data);
	}
}