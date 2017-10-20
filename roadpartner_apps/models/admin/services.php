<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class services extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function total_service()
	{
        $select = "a.*";
        $this->db->select($select);
        $this->db->from('services a');
        $query = $this->db->get();
		return $query->num_rows();
	}	

    public function get_list($limit, $page)
    {
        $select = "a.*,COUNT(DISTINCT b.cnic) as total_bid";
        $this->db->select($select);
        $this->db->from('services a');
        $this->db->join('bidlogs b','b.order_no = a.id','left');
        $this->db->limit($limit, $page);
        $this->db->order_by('a.id','desc');
        $this->db->group_by('a.id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }
}