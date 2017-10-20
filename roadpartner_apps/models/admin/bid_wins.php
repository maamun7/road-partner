<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class bid_wins extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function total_bid_win()
	{
        $select = "a.*,b.name,b.mobile,b.city";
        $this->db->select($select);
        $this->db->from('bidwins a');
        $this->db->join('users b','b.cnic = a.cnic','left');
        $query = $this->db->get();
		return $query->num_rows();
	}	

    public function get_list($limit, $page)
    {
        $select = "a.*,b.name,b.mobile,b.city";
        $this->db->select($select);
        $this->db->from('bidwins a');
        $this->db->join('users b','b.cnic = a.cnic','left');
        $this->db->limit($limit, $page);
        $this->db->order_by('a.id','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }
}