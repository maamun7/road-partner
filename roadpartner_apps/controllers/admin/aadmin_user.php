<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aadmin_user extends CI_Controller {
	
	function __construct() {
      parent::__construct();
        $this->load->library('admin/admin_user');
        $this->load->model('admin/admin_users');
	    $this->admin_template->current_menu = 'admin_user';
    }

	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manage_user');

		$base_url = base_url()."admin/admin_user/index";
		$total_rows = $this->admin_users->total_admin_user();	
		$limit_per_page = 50;
		$config = get_pagination_config($base_url,$total_rows,$limit_per_page,$uri_segment=4);
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	    $links = $this->pagination->create_links();
		
        $content = $CI->admin_user->get_list_view($limit_per_page,$page,$links);
        $bred_cumb = array(
			array('label'=> 'Manage User', 'url' => 'admin/admin_user','class' =>'active')
		);
        $page_title = "Admin User Management";
		$this->admin_template->full_html_view($content,$bred_cumb,$page_title);
	}
	
	public function add()
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('add_user');
		
		if($this->admin_user->validateForm()){
            $basic_data = array(
                'first_name' 	=> $this->input->post('first_name',TRUE),
                'last_name' 	=> $this->input->post('last_name',TRUE),
                'designation' 	=> $this->input->post('designation',TRUE),
                'mobile' 		=> $this->input->post('mobile',TRUE),
                'created_by' 	=> $this->a_auth->get_user_id(),
                'created_at' 	=> current_bd_date_time(),
                'status' 		=> 1
            );
            $user_id = $CI->admin_users->insert_basic_info($basic_data);
			if ($user_id) {
				$login_data = array(
					'user_id' 		=> $user_id,
					'username' 		=> $this->input->post('email'),
					'password' 		=> md5("moon".$this->input->post('password')),
					'can_login' 	=> $this->input->post('can_login')
				);
				$CI->admin_users->insert_login_info($login_data);
				
				$role_relation = array(
					'user_id' 		=> $user_id,
					'role_id' 		=> $this->input->post('user_role')
				);
				$CI->admin_users->insert_user_role_relation($role_relation);
			}
			$this->session->set_userdata(array('message'=>"Successfully Added !"));			
			redirect(base_url('admin/admin_user'));
			exit;							
		}else{
			$content = $CI->admin_user->add_form();
			$breadcrumb = array(
				array('label'=> 'Manage User', 'url' => 'admin/admin_user'),
				array('label'=> 'New User', 'url' => 'admin/admin_user/add','class' =>'active')
			);
			$page_title = "Admin User Management";
			$this->admin_template->full_html_view($content,$breadcrumb,$page_title);
		}
	}
	
	public function edit($user_id=null)
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_user');
		if (!$user_id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select user to edit !"));
			redirect(base_url('admin/admin_user'));
			exit();
		}
		
		if($this->admin_user->validateEditForm()){
			$user_id = $this->input->post('user_id');
            $basic_data = array(
                'first_name' 	=> $this->input->post('first_name',TRUE),
                'last_name' 	=> $this->input->post('last_name',TRUE),
                'designation' 	=> $this->input->post('designation',TRUE),
                'mobile' 		=> $this->input->post('mobile',TRUE),
                'created_by' 	=> $this->a_auth->get_user_id(),
                'created_at' 	=> current_bd_date_time(),
                'status' 		=> 1
            );
            $CI->admin_users->update_basic_info($basic_data,$user_id);
			if ($user_id) {
				$login_data = array(
					'username' 		=> $this->input->post('email',TRUE),
					'can_login' 	=> $this->input->post('can_login',TRUE),
				);
				$CI->admin_users->update_login_info($login_data,$user_id);
				
				$role_relation = array(
					'user_id' 		=> $user_id,
					'role_id' 		=> $this->input->post('user_role',TRUE),
				);
				$CI->admin_users->update_user_role_relation($role_relation,$user_id);
			}
			$this->session->set_userdata(array('message'=>"Successfully Updated !"));			
			redirect(base_url('admin/admin_user'));
			exit;							
		}else{
			$content = $CI->admin_user->edit_form($user_id);
			$bred_cumb = array(
				array('label'=> 'Manage User', 'url' => 'admin/admin_user'),
				array('label'=> 'Edit User', 'url' => 'admin/admin_user/edit/'.$user_id,'class' =>'active')
			);
			$page_title = "Admin User Management";
			$this->admin_template->full_html_view($content,$bred_cumb,$page_title);
		}
	}
	
	public function change_password($user_id=null)
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('change_password');
		if (!$user_id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select user to change password !"));
			redirect(base_url('admin/admin_user'));
			exit();
		}
		
		if($this->admin_user->validateCahngePass()){
			$user_id = $this->input->post('user_id');
			if ($user_id) {
				$login_data = array(
					'password' 		=> md5("moon".$this->input->post('password'))
				);
				$CI->admin_users->update_login_info($login_data,$user_id);
			}
			$this->session->set_userdata(array('message'=>"Successfully Updated !"));			
			redirect(base_url('admin/admin_user'));
			exit;							
		}else{
			$content = $CI->admin_user->change_psss($user_id);
			$bred_cumb = array(
				array('label'=> 'Manage User', 'url' => 'admin/admin_user'),
				array('label'=> 'Change Password', 'url' => 'admin/admin_user/change_password/'.$user_id,'class' =>'active')
			);
			$page_title = "Admin User Management";
			$this->admin_template->full_html_view($content,$bred_cumb,$page_title);
		}
	}

	public function change_own_password()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('change_own_password');
        $user_id = $this->a_auth->get_user_id();
		if ($user_id == '') {
			$this->session->set_userdata(array('error_message'=>"Session is not set !"));
			redirect(base_url('admin'));
			exit();
		}

		if($this->admin_user->validateChangeOwnPass()){
			if ($user_id) {
				$login_data = array(
					'password' 		=> md5("moon".$this->input->post('new_password'))
				);
				$CI->admin_users->update_login_info($login_data,$user_id);
			}
			$this->session->set_userdata(array('message'=>"Successfully Updated !"));
			redirect(base_url('admin'));
			exit;
		}else{
			$content = $CI->admin_user->change_own_password($user_id);
			$bred_cumb = array(
				array('label'=> 'Manage User', 'url' => 'admin/admin_user'),
				array('label'=> 'Change Password', 'url' => 'admin/admin_user/change_own_password/'.$user_id,'class' =>'active')
			);
			$page_title = "Admin User Management";
			$this->admin_template->full_html_view($content,$bred_cumb,$page_title);
		}
	}
	
	public function details($user_id=null)
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('user_details');
		if (!$user_id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select user !"));
			redirect(base_url('admin/admin_user'));
			exit();
		}
		
		$content = $CI->admin_user->get_detail_view($user_id);
		$bred_cumb = array(
			array('label'=> 'Manage User', 'url' => 'admin/admin_user'),
			array('label'=> 'User Details', 'url' => 'admin/admin_user/details/'.$user_id,'class' =>'active')
		);
		$page_title = "Admin User Management";
		$this->admin_template->full_html_view($content,$bred_cumb,$page_title);
		
	}

	public function delete()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('delete_admin_user');
		$CI->load->model('admin/admin_users');
		$admin_user_id =  $_POST['admin_user_id'];
		$CI->admin_users->do_delete($admin_user_id);
		$this->session->set_userdata(array('message'=>"Successfully Deleted !"));
		redirect(base_url('admin/admin_user'));
		return true;	
	}	
}
