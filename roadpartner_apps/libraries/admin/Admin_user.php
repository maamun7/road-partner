<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_user {
	var $error = array();
	public function get_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/admin_users');		
		$all_admin_user = $CI->admin_users->get_list($limit,$page);
		if(!empty($all_admin_user)){
			$i = $page;
			foreach($all_admin_user as $k=>$val){
				$i++;
				$all_admin_user[$k]['sl']= $i;
			}
		}
		$data = array(
			'title' => 'Admin User List',
			'user_lists' => $all_admin_user,
			'links' => $links,
			'search_action' => "#"
		);
		$list_view =  $CI->parser->parse('admin/admin_user/index',$data,true);
		return $list_view;
	}
	
	public function get_search_view($key_words)
	{
		$CI =& get_instance();
		$CI->load->model('admin/admin_users');
		$all_admin_user = $CI->admin_users->get_search_items($key_words);
		$i=0;
		if(!empty($all_admin_user)){
			$i = 0;
			foreach($all_admin_user as $k=>$val){
				$i++;
				$all_admin_user[$k]['sl']= $i;
				if($val['published']==1){
					$all_admin_user[$k]['sts_class']="fa-check-square-o";
				}else{
					$all_admin_user[$k]['sts_class']="fa-times";
				}
			}
		}	
		$data = array(
				'title' => 'Admin_user List',
				'admin_user_lists' => $all_admin_user,
			);
		$admin_userList = $CI->parser->parse('admin/admin_user/index',$data,true);
		return $admin_userList;
	}

	public function add_form()
	{
		$CI =& get_instance();
		$CI->load->model('admin/admin_users');
		$this->data['error_warning'] = "";
		
		if (isset($this->error['error_first_name'])) {
			$this->data['error_first_name'] = $this->error['error_first_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_first_name'] = '';
		}

		if (isset($this->error['error_last_name'])) {
			$this->data['error_last_name'] = $this->error['error_last_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_last_name'] = '';
		}

		if (isset($this->error['error_designation'])) {
			$this->data['error_designation'] = $this->error['error_designation'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_designation'] = '';
		}	
			
		if (isset($this->error['error_email'])) {
			$this->data['error_email'] = $this->error['error_email'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_email'] = '';
		}
			
		if (isset($this->error['error_mobile'])) {
			$this->data['error_mobile'] = $this->error['error_mobile'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_mobile'] = '';
		}
			
		if (isset($this->error['error_password'])) {
			$this->data['error_password'] = $this->error['error_password'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_password'] = '';
		}
			
		if (isset($this->error['error_user_role'])) {
			$this->data['error_user_role'] = $this->error['error_user_role'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_user_role'] = '';
		}
			
		if (isset($this->error['error_can_login'])) {
			$this->data['error_can_login'] = $this->error['error_can_login'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_can_login'] = '';
		}
		
		//User entered value
        if(isset($_POST['first_name'])){
            $this->data['first_name_value'] = $CI->input->post('first_name');
        }
		
        if(isset($_POST['last_name'])){
            $this->data['last_name_value'] = $CI->input->post('last_name');
        }

        if(isset($_POST['designation'])){
            $this->data['designation_value'] = $CI->input->post('designation');
        }

        if(isset($_POST['email'])){
            $this->data['email_value'] = $CI->input->post('email');
        }

        if(isset($_POST['can_login'])){
            $this->data['can_login_value'] = $CI->input->post('can_login');
        }

		if(isset($_POST['mobile'])){
			$this->data['mobile_value'] = $CI->input->post('mobile');
		}

        if(isset($_POST['user_role'])){
            $this->data['user_role_value'] = $CI->input->post('user_role');
        }

		$this->data['title'] = 'Add New Admin_user';
		$this->data['action'] = base_url().'admin/admin_user/add';
		$this->data['roles'] = $CI->admin_users->get_role();

		$html_view = $CI->parser->parse('admin/admin_user/add',$this->data,true);
		return $html_view;
	}
	
	public function validateForm()
	{	
		$CI =& get_instance();

		if(isset($_POST['first_name'])){
			if(strlen($CI->input->post('first_name'))==''){
				$this->error['error_first_name']="First name is required";
			} elseif(strlen($CI->input->post('first_name'))<3 || strlen($CI->input->post('first_name'))>100){
				$this->error['error_first_name']="First name must be between 3 to 100 characters";
			}
		} else {
			$this->error['error_first_name']="";
		}
		
		if(isset($_POST['last_name'])){
			if(strlen($CI->input->post('last_name'))==''){
				$this->error['error_last_name']="Last name is required";
			} elseif(strlen($CI->input->post('last_name'))<3 || strlen($CI->input->post('last_name'))>100){
				$this->error['error_last_name']="Last name must be between 3 to 100 characters";
			}
		} else {
			$this->error['error_last_name']="";
		}
		
		if(isset($_POST['designation'])){
			if(strlen($CI->input->post('designation'))==''){
				$this->error['error_designation']="Designation is required";
			} elseif(strlen($CI->input->post('designation'))<2 || strlen($CI->input->post('designation'))>150){
				$this->error['error_designation']="Designation must be between 2 to 150 characters";
			}
		} else {
			$this->error['error_designation']="";
		}
		
		if(isset($_POST['mobile'])){
			if(strlen($CI->input->post('mobile'))==''){
				$this->error['error_mobile']="Mobile number is required";
			} elseif(strlen($CI->input->post('mobile'))<11 || strlen($CI->input->post('mobile'))>11){
				$this->error['error_mobile']="Mobile number must be within 11 number";
			}
		} else {
			$this->error['error_mobile']="";
		}
		
		if(isset($_POST['email'])){
			if($CI->input->post('email') ==''){
				$this->error['error_email']="Email is required";
			} elseif(!filter_var($CI->input->post('email'), FILTER_VALIDATE_EMAIL)) {
			    $this->error['error_email']="Invalid email";
			}
		} else {
			$this->error['error_email'] = "";
		}
		
		if(isset($_POST['password'])){
			if(strlen($CI->input->post('password'))==''){
				$this->error['error_password']="Password is required";
			} elseif(strlen($CI->input->post('password'))<6 || strlen($CI->input->post('designation'))>20){
				$this->error['error_password']="Password must be between 6 to 20 characters";
			}
		} else {
			$this->error['error_password']="";
		}
		
		if(isset($_POST['user_role'])){
			if($CI->input->post('user_role') == ''){
				$this->error['error_user_role']="Please select role";
			} 
		} else {
			$this->error['error_user_role']="";
		}
		
		if(isset($_POST['can_login'])){
			if($CI->input->post('can_login') == ''){
				$this->error['error_can_login']="Please select yes or not";
			} 
		} else {
			$this->error['error_can_login']="";
		}	
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}

	public function edit_form($user_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/admin_users');
		$this->data['error_warning'] = "";
		
		if (isset($this->error['error_first_name'])) {
			$this->data['error_first_name'] = $this->error['error_first_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_first_name'] = '';
		}

		if (isset($this->error['error_last_name'])) {
			$this->data['error_last_name'] = $this->error['error_last_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_last_name'] = '';
		}

		if (isset($this->error['error_designation'])) {
			$this->data['error_designation'] = $this->error['error_designation'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_designation'] = '';
		}	
			
		if (isset($this->error['error_email'])) {
			$this->data['error_email'] = $this->error['error_email'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_email'] = '';
		}
			
		if (isset($this->error['error_mobile'])) {
			$this->data['error_mobile'] = $this->error['error_mobile'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_mobile'] = '';
		}
			
		if (isset($this->error['error_user_role'])) {
			$this->data['error_user_role'] = $this->error['error_user_role'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_user_role'] = '';
		}
			
		if (isset($this->error['error_can_login'])) {
			$this->data['error_can_login'] = $this->error['error_can_login'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_can_login'] = '';
		}

		$edit_data = $CI->admin_users->get_edit_data($user_id);

		if(!empty($edit_data)){
			$this->data['first_name_value'] 	= $edit_data[0]['first_name'];
			$this->data['last_name_value'] 		= $edit_data[0]['last_name'];
			$this->data['designation_value'] 	= $edit_data[0]['designation'];
			$this->data['email_value'] 			= $edit_data[0]['username'];
			$this->data['can_login_value'] 		= $edit_data[0]['can_login'];
			$this->data['mobile_value'] 		= $edit_data[0]['mobile'];
			$this->data['user_role_value'] 		= $edit_data[0]['role_id'];
		}

		$this->data['user_id'] = $user_id;

		//User entered value
        if(isset($_POST['first_name'])){
            $this->data['first_name_value'] = $CI->input->post('first_name');
        }
		
        if(isset($_POST['last_name'])){
            $this->data['last_name_value'] = $CI->input->post('last_name');
        }

        if(isset($_POST['designation'])){
            $this->data['designation_value'] = $CI->input->post('designation');
        }

        if(isset($_POST['email'])){
            $this->data['email_value'] = $CI->input->post('email');
        }

        if(isset($_POST['can_login'])){
            $this->data['can_login_value'] = $CI->input->post('can_login');
        }

		if(isset($_POST['mobile'])){
			$this->data['mobile_value'] = $CI->input->post('mobile');
		}
		

        if(isset($_POST['user_role'])){
            $this->data['user_role_value'] = $CI->input->post('user_role');
        }
		
		$this->data['title'] = 'Edit Admin_user';
		$this->data['action'] = base_url().'admin/admin_user/edit/'.$user_id;
		$this->data['roles'] = $CI->admin_users->get_role();
		$html_view = $CI->parser->parse('admin/admin_user/edit',$this->data,true);
		return $html_view;
	}

    public function validateEditForm()
    {
        $CI =& get_instance();

        if(isset($_POST['first_name'])){
            if(strlen($CI->input->post('first_name'))==''){
                $this->error['error_first_name']="First name is required";
            } elseif(strlen($CI->input->post('first_name'))<3 || strlen($CI->input->post('first_name'))>100){
                $this->error['error_first_name']="First name must be between 3 to 100 characters";
            }
        } else {
            $this->error['error_first_name']="";
        }

        if(isset($_POST['last_name'])){
            if(strlen($CI->input->post('last_name'))==''){
                $this->error['error_last_name']="Last name is required";
            } elseif(strlen($CI->input->post('last_name'))<3 || strlen($CI->input->post('last_name'))>100){
                $this->error['error_last_name']="Last name must be between 3 to 100 characters";
            }
        } else {
            $this->error['error_last_name']="";
        }

        if(isset($_POST['designation'])){
            if(strlen($CI->input->post('designation'))==''){
                $this->error['error_designation']="Designation is required";
            } elseif(strlen($CI->input->post('designation'))<2 || strlen($CI->input->post('designation'))>150){
                $this->error['error_designation']="Designation must be between 2 to 150 characters";
            }
        } else {
            $this->error['error_designation']="";
        }

        if(isset($_POST['mobile'])){
            if(strlen($CI->input->post('mobile'))==''){
                $this->error['error_mobile']="Mobile number is required";
            } elseif(strlen($CI->input->post('mobile'))<11 || strlen($CI->input->post('mobile'))>11){
                $this->error['error_mobile']="Mobile number must be within 11 number";
            }
        } else {
            $this->error['error_mobile']="";
        }

        if(isset($_POST['email'])){
            if($CI->input->post('email') ==''){
                $this->error['error_email']="Email is required";
            } elseif(!filter_var($CI->input->post('email'), FILTER_VALIDATE_EMAIL)) {
                $this->error['error_email']="Invalid email";
            }
        } else {
            $this->error['error_email'] = "";
        }

        if(isset($_POST['user_role'])){
            if($CI->input->post('user_role') == ''){
                $this->error['error_user_role']="Please select role";
            }
        } else {
            $this->error['error_user_role']="";
        }

        if(isset($_POST['can_login'])){
            if($CI->input->post('can_login') == ''){
                $this->error['error_can_login']="Please select yes or not";
            }
        } else {
            $this->error['error_can_login']="";
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

	public function change_psss($user_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/admin_users');
		$this->data['error_warning'] = "";
			
		if (isset($this->error['error_password'])) {
			$this->data['error_password'] = $this->error['error_password'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_password'] = '';
		}
			
		if (isset($this->error['error_conf_password'])) {
			$this->data['error_conf_password'] = $this->error['error_conf_password'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_conf_password'] = '';
		}

		$edit_data = $CI->admin_users->get_edit_data($user_id);

		if(!empty($edit_data)){
			$this->data['first_name'] 	= $edit_data[0]['first_name'];
			$this->data['last_name'] 	= $edit_data[0]['last_name'];
			$this->data['designation'] 	= $edit_data[0]['designation'];
			$this->data['email'] 		= $edit_data[0]['username'];
			$this->data['mobile'] 		= $edit_data[0]['mobile'];
			$this->data['user_role'] 	= $edit_data[0]['role_name'];
		}

		$this->data['user_id'] = $user_id;

		//User entered value
        if(isset($_POST['password'])){
            $this->data['password_value'] = $CI->input->post('password');
        }
		
		$this->data['title'] = 'Change admin user password';
		$this->data['action'] = base_url().'admin/admin_user/change_password/'.$user_id;
		$this->data['roles'] = $CI->admin_users->get_role();
		$html_view = $CI->parser->parse('admin/admin_user/change_pass',$this->data,true);
		return $html_view;
	}

	public function get_detail_view($user_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/admin_users');

		$edit_data = $CI->admin_users->get_edit_data($user_id);

        if(!empty($edit_data)){
			$this->data['first_name'] 	= $edit_data[0]['first_name'];
			$this->data['last_name'] 	= $edit_data[0]['last_name'];
			$this->data['designation'] 	= $edit_data[0]['designation'];
			$this->data['email'] 		= $edit_data[0]['username'];
			$this->data['mobile'] 		= $edit_data[0]['mobile'];
			$this->data['user_role'] 	= $edit_data[0]['role_name'];
			$this->data['create_time'] 	= $edit_data[0]['created_at'];
			$this->data['update_time'] 	= $edit_data[0]['updated_at'];
			$this->data['last_login_at'] = $edit_data[0]['last_login'];
			$this->data['ip'] 	        = $edit_data[0]['login_ip'];
		}
		
		$this->data['title'] = 'Detail admin user';
		$html_view = $CI->parser->parse('admin/admin_user/details',$this->data,true);
		return $html_view;
	}
	
	public function validateCahngePass()
	{	
		$CI =& get_instance();
		
		if(isset($_POST['password'])){
			if($CI->input->post('password')==''){
				$this->error['error_password']="Password is required";
			} elseif(strlen($CI->input->post('password'))<6 || strlen($CI->input->post('password'))>20){
				$this->error['error_password']="Password must be between 6 to 20 characters";
			}
		} else {
			$this->error['error_password']="";
		}
		
		if(isset($_POST['conf_password']) && isset($_POST['conf_password'])){
			if($CI->input->post('conf_password')==''){
				$this->error['error_conf_password']="Confirm password is required";
			} elseif($CI->input->post('conf_password') != $CI->input->post('password')){
				$this->error['error_conf_password']="Confirm password and password doesn't match ";
			}
		} else {
			$this->error['error_conf_password']="";
		}	
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}

    public function change_own_password($user_id)
    {
        $CI =& get_instance();
        $CI->load->model('admin/admin_users');
        $this->data['error_warning'] = "";

        if (isset($this->error['error_old_password'])) {
            $this->data['error_old_password'] = $this->error['error_old_password'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_old_password'] = '';
        }

        if (isset($this->error['error_new_password'])) {
            $this->data['error_new_password'] = $this->error['error_new_password'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_new_password'] = '';
        }

        if (isset($this->error['error_conf_password'])) {
            $this->data['error_conf_password'] = $this->error['error_conf_password'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_conf_password'] = '';
        }

        $edit_data = $CI->admin_users->get_edit_data($user_id);

        if(!empty($edit_data)){
            $this->data['first_name'] 	= $edit_data[0]['first_name'];
            $this->data['last_name'] 	= $edit_data[0]['last_name'];
            $this->data['designation'] 	= $edit_data[0]['designation'];
            $this->data['email'] 		= $edit_data[0]['username'];
            $this->data['mobile'] 		= $edit_data[0]['mobile'];
            $this->data['user_role'] 	= $edit_data[0]['role_name'];
        }

        $this->data['user_id'] = $user_id;

        //User entered value
        if(isset($_POST['old_password'])){
            $this->data['old_password_value'] = $CI->input->post('old_password');
        }

        if(isset($_POST['new_password'])){
            $this->data['new_password_value'] = $CI->input->post('new_password');
        }

        if(isset($_POST['conf_password'])){
            $this->data['conf_password_value'] = $CI->input->post('conf_password');
        }


        $this->data['title'] = 'Change admin user password';
        $this->data['action'] = base_url().'admin/admin_user/change_own_password/';
        $this->data['roles'] = $CI->admin_users->get_role();
        $html_view = $CI->parser->parse('admin/admin_user/change_own_pass',$this->data,true);
        return $html_view;
    }

	public function validateChangeOwnPass()
	{
		$CI =& get_instance();
        $user_id = $CI->a_auth->get_user_id();
		if(isset($_POST['old_password'])){
			if($CI->input->post('old_password')==''){
				$this->error['error_old_password']="Old password is required";
			} elseif($CI->admin_users->match_old_password($user_id,md5("moon".$CI->input->post('old_password'))) === FALSE) {
                $this->error['error_old_password']="Doesn't match old password";
            }
		} else {
			$this->error['error_old_password']="";
		}

		if(isset($_POST['new_password'])){
			if($CI->input->post('new_password')==''){
				$this->error['error_new_password']="Password is required";
			} elseif(strlen($CI->input->post('new_password'))<6 || strlen($CI->input->post('new_password'))>20){
				$this->error['error_new_password']="Password must be between 6 to 20 characters";
			}
		} else {
			$this->error['error_new_password']="";
		}

		if(isset($_POST['conf_password']) && isset($_POST['conf_password'])){
			if($CI->input->post('conf_password')==''){
				$this->error['error_conf_password']="Confirm password is required";
			} elseif($CI->input->post('conf_password') != $CI->input->post('new_password')){
				$this->error['error_conf_password']="Confirm password and password doesn't match ";
			}
		} else {
			$this->error['error_conf_password']="";
		}

		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
	
}
