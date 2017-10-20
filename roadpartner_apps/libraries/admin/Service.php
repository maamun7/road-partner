<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Service {
	var $error = array();
	public function get_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/services');		
		$all_service = $CI->services->get_list($limit,$page);
		if(!empty($all_service)){
			$i = $page;
			foreach($all_service as $k=>$val){
				$i++;
				$all_service[$k]['sl']= $i;
                if ($val['expire'] == 1) {
                    $all_service[$k]['status'] = "Yes";
                } else {
                    $all_service[$k]['status'] = "No";
                }
			}
		}
		$data = array(
			'title' => 'Service List',
			'user_lists' => $all_service,
			'links' => $links,
			'search_action' => base_url()."admin/service/search",
		);
		$list_view =  $CI->parser->parse('admin/service/index',$data,true);
		return $list_view;
	}
	
	public function get_search_view($key_word)
	{
		$CI =& get_instance();
		$CI->load->model('admin/services');
		$search_service = $CI->services->get_search_items($key_word);
		$i=0;
		if(!empty($search_service)){
			$i = 0;
			foreach($search_service as $k=>$val){
				$i++;
				$search_service[$k]['sl']= $i;
				$search_service[$k]['last_login_at']= date_am_pm_format($val['last_login']);
				$search_service[$k]['registered_at']= date_am_pm_format($val['created_at']);
                $search_service[$k]['class_in_en']= get_class_in_english($val['class']);
			}
		}

        $data = array(
			'title' => 'Result | Search by keyword',
			'user_lists' => $search_service,
            'key_word' => $key_word,
            'search_date_action' => base_url()."admin/service/search_by_date",
			'search_action' => base_url()."admin/service/search",
		);
		$list_view =  $CI->parser->parse('admin/service/search',$data,true);
		return $list_view;
	}

}
