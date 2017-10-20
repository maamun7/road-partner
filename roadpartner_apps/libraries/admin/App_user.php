<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class App_user {
	var $error = array();
	public function get_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/app_users');		
		$all_app_user = $CI->app_users->get_list($limit,$page);
		if(!empty($all_app_user)){
			$i = $page;
			foreach($all_app_user as $k=>$val){
				$i++;
				$all_app_user[$k]['sl']= $i;
                if($val['status']=='true'){
                    $all_app_user[$k]['sts_class']="fa-check-square-o text-success";
                }else{
                    $all_app_user[$k]['sts_class']="fa-times-circle-o text-danger";
                }
			}
		}
		$data = array(
			'title' => 'App User List',
			'user_lists' => $all_app_user,
			'links' => $links,
			'search_action' => base_url()."admin/app_user/search",
		);
		$list_view =  $CI->parser->parse('admin/app_user/index',$data,true);
		return $list_view;
	}
	
	public function get_search_view($key_word)
	{
		$CI =& get_instance();
		$CI->load->model('admin/app_users');
		$search_app_user = $CI->app_users->get_search_items($key_word);
		$i=0;
		if(!empty($search_app_user)){
			$i = 0;
			foreach($search_app_user as $k=>$val){
				$i++;
				$search_app_user[$k]['sl']= $i;
				$search_app_user[$k]['last_login_at']= date_am_pm_format($val['last_login']);
				$search_app_user[$k]['registered_at']= date_am_pm_format($val['created_at']);
                $search_app_user[$k]['class_in_en']= get_class_in_english($val['class']);
			}
		}

        $data = array(
			'title' => 'Result | Search by keyword',
			'user_lists' => $search_app_user,
            'key_word' => $key_word,
            'search_date_action' => base_url()."admin/app_user/search_by_date",
			'search_action' => base_url()."admin/app_user/search",
		);
		$list_view =  $CI->parser->parse('admin/app_user/search',$data,true);
		return $list_view;
	}

	public function get_details_view($mobile_no)
	{
		$CI =& get_instance();
		$CI->load->model('admin/app_users');
		$user_details = $CI->app_users->get_user_details($mobile_no);

        $data = [];
        if (!empty($user_details)) {
            $data['user_name'] = $user_details[0]['user_name'];
            $data['class'] = $user_details[0]['class']."/".get_class_in_english($user_details[0]['class']);
            $data['mobile'] = $user_details[0]['mobile_number'];
            $data['registration'] = date_am_pm_format($user_details[0]['created_at']);
            $data['last_study'] = date_am_pm_format($user_details[0]['last_read']);
            $data['last_login'] = date_am_pm_format($user_details[0]['last_login']);
        }
        $user_history = $CI->app_users->get_user_history_details($mobile_no);
        $total_study = 0;
        if(!empty($user_history)){
            $i = 0;
            foreach($user_history as $k=>$val){
                $i++;
                $user_history[$k]['sl']= $i;
                $user_history[$k]['history_time']= date("d/m/Y H:i:s", ($val['date']/ 1000));
                $user_history[$k]['stay_time']= $this->duration_calculator(date("Y/m/d H:i:s", ($val['end_time']/ 1000)),date("Y/m/d H:i:s", ($val['date']/ 1000)));

                if ($val['history_deck_length'] == ($val['history_correct_cnt'] + $val['history_incorrect_cnt'])) {
                    $user_history[$k]['reading_status'] = "<span style='color: #008000'> Complete </span>";
                } else {
                    $user_history[$k]['reading_status'] = "<span style='color: red'> Incomplete </span>";
                }
                $total_study += 1;
            }
        }
        $data['title'] = "User details";
        $data['user_history'] = $user_history;
        $data['total_study'] = $total_study;
        $data['back_link'] =  base_url()."admin/app_user";
        $list_view =  $CI->parser->parse('admin/app_user/details',$data,true);
		return $list_view;
	}

    public function duration_calculator($end_time,$start_time) {
        $date_a = new DateTime($end_time);
        $date_b = new DateTime($start_time);
        $interval = date_diff($date_a,$date_b);

        return $interval->format('%h:%i:%s');
    }

}
