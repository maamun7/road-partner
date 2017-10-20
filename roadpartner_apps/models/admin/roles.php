<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class roles extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function total_role()
	{
		$this->db->select('*');
		$this->db->from('roles`');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function get_list($limit,$page)
	{
        $this->db->select('*');
        $this->db->from('roles');
        $this->db->limit($limit, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
	}

	public function get_all_group()
	{
        $this->db->select('id,group_name');
        $this->db->from('permission_groups');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
	}

	public function get_by_group_id($group_id)
	{
        $this->db->select('id,name,display_name');
        $this->db->from('permissions');
        $this->db->where('group_id',$group_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
	}

    public function insert_role($data)
    {
        $this->db->insert('roles',$data);
        return $this->db->insert_id();
    }

    public function insert_role_permission($data)
    {
        $this->db->insert('role_permissions',$data);
        return true;
    }

    public function insert_user_role_relation($role_relation)
    {
        $this->db->insert('user_role_relation',$role_relation);
        return true;
    }

    public function get_role_edit_data($role_id)
    {
        $this->db->where('role_id',$role_id);
        $query = $this->db->get('roles');
        return $query->result_array();
    }

  /*  public function get_by_group_id($group_id)
    {
        $this->db->where('group_id',$group_id);
        $query = $this->db->get('permissions');
        return $query->result_array();
    }*/

    public function get_permission_by_role_id($role_id)
    {
        $this->db->where('role_id',$role_id);
        $query = $this->db->get('role_permissions');
        return $query->result_array();
    }

    function get_edit_data($role_id)
    {
        $this->db->where('role_id',$role_id);
        $q = $this->db->get('roles');
        return $q->result_array();
    }

    function update($data,$role_id)
    {
        $this->db->where('role_id',$role_id);
        $q = $this->db->update('roles',$data);
        return true;
    }

    function get_by_role_id($role_id)
    {
        $this->db->where('role_id',$role_id);
        $q = $this->db->get('roles');
        return $q->result_array();
    }

    function update_by_role_id($data,$role_id)
    {
        $this->db->where('role_id',$role_id);
        return $this->db->update('role_permissions',$data);
    }

}