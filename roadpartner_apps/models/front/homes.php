<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Homes extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_images($vid)
    {
        $where=array('name' => $vid);
        $this->db->select('*');
        $this->db->from('images');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
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

    public function insert_service($data)
    {
        $this->db->insert('services',$data);
        return $this->db->insert_id();
    }
}