<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Arole extends CI_Controller {
	
	function __construct() {
      parent::__construct();
        $this->load->library('admin/role');
        $this->load->model('admin/roles');
	    $this->admin_template->current_menu = 'role';
    }	
	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manage_role');

		$base_url = base_url()."admin/role/index";
		$total_rows = $this->roles->total_role();	
		$limit_per_page = 50;
		$config = get_pagination_config($base_url,$total_rows,$limit_per_page,$uri_segment=4);
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	    $links = $this->pagination->create_links();
		
        $content = $CI->role->get_list_view($limit_per_page,$page,$links);
        $bred_cumb = array(
			array('label'=> 'Manage Role', 'url' => 'admin/role','class' =>'active')
		);
        $page_title = "Role Management";
		$this->admin_template->full_html_view($content,$bred_cumb,$page_title);
	}
	
	public function add()
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('add_role');
		
		if($this->role->validateForm()) {
            $data = array(
                'role_name' => $this->input->post('role_name',TRUE),
                'created_by' => $this->a_auth->get_user_id(),
                'created_at' => current_bd_date_time(),
                'status' => 1
            );
            $role_id = $CI->roles->insert_role($data);
            if ($role_id) {
                $permission_slug = implode(',',$_POST['permission_slug']);
                $permission_slug = ','.$permission_slug.',';

                $permission_data = array(
                    'role_id'       => $role_id,
                    'permission'    => $permission_slug
                );
                $CI->roles->insert_role_permission($permission_data);
            }

			$this->session->set_userdata(array('message'=>"Role Successfully Added !"));
            redirect(base_url('admin/role'));
            exit;
		}else{
			$content = $CI->role->add_form();
			$breadcrumb = array(
				array('label'=> 'Manage Role', 'url' => 'admin/role'),
				array('label'=> 'New Role', 'url' => 'admin/role/add','class' =>'active')
			);
            $page_title = "Role Management";
			$this->admin_template->full_html_view($content,$breadcrumb,$page_title);
		}
	}
	
	public function edit($role_id = null)
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_role');
		if (!$role_id) {
			$this->session->set_userdata(array('error_message'=>"Did not select role !"));
			redirect(base_url('admin/role'));
			exit();
		}
		
		if($this->role->validateForm()){

			$role_id = $this->input->post('role_id');
            if ($role_id) {
                $data = array(
                    'role_name' => $this->input->post('role_name',TRUE),
                    'created_by' => $this->a_auth->get_user_id(),
                    'created_at' => current_bd_date_time(),
                    'status' => 1
                );

                $CI->roles->update($data,$role_id);

                $permission_slug = implode(',',$_POST['permission_slug']);
                $permission_slug = ','.$permission_slug.',';

                $permission_data = array(
                    'role_id'       => $role_id,
                    'permission'    => $permission_slug
                );
                $CI->roles->update_by_role_id($permission_data,$role_id);
            }
			$this->session->set_userdata(array('message'=>"Successfully Updated !"));
			redirect(base_url('admin/role'));
		}else{
            $content = $CI->role->edit_form($role_id);
            $breadcrumb = array(
                array('label'=> 'Manage Role', 'url' => 'admin/role'),
                array('label'=> 'New Role', 'url' => 'admin/role/add'),
                array('label'=> 'Edit Role', 'url' => 'admin/role/edit/'.$role_id,'class' =>'active')
            );
            $page_title = "Role Management";
            $this->admin_template->full_html_view($content,$breadcrumb,$page_title);
		}
	}
	
	public function sub_categories()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_role');
		$CI->load->model('admin/roles');
		
		$cat_id =  $_POST['cat_id'];	
		$categories = $CI->roles->get_categories($cat_id);
		if ($categories) {
			echo"<option value=''>...Select Sub Category...</option>";
			foreach($categories as $category)
			{		
				echo "<option value='$category->id'>$category->name</option>";
			}
		} else {			
			echo"<option value=''>..No Sub Category Found..</option>";
		}
		
	}
	
	public function subjects()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_role');
		$CI->load->model('admin/roles');
		
		$sub_cat_id =  $_POST['sub_cat_id'];	
		$subjects = $CI->roles->get_subjects($sub_cat_id);
		if ($subjects) {
			echo"<option value=''>...Select Sub Category...</option>";
			foreach($subjects as $subject)
			{		
				echo "<option value='$subject->id'>$subject->subject_name</option>";
			}
		} else {			
			echo"<option value=''>..No Sub Category Found..</option>";
		}
		
	}

	public function change_status()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('change_role_status');
		$CI->load->model('admin/roles');
		$role_id =  $_POST['role_id'];
		$CI->roles->do_change_status($role_id);
		$this->session->set_userdata(array('message'=>"Successfully Status Changed !"));
		redirect(base_url('admin/role'));
		return true;	
	}	

	public function delete()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('delete_role');
		$CI->load->model('admin/roles');
		$role_id =  $_POST['role_id'];
		$CI->roles->do_delete($role_id);
		$this->session->set_userdata(array('message'=>"Successfully Deleted !"));
		redirect(base_url('admin/role'));
		return true;	
	}	
	
	public function search_item()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('role');
		$CI->load->library('admin/role');	
		$key_word = $this->input->post('key_word');	
		if($key_word =="") {
			$this->session->set_userdata(array('warning_message'=>"You didn't type any keyword !"));
			redirect(base_url('admin/role'));
		}		
        $content = $CI->role->get_search_view($key_word);
        $sub_menu = array(
				array('label'=> 'Manage Chapter', 'url' => 'admin/role'),
				array('label'=> 'New Chapter', 'url' => 'admin/role/add'),
				array('label'=> 'Search Chapter', 'url' => 'admin/role','class' =>'active')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}	

}
