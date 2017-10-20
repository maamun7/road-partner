<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bid_win {
	var $error = array();
	public function get_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/bid_wins');		
		$all_bid_win = $CI->bid_wins->get_list($limit,$page);
		if(!empty($all_bid_win)){
			$i = $page;
			foreach($all_bid_win as $k=>$val){
				$i++;
				$all_bid_win[$k]['sl']= $i;
                if ($val['confirm'] == 1) {
                    $all_bid_win[$k]['status'] = "Yes";
                } else {
                    $all_bid_win[$k]['status'] = "No";
                }
			}
		}
		$data = array(
			'title' => 'Bid winner List',
			'user_lists' => $all_bid_win,
			'links' => $links,
			'search_action' => base_url()."admin/bid_win/search",
		);
		$list_view =  $CI->parser->parse('admin/bid_win/index',$data,true);
		return $list_view;
	}
	
	public function get_search_view($key_word)
	{
		$CI =& get_instance();
		$CI->load->model('admin/bid_wins');
		$search_bid_win = $CI->bid_wins->get_search_items($key_word);
		$i=0;
		if(!empty($search_bid_win)){
			$i = 0;
			foreach($search_bid_win as $k=>$val){
				$i++;
				$search_bid_win[$k]['sl']= $i;
				$search_bid_win[$k]['last_login_at']= date_am_pm_format($val['last_login']);
				$search_bid_win[$k]['registered_at']= date_am_pm_format($val['created_at']);
                $search_bid_win[$k]['class_in_en']= get_class_in_english($val['class']);
			}
		}

        $data = array(
			'title' => 'Result | Search by keyword',
			'user_lists' => $search_bid_win,
            'key_word' => $key_word,
            'search_date_action' => base_url()."admin/bid_win/search_by_date",
			'search_action' => base_url()."admin/bid_win/search",
		);
		$list_view =  $CI->parser->parse('admin/bid_win/search',$data,true);
		return $list_view;
	}

}
