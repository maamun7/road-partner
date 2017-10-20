<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class crons extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function get_running_all_services()
    {
        $where=array('expire' => 0);
        $this->db->select('id,timer,current_time, NOW() as now_time');
        $this->db->from('services');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function do_expire_service($id)
    {
        $where = array('id' => $id);
        $this->db->where($where);
        $this->db->update('services',['expire' => 1]);
        if ($this->db->_error_message()) {
            return false;
        } else {
            return true;
        }
    }

    public function make_bid_winner($order_no)
    {
        $sql = "SELECT b.cnic,min(b.bid_rate) AS win_amount"
            ." FROM bidlogs AS b"
            ." WHERE bid_rate = (SELECT min(b.bid_rate) FROM bidlogs) AND order_no ={$order_no}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $bid_winner = [
                'cnic' => $result[0]['cnic'],
                'bid_rate' => $result[0]['win_amount'],
                'order_no' => $order_no
            ];
            $insert_status = $this->insert_bid_winner($bid_winner);
            return $insert_status;
        }else{
            return false;
        }
    }

    private function insert_bid_winner($data)
    {
        $this->db->insert('bidwins',$data);
        $id = $this->db->insert_id();
        if ($id > 0) {
            return true;
        }else{
            return false;
        }
    }
}
