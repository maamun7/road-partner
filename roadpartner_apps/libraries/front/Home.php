<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home {
    var $error = array();
	public function get_home_view()
	{
		$CI =& get_instance();
        $data = array(
			'title' => 'Welcome road partner',
		);
		$view =  $CI->parser->parse('front/home',$data,true);
        return $view;
	}

    public function bidding_form()
    {
        $CI =& get_instance();
        $this->data['error_warning'] = "";

        if (isset($this->error['error_optradio'])) {
            $this->data['error_optradio'] = $this->error['error_optradio'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_optradio'] = '';
        }

        if (isset($this->error['error_car'])) {
            $this->data['error_car'] = $this->error['error_car'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_car'] = '';
        }

        if (isset($this->error['error_journey'])) {
            $this->data['error_journey'] = $this->error['error_journey'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_journey'] = '';
        }

        if (isset($this->error['error_pickup'])) {
            $this->data['error_pickup'] = $this->error['error_pickup'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_pickup'] = '';
        }

        if (isset($this->error['error_drop'])) {
            $this->data['error_drop'] = $this->error['error_drop'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_drop'] = '';
        }

        if (isset($this->error['error_date'])) {
            $this->data['error_date'] = $this->error['error_date'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_date'] = '';
        }

        if (isset($this->error['error_name'])) {
            $this->data['error_name'] = $this->error['error_name'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_name'] = '';
        }

        if (isset($this->error['error_cell'])) {
            $this->data['error_cell'] = $this->error['error_cell'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_cell'] = '';
        }

        if (isset($this->error['error_timer'])) {
            $this->data['error_timer'] = $this->error['error_timer'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_timer'] = '';
        }

        if (isset($this->error['error_distance'])) {
            $this->data['error_distance'] = $this->error['error_distance'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_distance'] = '';
        }

        if (isset($this->error['error_cost'])) {
            $this->data['error_cost'] = $this->error['error_cost'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_cost'] = '';
        }
            /*kaflksmdf*/
        if(isset($_POST['optradio'])){
            $this->data['optradio_value'] = $CI->input->post('optradio');
        }

        if(isset($_POST['car'])){
            $this->data['car_value'] = $CI->input->post('car');
        }

        if(isset($_POST['journey'])){
            $this->data['journey_value'] = $CI->input->post('journey');
        }

        if(isset($_POST['pickup'])){
            $this->data['pickup_value'] = $CI->input->post('pickup');
        }

        if(isset($_POST['drop'])){
            $this->data['drop_value'] = $CI->input->post('drop');
        }

        if(isset($_POST['date'])){
            $this->data['date_value'] = $CI->input->post('date');
        }

        if(isset($_POST['name'])){
            $this->data['name_value'] = $CI->input->post('name');
        }

        if(isset($_POST['cell'])){
            $this->data['cell_value'] = $CI->input->post('cell');
        }

        if(isset($_POST['timer'])){
            $this->data['timer_value'] = $CI->input->post('timer');
        }

        if(isset($_POST['distance'])){
            $this->data['distance_value'] = $CI->input->post('distance');
        }

        if(isset($_POST['cost'])){
            $this->data['cost_value'] = $CI->input->post('cost');
        }

        $this->data['title'] = 'Start new bidding';
        $this->data['action'] = base_url('home/index');

        $html_view = $CI->parser->parse('front/home',$this->data,true);
        return $html_view;
    }

    public function validateForm()
    {
        $CI =& get_instance();

        if(isset($_POST['optradio'])){
            if(strlen($CI->input->post('optradio')) < 1){
                $this->error['error_optradio']="Vehicle type is required";
            }
        } else {
            $this->error['error_optradio']="";
        }

        if(isset($_POST['car'])){
            if(strlen($CI->input->post('car')) < 1){
                $this->error['error_car']="Car type is required";
            }
        } else {
            $this->error['error_car']="";
        }

        if(isset($_POST['journey'])){
            if(strlen($CI->input->post('journey')) < 1){
                $this->error['error_journey']="Journey field is required";
            }
        } else {
            $this->error['error_journey']="";
        }

        if(isset($_POST['pickup'])){
            if(strlen($CI->input->post('pickup')) < 1){
                $this->error['error_pickup']="Pickup field is required";
            }
        } else {
            $this->error['error_pickup']="";
        }

        if(isset($_POST['drop'])){
            if(strlen($CI->input->post('drop')) < 1){
                $this->error['error_drop']="Drop field is required";
            }
        } else {
            $this->error['error_drop']="";
        }

        if(isset($_POST['date'])){
            if(strlen($CI->input->post('date')) < 1){
                $this->error['error_date']="Date field is required";
            }
        } else {
            $this->error['error_date']="";
        }

        if(isset($_POST['name'])){
            if(strlen($CI->input->post('name')) < 1){
                $this->error['error_name']="Name field is required";
            }
        } else {
            $this->error['error_name']="";
        }

        if(isset($_POST['cell'])){
            if(strlen($CI->input->post('cell')) < 1){
                $this->error['error_cell']="Cell no. field is required";
            }
        } else {
            $this->error['error_cell']="";
        }

        if(isset($_POST['timer'])){
            if(strlen($CI->input->post('timer')) < 1){
                $this->error['error_timer']="Timer field is required";
            }
        } else {
            $this->error['error_timer']="";
        }

        if(isset($_POST['distance'])){
            if(strlen($CI->input->post('distance')) < 1){
                $this->error['error_distance']="KM field is required";
            }
        } else {
            $this->error['error_distance']="";
        }

        if(isset($_POST['cost'])){
            if(strlen($CI->input->post('cost')) < 1){
                $this->error['error_cost']="Cost field is required";
            }
        } else {
            $this->error['error_cost']="";
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }


    public function bidding_submit_data($data)
    {
        $CI =& get_instance();
        $this->data['title'] = 'Road partner | Bid submit';
        $this->data['rows'] = $data;
        $html_view = $CI->parser->parse('front/bid_submit',$this->data,true);
        return $html_view;
    }
}
