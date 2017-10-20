<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Roadp_cron extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('api/crons');
		$this->load->model('api/generate_smples');
    }

    public function change_service_status()
    {
        $services = $this->crons->get_running_all_services();
        if (!empty($services)) {
            foreach ($services as $service) {
                $start_time = $service['current_time'];
                /*
                $service_time = $service['timer'];
                //get second form starting time
                $get_seconds = date('s',strtotime($start_time));
                if (30 < $get_seconds) {
                    $service_time +=1;
                }
                $duration = "+".$service_time." minutes";
                */
                $duration = "+".$service['timer']." minutes";
                $expire_time = date('Y-m-d H:i:s',strtotime($duration,strtotime($start_time)));
                $current_time = $service['now_time'];
                $total_expire = 0;
                if ($expire_time <= $current_time) {
                    //Set expire on this order
                    $this->crons->do_expire_service($service['id']);
                    //Make winner for this order
                    $status = $this->crons->make_bid_winner($service['id']);
                    if ($status) {
                        $total_expire++;
                    }
                }
                echo "Total ( ".$total_expire." ) service expired now";
            }
        } else {
            echo "Didn't found any running service";
        }

    }


    public function generate_samples()
    {
        ini_set('max_execution_time', 3000);
        $this->generate_smples->insert_services();
    }

}







