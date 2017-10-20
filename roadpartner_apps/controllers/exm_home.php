<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Exm_home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('front/home');
        $this->load->model('front/homes');
    }

    public function index()
    {
        if($this->home->validateForm()){
            $dt = new DateTime($this->input->post('date',true));
            $time =$dt->format('H:i');
            $data = array(
                'vehicletype'   => $this->input->post('optradio',true),
                'vehiclename'   => $this->input->post('car',true),
                'pickup'        => $this->input->post('pickup',true),
                'drop_city'     => $this->input->post('drop',true),
                'date'          => $this->input->post('date',true),
                'time'          => $time,
                'name'          => $this->input->post('name',true),
                'cell'          => $this->input->post('cell',true),
                'distance'      => $this->input->post('distance',true),
                'cost'          => $this->input->post('cost',true),
                'timer'         => $this->input->post('timer',true),
                'expire'        => 0,
                'journy'        => $this->input->post('journey',true)
            );
            $id = $this->homes->insert_service($data);
            $this->session->set_userdata(array('message'=>"You service added successfully. You will shortly contacted by the driver "));
            $this->session->unset_userdata(array('form_submit_session' => ""));
            $view_array = array(
                'Bid #'         => $id,
                'Name'          => $this->input->post('name',true),
                'Cell no.'      => $this->input->post('cell',true),
                'Pickup'        => $this->input->post('pickup',true),
                'Drop'          => $this->input->post('drop',true),
                'Car type'      => $this->input->post('optradio',true),
                'Car name'      => $this->input->post('car',true),
                'Date'          => $this->input->post('date',true),
                'Time'          => $time,
                'Total KM'      => $this->input->post('distance',true),
                'Cost'          => $this->input->post('cost',true),
                'Timer'         => $this->input->post('timer',true),
                'Journey'       => $this->input->post('journey',true),
            );
            $this->session->set_userdata('form_submit_session', $view_array);
            redirect(base_url('home/bid_submit_successfully'));
        } else {
            $content = $this->home->bidding_form();
            $this->template->home($content);
        }
    }

    public function bid_submit_successfully()
    {
        $bid_submit_array = $this->session->userdata('form_submit_session');
        if (empty($bid_submit_array)){
            redirect(base_url());
        }
        $content = $this->home->bidding_submit_data($bid_submit_array);
        $this->session->unset_userdata(array('form_submit_session' => ""));
        $this->template->home($content);
    }

    public function price()
    {
        $data_back = json_decode(file_get_contents('php://input'));
        $distance = ceil($data_back->dis);
        $discount = 0;
        $perkmtotal = 0;
        $total = 0;
        $journey = $data_back->journey;
        //echo $dis;
        if (isset($data_back->vid) && !empty($distance)) {

            // $sqlcheck = "SELECT * FROM `images` WHERE `name` = '$data_back->vid'";
            //  $resultCars = $conn->query($sqlcheck);
            $results = $this->homes->get_images($data_back->vid);

            if (!empty($results)) {
                // output data of each row
                // $rowCars = $resultCars->fetch_assoc();
                $rate = json_decode($results[0]['rate']);

                $firstprice = $rate->first->price;
                if ($distance <= $rate->first->km) {
                    $total = $firstprice;
                } else {
                    $distance -= $rate->first->km;
                    $perkmtotal = $distance * $rate->perkm->price;
                    foreach ($rate->discount as $km => $discountPercent) {
                        if (empty($km)) {
                            break;
                        }

                        if ($distance <= $km) {
                            $discount = ($firstprice + $perkmtotal) * $discountPercent;
                            break;
                        }
                        if ($km == '201') {
                            $discount = ($firstprice + $perkmtotal) * $discountPercent;
                            break;
                        }
                    }

                    if ($journey == '2') {
                        if ($distance >= 250) {

                            $vtype = array("cargo_van", "mazda", "ravi_pickup", "shazore");
                            if (in_array($data_back->vid, $vtype)) {
                                $discount = ($firstprice + $perkmtotal) * .35;
                            } else {
                                $discount = ($firstprice + $perkmtotal) * .4;
                            }
                        }
                    }
                }
                $total = $firstprice + $perkmtotal - $discount;
            }
            $response['total'] = intval($total);
            die(json_encode($response));
        }
    }
}