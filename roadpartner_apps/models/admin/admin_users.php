<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin_users extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function total_admin_user()
	{
		$this->db->select('*');
		$this->db->from('admin_login');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function get_list($limit,$page)
	{
        $this->db->select(
            'x.user_id,x.first_name,x.last_name,x.designation,x.mobile,'
            .'y.username,y.user_type,y.is_active,y.can_login,'
            .'z.role_id,z.role_name'
        );
        $this->db->from('admin_users x');
        $this->db->join('admin_login y','y.user_id = x.user_id','left');
        $this->db->join('user_role_relation p','p.user_id=x.user_id','left');
        $this->db->join('roles z','p.role_id=z.role_id','left');
        $this->db->limit($limit, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
	}

    public function get_role()
    {
        $this->db->select('role_id,role_name');
        $this->db->from('roles');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function insert_basic_info($basic_data)
    {
        $this->db->insert('admin_users',$basic_data);
        return $this->db->insert_id();
    }

    public function insert_login_info($login_data)
    {
        $this->db->insert('admin_login',$login_data);
        return true;
    }

    public function insert_user_role_relation($role_relation)
    {
        $this->db->insert('user_role_relation',$role_relation);
        return true;
    }

    public function get_edit_data($user_id)
    {
        $this->db->select('x.*,y.*,z.*');
        $this->db->from('admin_users x');
        $this->db->join('admin_login y','y.user_id = x.user_id','left');
        $this->db->join('user_role_relation p','p.user_id=x.user_id','left');
        $this->db->join('roles z','p.role_id=z.role_id','left');
        $this->db->where('x.user_id',$user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function update_basic_info($data,$user_id)
    {
        $this->db->where('user_id',$user_id);
        $this->db->update('admin_users',$data);
        return true;
    }

    public function update_login_info($data,$user_id)
    {
        $this->db->where('user_id',$user_id);
        $this->db->update('admin_login',$data);
        return true;
    }

    public function update_user_role_relation($data,$user_id)
    {
        $this->db->where('user_id',$user_id);
        $this->db->update('user_role_relation',$data);
        return true;
    }

    public function get_details_data($user_id)
    {
        $this->db->select('x.*,y.*,z.*');
        $this->db->from('admin_users x');
        $this->db->join('admin_login y','y.user_id = x.user_id','left');
        $this->db->join('user_role_relation p','p.user_id=x.user_id','left');
        $this->db->join('roles z','p.role_id=z.role_id','left');
        $this->db->where('x.user_id',$user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	public function do_delete($chapter_id)
	{
		$this->db->where('id',$chapter_id);
		$this->db->update('chapter',array('is_delete'=>1)); 
		return true;
	}

    public function match_old_password($user_id,$old_password)
    {
        $this->db->select('*');
        $this->db->from('admin_login');
        $this->db->where(array('user_id'=>$user_id,'password'=>$old_password));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

}