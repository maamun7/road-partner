<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_auth {
    public function login($username,$password)
    {
        $CI =& get_instance();
        $CI->load->model('admin/auths');
        $result = $CI->auths->check_valid_user($username,$password);

        if ($result)
        {
            $key = md5(time());
            $key = str_replace("1", "z", $key);
            $key = str_replace("2", "J", $key);
            $key = str_replace("3", "y", $key);
            $key = str_replace("4", "R", $key);
            $key = str_replace("5", "Kd", $key);
            $key = str_replace("6", "jX", $key);
            $key = str_replace("7", "dH", $key);
            $key = str_replace("8", "p", $key);
            $key = str_replace("9", "Uf", $key);
            $key = str_replace("0", "eXnyiKFj", $key);
            $sid_web = substr($key, rand(0, 3), rand(28, 32));

            // codeigniter session stored data
            $user_data = array(
                'sid_web' 		    => $sid_web,
                'a_user_id' 		=> $result[0]['user_id'],
                'user_name' 	    => $result[0]['username'],
                'name' 			    => $result[0]['first_name']." ".$result[0]['last_name']
            );
            $CI->session->set_userdata($user_data);
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function check_auth($url='')
	{   
        if($url==''){$url = base_url().'admin/auth/login';}
		$CI =& get_instance();
        if (!$CI->auth->is_logged() )
		{   
            redirect($url,'refresh'); exit;
        }
	}
	 
	public function is_logged()
	{
		$CI =& get_instance();
        if($CI->session->userdata('sid_web'))
		{
			return true;
		}		
		return false;
	}
	
	public function is_admin()
	{
		$CI =& get_instance();
        $CI->load->model('admin/auths');
		$type = $CI->auths->check_by_user_id($this->get_user_id());
		
        if ($type[0]['status']==2)
		{
			return true;
		}
		return false;
	}
	
	public function logout()
	{
		$CI =& get_instance();
		$user_data = array(
			'sid_web' 		    => '',
			'a_user_id' 		=> '',
			'name' 			    => '',
			'user_name' 	    => ''
		);
        $CI->session->unset_userdata($user_data);
        $CI->session->sess_destroy();
		return true;
	}
	
	public function get_user_id()
	{
		$CI =& get_instance();
		$CI->load->model('admin/auths');
		return $CI->session->userdata('a_user_id');
	}

	public function get_user_full_name()
	{
		$CI =& get_instance();
		$CI->load->model('admin/auths');
		return $CI->session->userdata('name');
	}
	
	// checking user has role and return role id
    private function has_role($user_id){
        $CI =& get_instance();
        $CI->load->model('admin/auths');
        $role = $CI->auths->get_by_user_id($user_id);
        $role_id = $role[0]['role_id'];
        return $role_id;
    }

    // if user has desired task permission
    function check_permission($slug, $redirect = true, $user_id = 0)
    {
        $CI =& get_instance();
		$CI->load->model('admin/auths');
        if ($user_id == 0){
            $user_id = $this->get_user_id();
        }

        // if user has the role and permission
        // then return true
        // else
        // return to dashbord or the referrer and show 'You dont have permission to access this page'

        $role_id = $this->has_role($user_id);        
        // if Administrator role
        if( $role_id === '1')
            return true;
			$res = $CI->auths->get_by_role_id_and_slug($role_id,$slug);
        if(count($res) > 0){
            return true;
        }else{
            if($redirect)
            {
                $CI->session->set_userdata(array('error_message'=>"You don't have permission to access this page!"));
                redirect(base_url().'admin/dashboard','refresh');
            }
            else
			return false;
            //$CI->output->set_header("Location: ".base_url().'admin/dashboard', TRUE, 302);
        }
    }

}