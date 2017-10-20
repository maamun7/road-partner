<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Role {
	var $error = array();
	public function get_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/roles');		
		$all_role = $CI->roles->get_list($limit,$page);
		if(!empty($all_role)){
			$i = $page;
			foreach($all_role as $k=>$val){
				$i++;
				$all_role[$k]['sl']= $i;
				$all_role[$k]['create_time']= date_am_pm_format($val['created_at']);
			}
		}
		$data = array(
			'title' => 'Role List',
			'role_lists' => $all_role,
			'links' => $links
		);
		$list_view =  $CI->parser->parse('admin/role/index',$data,true);
		return $list_view;
	}
	
	public function get_search_view($key_words)
	{
		$CI =& get_instance();
		$CI->load->model('admin/roles');
		$all_role = $CI->roles->get_search_items($key_words);
		$i=0;
		if(!empty($all_role)){
			$i = 0;
			foreach($all_role as $k=>$val){
				$i++;
				$all_role[$k]['sl']= $i;
				if($val['published']==1){
					$all_role[$k]['sts_class']="fa-check-square-o";
				}else{
					$all_role[$k]['sts_class']="fa-times";
				}
			}
		}	
		$data = array(
				'title' => 'Admin_user List',
				'role_lists' => $all_role,
			);
		$roleList = $CI->parser->parse('admin/role/index',$data,true);
		return $roleList;
	}

	public function add_form()
	{
		$CI =& get_instance();
		$CI->load->model('admin/roles');
		$this->data['error_warning'] = "";
		
		if (isset($this->error['error_role_name'])) {
			$this->data['error_role_name'] = $this->error['error_role_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_role_name'] = '';
		}

        if(isset($_POST['role_name'])){
            $this->data['role_name_value'] = $CI->input->post('role_name');
        }

		$this->data['title'] = 'Add New Admin_user';
		$this->data['action'] = base_url().'admin/role/add';
		$this->data['permissions'] = $this->get_permission();

		$html_view = $CI->parser->parse('admin/role/add',$this->data,true);
		return $html_view;
	}


    private function get_permission()
    {
        $CI =& get_instance();
        $CI->load->model('roles');
        $group = $CI->roles->get_all_group();
        $i = -1;
        $custom = array();
        if (!empty($group)) {
            foreach($group as $k => $v){
                $permission = $CI->roles->get_by_group_id($v['id']);
                // echo count($permision).',_';
                if(count($permission)> 0){$i++;
                    $custom[$k]['permissions'] = $permission;
                    $custom[$k]['group'] = $v['group_name'];
                    $custom[$k]['group_id'] = $v['id'];
                }

            }
        }
        $permissions = $CI->parser->parse('admin/role/all_permission', array('groups'=>$custom), TRUE);
        return $permissions;
    }

	public function edit_form($role_id)
	{
        $CI =& get_instance();
        $CI->load->model('admin/roles');
        $this->data['error_warning'] = "";

        if (isset($this->error['error_role_name'])) {
            $this->data['error_role_name'] = $this->error['error_role_name'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_role_name'] = '';
        }

        $edit_data = $CI->roles->get_edit_data($role_id);

        if(!empty($edit_data)) {
            $this->data['role_id'] = $edit_data[0]['role_id'];
            $this->data['role_name_value'] = $edit_data[0]['role_name'];
        }

        if(isset($_POST['role_name'])){
            $this->data['role_name_value'] = $CI->input->post('role_name');
        }

        $this->data['title'] = 'Edit admin user';
        $this->data['action'] = base_url().'admin/role/edit/'.$role_id;
        $this->data['permissions'] = $this->get_edit_permissions($role_id);
        $html_view = $CI->parser->parse('admin/role/edit',$this->data,true);
        return $html_view;
	}

	public function validateForm()
	{	
		$CI =& get_instance();

		if(isset($_POST['role_name'])){
			if(strlen($CI->input->post('role_name')) < 1){
				$this->error['error_role_name']="Enter role name";
			} 
		} else {
			$this->error['error_role_name']="";
		}
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}

    public function get_edit_permissions($role_id)
    {
        $CI =& get_instance();
        $CI->load->model('roles');
        $res = $CI->roles->get_permission_by_role_id($role_id);
        $exist_permission = explode(',',trim($res[0]['permission'],','));
        $group = $CI->roles->get_all_group();

        //  $data = $this->get_all();
        $i = -1;
        $custom = array();
        foreach($group as $k => $v){
            $permission = $CI->roles->get_by_group_id($v['id']);
            // echo count($permision).',_';
            if(count($permission)> 0){$i++;
                foreach($permission as $j=>$perm){
                    if(in_array($perm['name'],$exist_permission)){ $permission[$j]['is_checked'] = 'checked="checked"';} else {$permission[$j]['is_checked'] = '';}
                }
                $custom[$k]['permissions']=$permission;
                $custom[$k]['group']=$v['group_name'];
                $custom[$k]['group_id']=$v['id'];
            }
        }
        $permissions = $CI->parser->parse('admin/role/edit_permission', array('groups'=>$custom), TRUE);
        return $permissions;
    }
}
