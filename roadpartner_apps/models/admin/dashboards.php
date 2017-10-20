<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class dashboards extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_total_user()
	{
		/*$this->db->select('id');
		$this->db->from('app_users');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {	
			return $query->num_rows();
		}else{
			return 0;
		}*/
	}
}
