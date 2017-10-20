<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class generate_smples extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public $carTypePassenger= "passenger";
    public $carTypeCargo="cargo";
    public $carPassenger=array("apv", "crolla", "cultus","kizashi","mehran", "swift", "vitz", "wagon_r", "bolan");
    public $carCargo=array("cargo_van", "mazda", "ravi_pickup", "shazore");
    public $name=array( "Ali", " Abbas", " Abid", " Abrar", " Adam", " Adeel", " Adil", " Afzal", " Afzaal", " Ahmed",
        " Ahmer", " Ahsan", " Ajmal", " Akbar", " Akhtar", "Akhter", " Akif", " Akram", " Aqeel", " Aqib", " Aleem",
        " Altaf", " Amin", " Amir", " Amjad", " Anwar", " Aon", " Arif", " Arsalan", " Arshad", " Asad", " Asim",
        " Aslam", " Ayaaz", " Ayub", " Azam", " Azeem", " Azhar", " Aziz", "Babar", " Badar", " Bashir", "Danial",
        " Danish", " Dawood", "Ehtisham", "Fahad", " Faisal", " Faiz", " Farid", " Farooq", " Farrukh", " Fawad",
        " Fayaz", " Fazal Ghafoor", " Ghayoor", " Ghous", "Hasan", " Hussain", " Habib", " Hafeez", " Haider",
        " Hamid", " Hameed", " Haroon", " Harris", " Humayun", "Ibrahim", " Idrees", " Iftikhar", " Ijaz", " Ilyas",
        " Imran", " Inzamam", " Iqbal", " Irfan", " Ishaq", " Ismail", "Jabbar", " Jafar", " Jalal", " Jaleel",
        " Jamal", " Jameel", " Junaid", " Javid", " Jawad", "Kabir", " Kaleem", " Karim", "Kareem", " Khalid",
        " Khurshid", " Khushal", "Latif", "Lateef", "Mohammad", " Mohammed", " Mahmood", " Majid", " Maqsood",
        " Masood", " Mehr", " Mohsin", " Mubashar", " Mudassar", " Mujtaba", " Mumtaz", " Munawar", " Murtaza",
        " Musharraf", " Mushtaq", " Mustafa", " Mustansar", " Muzaffar", "Nabeel", " Nadeem", " Naeem", " Nafees",
        " Najib", " Nasir", " Naseer", " Nauman", " Naveed", " Nawaz", "Obaid", " Omar Pervaiz", "Parvez", "Qadir",
        " Qais", " Qaiser", " Qasim", " Quddus", "Raza", " Raees", " Rahim", " Rahman", "Rehman", " Rameez",
        " Rashid", " Rasheed", " Rauf", " Razzak", "Razzaq", " Riaz", " Rizwan", "Saad", " Saadat", " Sabir",
        " Sadaqat", " Sadiq", " Saeed", " Safdar", " Safeer", " Saghar", " Sagheer", " Sahir", " Saif", " Sajid",
        " Sajjad", " Saqib", " Salahuddin", " Salim", " Salman", " Sarfraz", " Sarmad", " Sarwar", " Sattar",
        " Saqlain", " Saud", " Shabbir", " Shafqat", " Shafiq", " Shahbaz", " Shahid", " Shahzad", " Shakeel",
        " Shakir", " Shakoor", " Shamsher", " Shams", " Shan", " Sharjeel", " Shaukat", " Sheharyar", " Sher",
        " Sheraz", " Shoaib", " Shuja", " Shujaat", " Sibtain", " Siddiq", " Sikandar(alexander)", " Sohaib",
        " Sohail", " Sohrab", " Suleman", " Sultan", "Tabraiz", " Taha", " Tahir", " Taimur", " Taj", " Tajammul",
        " Talat", " Tanweer", "Tanvir", " Tariq", " Taufeeq", "Taufiq", " Tauqeer", "Tauqir", " Tauseef", " Tehsin",
        " Tufail", "Umair", " Umar", " Usman", " Uzair", "Vakeel", "Vazir", "Waheed", " Waheed", " Wahid", " Wajid",
        " Wakeel", " Wali", " Waqar", " Wasi", " Wasif", " Wasim", " Wazir", "Yahya", " Yar", " Yasin", " Yasir",
        " Yawar", " Younas", "Younis", " Yousaf", "Yousuf", "Zaeem", " Zafar", " Zaheer", " Zahid", " Zahoor",
        "Zaighum", " Zain", " Zakaria", " Zakir", " Zaman", " Zameer", " Zarar", " Zareef", " Zeeshan", " Zia",
        " Zohaib", " Zohair", " Zubair", " Zulfiqar", "Zulqarnain");

    private function getRandomDistance($location){
        if(count($location > 0)){
            for($i=0;$i<count($location);$i++){
                $sql = "SELECT *  FROM `distances` WHERE `pickup` LIKE '%".$location[$i]."%' ORDER BY RAND() LIMIT 5";
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    $results = $query->result_array();
                    foreach ($results as $result) {
                        $resultArray[] = $result;
                    }
                }
            }
            return $resultArray;
        } else {
            return $resultArray[]=null;
        }
    }

    public function insert_services(){
        $places=array('punjab', 'lahore', 'gujranwala', 'Sheikhupura', 'rawalpindi');
        $distances = $this->getRandomDistance($places);
        if (!empty($distances)) {
            for ($i = 0; $i < count($distances); $i++) {
                for ($j = 0; $j < count($this->carPassenger); $j++) {
                    $sample = '';
                    $sample = $distances[$i]['drop_city'];
                    $distance = $distances[$i]['distance'];
                    $rand_num_arrar = array(5, 10, 15, 20, 25, 30);
                    $random_key = array_rand($rand_num_arrar);
                    $bidAllowedTime = $rand_num_arrar[$random_key];


                    // $bidAllowedTime = rand(15, 50);
                    $insert_service_sql = "INSERT INTO `services` (`id`, `vehicletype`, `vehiclename`, `pickup`, `drop_city`, `date`, `time`,
				`name`, `cell`, `distance`, `cost`, `current_time`, `timer`, `expire`) VALUES
				(NULL, 'passenger', '" . $this->carPassenger[$j] . "', '" . $distances[$i]['pickup'] . "', '$sample', DATE_ADD(CURDATE(),INTERVAL 2 DAY), CURTIME(),
				'" . $this->name[array_rand($this->name)] . "', '0xx-yyyyyyy', '" . $distances[$i]['distance'] . "' , '" . ($distance * 2) . "', NOW(), $bidAllowedTime, 0)";
                    //insert
                    $this->db->query($insert_service_sql);
                    $service_id = $this->db->insert_id();
                    if ($service_id > 0) {
                        $sqlPlaceBid = "INSERT INTO `bidlogs` (`id`, `cnic`, `bid_rate`, `order_no`) VALUES
					(NULL, '8236980527568', 0, $service_id)";
                        //insert
                        $this->db->query($sqlPlaceBid);
                        if ($this->db->_error_message()) {
                            echo "New bid placed successfully";
                        }
                    }else{
                        echo "Error during service insert ";
                    }
                }

                for ($k = 0; $k < count($this->carCargo); $k++) {
                    $rand_num_arrar = array(5, 10, 15, 20, 25, 30);
                    $random_key = array_rand($rand_num_arrar);
                    $bidAllowedTime = $rand_num_arrar[$random_key];

                    $sql1 = "INSERT INTO `services` (`id`, `vehicletype`, `vehiclename`, `pickup`, `drop_city`, `date`, `time`,
					`name`, `cell`, `distance`, `cost`, `current_time`, `timer`, `expire`) VALUES
					(NULL, 'cargo', '" . $this->carCargo[$k] . "', '" . $distances[$i]['pickup'] . "', '$sample', DATE_ADD(CURDATE(),INTERVAL 2 DAY), CURTIME(),
					'" . $this->name[array_rand($this->name)] . "', '0xx-yyyyyyy', '" . $distances[$i]['distance'] . "', '" . ($distance * 2) . "', NOW(), $bidAllowedTime, 0)";

                    $this->db->query($sql1);
                    $service_id2 = $this->db->insert_id();
                    if ($service_id2 > 0) {
                        echo "New record created successfully";
                        $sqlPlaceBid2 = "INSERT INTO `bidlogs` (`id`, `cnic`, `bid_rate`, `order_no`) VALUES
						(NULL, '8236980527568', 0, $service_id2)";
                        $this->db->query($sqlPlaceBid2);
                        if ($this->db->_error_message()) {
                            echo "New bid placed successfully";
                        }
                    } else {
                        echo "Error during service insert";
                    }
                }
            }
        } else {
            echo "There is no entry to insert into services";
        }
    }
}
