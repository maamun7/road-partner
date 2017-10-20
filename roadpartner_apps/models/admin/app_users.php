<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class app_users extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function total_app_user()
	{
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function get_list($limit,$page)
	{
        $this->db->select('a.*');
        $this->db->from('users a');
        $this->db->limit($limit, $page);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
	}
	
	public function get_search_items($key_word)
	{
        $this->db->select('a.*,COUNT(DISTINCT b.id) as total_study');
        $this->db->from('app_users a');
        $this->db->join('user_history b','b.mobile_number = a.mobile_number','left');
        if (is_numeric($key_word)) {
            $this->db->like('a.mobile_number',$key_word);
        } else {
            $this->db->like('a.user_name',$key_word);
        }
        $this->db->order_by('total_study','desc');
        $this->db->order_by('a.id', 'desc');
        $this->db->group_by('a.mobile_number');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
	}
    public function do_change_status($user_id)
    {
        $this->db->select('status');
        $this->db->from('users');
        $this->db->where(array('id'=>$user_id,'status'=>'true'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->where('id',$user_id);
            $this->db->update('users',array('status'=>'false'));
            return true;
        }
        $this->db->where('id',$user_id);
        $this->db->update('users',array('status'=>'true'));
        return true;
    }
}