<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard {
	// Retrieve 
	public function admin_home_page()
	{
		$CI =& get_instance();
		$CI->load->model('admin/dashboards');
		$data = array(
			'title' => 'Road partner admin panel',
			'total_user' => "",
			'today_register' => "",
			'yesterday_register' => "",
			'today_read' => "",
		);
		$dashboard_view = $CI->parser->parse('admin/dashboard',$data,true);
		return $dashboard_view;
	}
}
?>