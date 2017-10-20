<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auths extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function check_valid_user($username,$password)
	{ 	
		$password = md5("moon".$password);
        $this->db->where(array('username'=>$username,'password'=>$password,'is_active'=>'1','can_login'=>'1'));
		$query = $this->db->get('admin_login');
		$result =  $query->result_array();	
		if (count($result) == '1')
		{
			$user_id = $result[0]['user_id'];

			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			    $login_ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    $login_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    $login_ip = $_SERVER['REMOTE_ADDR'];
			}

			$login_time = date('Y-m-d h:i:s', time());
			$user_agent = $_SERVER['HTTP_USER_AGENT'];

			$logged_data = array(
				'last_login' => $login_time ,
				'user_agent' => $user_agent,
				'login_ip' => $login_ip
			);

			$this->db->where('user_id',$user_id);
			$this->db->update('admin_login',$logged_data);

			$this->db->select('a.user_id,a.username,b.first_name,b.last_name,b.mobile');
			$this->db->from('admin_login a');
			$this->db->join('admin_users b','b.user_id = a.user_id');
			$this->db->where('a.user_id',$user_id);
			$query = $this->db->get();
			return $query->result_array();
		}
		return false;
	}
	
	function check_by_user_id($user_id)
	{
		$this->db->where('user_id',$user_id);
        $q = $this->db->get('admin_users');
        return $q->result_array();
	}

	function get_by_user_id($user_id)
	{
		$this->db->where('user_id',$user_id);
        $query= $this->db->get('user_role_relation');
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return 0;
	}
	
	function get_by_role_id_and_slug($role_id,$slug)
	{ 
        $this->table = 'role_permissions';
        $this->db->from($this->table.' as r');
        $this->db->where("r.role_id",$role_id);
        $this->db->like("r.permission",$slug);
        $query = $this->db->get();
        return $query->result_array();
	}

}