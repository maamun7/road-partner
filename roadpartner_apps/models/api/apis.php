<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class apis extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function cnic_existency_check($mCnic)
    {
        $this->db->select('cnic');
        $this->db->from('users');
        $this->db->where('cnic',$mCnic);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function insert_user_data($user_data)
    {
        $this->db->insert('users',$user_data);
        return $this->db->insert_id();
    }

    public function get_vehicle_type()
    {
        $this->db->select('type');
        $this->db->from('images');
        $this->db->group_by("type");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function get_type_wise_item($type)
    {
        $where=array('type' => $type);
        $this->db->select('name,image');
        $this->db->from('images');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    function check_valid_user($mobile_no)
    {
        $this->db->where(array('mobile_number'=>$mobile_no,'can_login'=>'1','status'=>'1'));
        $query = $this->db->get('app_users');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function get_user_status($where)
    {
        $select = "status AS UserStatus";
        $this->db->select($select);
        $this->db->from('users');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function get_service($where, $like)
    {
        $select = "vehicletype AS vehicleType,
            vehiclename AS typeOfCar,
            name AS bidderName,
            cell AS cellNo,
            time AS mTime,
            distance AS km,
            cost AS cashFromCustomer,
            drop_city AS dropAddress,
            id AS oderNo,
            cost AS offerPrice,
                journy AS journy,
            pickup AS pickUpAddress,
            date AS pickUpdate,
            (timer*60000) AS millisInFuture,
            UNIX_TIMESTAMP(`current_time`) AS serviveStartTime,
            UNIX_TIMESTAMP(CURRENT_TIMESTAMP) AS serviceCurrentTime";
        $this->db->select($select);
        $this->db->from('services');
        $this->db->where($where);
        $this->db->like($like);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function check_bid_logs($where)
    {
        $select = "*";
        $this->db->select($select);
        $this->db->from('bidlogs');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function check_bid_expired_status($order_no)
    {
        $where = [
            'expire' => 1,
            'order_no' => $order_no
        ];
        $this->db->select("*");
        $this->db->from('services');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function insert_bid_rate($data)
    {
        $this->db->insert('bidlogs',$data);
        return $this->db->insert_id();
    }

    public function bid_winner_check($where)
    {
        $select = "*";
        $this->db->select($select);
        $this->db->from('bidwins');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function bid_confirm_update($data, $where)
    {
        $this->db->where($where);
        $this->db->update('bidwins',$data);
        if ($this->db->_error_message()) {
            return false;
        } else {
            return true;
        }
    }

    public function get_bid_winner_info($order_no)
    {
        $where = [
            'a.order_no' => $order_no
        ];
        $select = "a.bid_rate,a.cnic,b.name,b.mobile,b.city,b.address,b.mTypeOfCar,b.mTypeOfVehicle";
        $this->db->select($select);
        $this->db->from('bidwins a');
        $this->db->join('users b','b.cnic = a.cnic');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }
}
