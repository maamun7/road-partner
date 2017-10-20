<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vent_api extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('api/apis');
    }

    public function register()
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        $register_status = array();
        $requests = json_decode(file_get_contents('php://input'),true);
        $ar = array('mUserName', 'mMobileNumber', 'mCity', 'mCnic', 'mAddress', 'mTypeOfCar', 'mTypeOfVehicle');
        $flag = true;
        foreach($ar as $v){
            if(!isset($requests[$v]) || $requests[$v] == ""){
                $flag=false;
            }
        }
        if ($flag) {
            if ($this->apis->cnic_existency_check($requests['mCnic']) === FALSE) {
                $user_data = array(
                    'name' => $requests['mUserName'],
                    'mobile' => $requests['mMobileNumber'],
                    'city' => $requests['mCity'],
                    'cnic' => $requests['mCnic'],
                    'address' => $requests['mAddress'],
                    'mTypeOfCar' => $requests['mTypeOfCar'],
                    'mTypeOfVehicle' => $requests['mTypeOfVehicle']
                );
                $user_id = $this->apis->insert_user_data($user_data);
                if ($user_id > 0) {
                    $register_status['registationResponse'] = "1";
                    $register_status['message'] = "registration successful";
                    echo json_encode($register_status);
                    exit;
                } else {
                    $register_status['registationResponse'] = "2";
                    $register_status['message'] = "Others error";
                    echo json_encode($register_status);
                    exit;
                }
            } else {
                $register_status['registationResponse'] = "3";
                $register_status['message'] = "User already exist with same cnic";
                echo json_encode($register_status);
                exit;
            }
        }
        $register_status['registationResponse'] = "2";
        $register_status['message'] = "Missing field";
        echo json_encode($register_status);
        exit;
    }

    public function display_file()
    {
        header("Content-Type: application/json; charset=UTF-8");
        $final1 = array();
        $cc = array();
        //$vehicleTypeSql="SELECT TYPE FROM `images` GROUP BY TYPE ";
        $vehicleTypeResult = $this->apis->get_vehicle_type();
        $type['mTypeOfVehicle'][] = array();
        if (count($vehicleTypeResult) > 0) {
            // while($value=$vehicleTypeResult->fetch_assoc()){
            foreach ($vehicleTypeResult as $key => $value) {

                $s = $value['type'];
                // $itemSql="SELECT name , image FROM `images` WHERE TYPE = '$s'";
                // $iteamResult=$conn->query($itemSql);
                $iteamResult = $this->apis->get_type_wise_item($s);
                //while($item=$iteamResult->fetch_assoc()){
                if (count($iteamResult) > 0) {
                    foreach ($iteamResult as $ke => $item) {
                        $data['mName'] = $item['name'];
                        $data['mUrl'] = $item['image'];
                        $ar_data[] = $data;
                    }

                    $e = new MyType($ar_data);
                    unset($ar_data);
                    $e->mTypeOfVehicle = $s;
                    array_push($cc, $e);
                }
            }
        } else {

        }
        echo json_encode($cc);
    }

    public function service()
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        //$service_status = array();
        $requests = json_decode(file_get_contents('php://input'),true);
        $ar = array('mTypeOfVehicle', 'mTypeOfCar', 'orderNo', 'mCity', 'mCnic');
        $flag=true;
        foreach($ar as $value){
            if(!isset($requests[$value]) || $requests[$value] == ""){
                $flag=false;
            }
        }
        if ($flag) {
            $vehicle_type = $requests['mTypeOfVehicle'];
            $vehicle_name = $requests['mTypeOfCar'];
            $order_no = $requests['orderNo'];
            $city = $requests['mCity'];
            $c_nic = $requests['mCnic'];
            $final_array = [];
            //Get user data
            $user_where_cond = [
                'cnic' => $c_nic,
                'mTypeOfVehicle' => $vehicle_type,
                'mTypeOfCar' => $vehicle_name,
            ];
            $user_result = $this->apis->get_user_status($user_where_cond);
            if (empty($user_result)) {
                $responses = array('bidResponse'=>2, 'message'=>'user data not found');
                echo json_encode($responses);
                exit;
            }
            //User data found that's why make user array
            $user_array = [
                'UserStatus' => $user_result[0]['UserStatus']
            ];
            if ($order_no == "all") {
                $service_where_cond = [
                    'expire' => 0,
                    'vehicletype' => $vehicle_type,
                    'vehiclename' => $vehicle_name,
                ];
                $like_condition = [
                    'pickup' => $city
                ];
                $service_result = $this->apis->get_service($service_where_cond, $like_condition);
                if (!empty($service_result)) {
                    foreach ($service_result as $v) {
                        if ($v['journy'] == "1") {
                            $v['journy'] = "one way";
                        } else {
                            $v['journy'] = "two way";
                        }
                        $final_array[] = array_merge($v, $user_array);
                    }
                    echo json_encode($final_array);
                    unset($final_array);
                    exit;
                } else {
                    $responses = array('bidResponse'=>2, 'message'=>'no available bids');
                    echo json_encode($responses);exit;
                }
            } elseif (preg_match("/^[0-9]+$/",$order_no)) {
                $service_where_cond = [
                    'expire' => 0,
                    'vehicletype' => $vehicle_type,
                    'vehiclename' => $vehicle_name,
                    'id >' => $order_no,
                ];
                $like_condition = [
                    'pickup' => $city
                ];
                $service_result = $this->apis->get_service($service_where_cond, $like_condition);
                if (!empty($service_result)) {
                    foreach ($service_result as $val) {
                        if ($val['journy'] == "1") {
                            $val['journy'] = "one way";
                        } else {
                            $val['journy'] = "two way";
                        }
                        $final_array[] = array_merge($val, $user_array);
                    }
                    echo json_encode($final_array);
                    unset($final_array);
                    exit;
                } else {
                    $responses = array('bidResponse'=>2, 'message'=>'no available services');
                    echo json_encode($responses);exit;
                }
            }
        }
        $responses = array('bidResponse'=>2, 'message'=>'Missing field');
        echo json_encode($responses);
        exit;
    }

    public function bid_placed()
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        //$service_status = array();
        $requests = json_decode(file_get_contents('php://input'),true);
        $ar = array('mCnic','bidData');
        $flag = true;
        foreach($ar as $v){
            if(!isset($requests[$v]) || $requests[$v] == ""){
                $flag = false;
            }
        }
        if ($flag) {
            if (!isset($requests['bidData']['orderNo']) || empty($requests['bidData']['orderNo']) || !isset($requests['bidData']['yourBidRate']) || empty($requests['bidData']['yourBidRate']))  {
                $flag = false;
            }
        }

        if ($flag) {
            $c_nic = $requests['mCnic'];
            $order_no = $requests['bidData']['orderNo'];
            $bid_rate = $requests['bidData']['yourBidRate'];

            $bid_logs_where_cond = [
                'cnic' => $c_nic,
                'order_no' => $order_no
            ];
            $bid_result = $this->apis->check_bid_logs($bid_logs_where_cond);
            if ($bid_result) {
                $responses = array('bidResponse'=>2, 'message'=>'Bid already placed by this user');
                echo json_encode($responses); exit;
            }
            $bid_exp_status = $this->apis->check_bid_expired_status($order_no);
            if ($bid_exp_status) {
                $responses = array('bidResponse'=>2, 'message'=>'Bid already expired');
                echo json_encode($responses); exit;
            }
            $bid_array = [
                'cnic' => $c_nic,
                'bid_rate' => $bid_rate,
                'order_no' => $order_no
            ];
            $bid_id = $this->apis->insert_bid_rate($bid_array);
            if ($bid_id > 0) {
                $responses = array('bidResponse'=>1, 'message'=>'Bid placed successful');
                echo json_encode($responses); exit;
            } else {
                $responses = array('bidResponse'=>2, 'message'=>'Bid placed failed');
                echo json_encode($responses); exit;
            }
        }
        $responses = array('bidResponse'=>2, 'message'=>'Invalid request');
        echo json_encode($responses); exit;
    }

    public function bid_winner()
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        //$service_status = array();
        $requests = json_decode(file_get_contents('php://input'),true);
        $ar = array('bidData');
        $flag = true;
        foreach($ar as $v){
            if(!isset($requests[$v]) || $requests[$v] == ""){
                $flag = false;
            }
        }
        if ($flag) {
            if (!isset($requests['bidData']['orderNo']) || empty($requests['bidData']['orderNo']))  {
                $flag = false;
            }
        }

        if ($flag) {
            $final_array = [];
            $order_no = $requests['bidData']['orderNo'];
            //Get user data
            $bid_winr_info = $this->apis->get_bid_winner_info($order_no);
            if ($bid_winr_info === false) {
                $responses = array('bidResponse'=>2, 'message'=>'Did not found bid by this order no '.$order_no);
                echo json_encode($responses); exit;
            } else {
                foreach ($bid_winr_info as $val) {
                    $final_array = $val;
                }
                echo json_encode($final_array); exit;
            }
        }
        $responses = array('registationResponse'=>2, 'message'=>'Invalid request');
        echo json_encode($responses); exit;
    }

    public function bid_confirm()
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        //$service_status = array();
        $requests = json_decode(file_get_contents('php://input'),true);
        $ar = array('mCnic','bidData');
        $flag = true;
        foreach($ar as $v){
            if(!isset($requests[$v]) || $requests[$v] == ""){
                $flag = false;
            }
        }
        if ($flag) {
            if (!isset($requests['bidData']['orderNo']) || empty($requests['bidData']['orderNo']))  {
                $flag = false;
            }
        }

        if ($flag) {
            $c_nic = $requests['mCnic'];
            $order_no = $requests['bidData']['orderNo'];

            $bid_conf_where_cond = [
                'cnic' => $c_nic,
                'order_no' => $order_no
            ];
            $bid_win_result = $this->apis->bid_winner_check($bid_conf_where_cond);
            if ($bid_win_result) {
                //Update confirm
                $bid_update_status = $this->apis->bid_confirm_update(array('confirm' => 1), $bid_conf_where_cond);
                if ($bid_update_status) {
                    $responses = array('registationResponse'=>1, 'message'=>'Bid successfully confirmed');
                    echo json_encode($responses); exit;
                } else {
                    $responses = array('registationResponse'=>2, 'message'=>'Bid confirm failed');
                    echo json_encode($responses); exit;
                }
            } else {
                $responses = array('bidResponse'=>2, 'message'=>'Bid confirm failed, do not found bid by this cnic and order no.');
                echo json_encode($responses); exit;
            }
        }
        $responses = array('bidResponse'=>2, 'message'=>'Invalid request');
        echo json_encode($responses); exit;
    }
}

class MyType
{
    public $mTypeOfVehicle = "";
    private $vehicles = '';

    public function __construct($vehicle)
    {
        $this->vehicle = $vehicle;
    }
}







