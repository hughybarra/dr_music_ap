<?php

class Paginator_Model{

    private $ipp;
    private $num_pages;

    public function __construct(){

        $this->ipp = 10;
        // make a new patient model
        $patient_model = new patient_model();

        // grab the number of rows int he databsae assign it to var
        $num_items = $patient_model->count_all_patients();
        // determin number of pages round to highest number
        $this->num_pages= ceil($num_items / $this->ipp);

    }

    public function get_patients($set_var = 1){



        $range_two = $this->ipp;
        $range_one = $set_var * $this->ipp - $this->ipp;


        if ($range_one < 0){
            $range_one = 0;
        }
        if($range_two <= 0){
            $range_two = $this->ipp;
        }

        $patient_model = new patient_model();

        return $patient_model->get_patient_range($range_one, $range_two);

    }

    public function next(){

        $_SESSION['set_var']  += 1;

        // chceck to see if set_var is getting too big. Rest it io the number of pages
        if ($_SESSION['set_var'] > $this->num_pages){
            $_SESSION['set_var'] = $this->num_pages;
        }


        return $this->get_patients($_SESSION['set_var']);
    }

    public function back(){

        $_SESSION['set_var'] -= 1;

        // chceck to see if set_var is getting too big. Rest it io the number of pages
        if ($_SESSION['set_var'] < 0 ){
            $_SESSION['set_var'] = 0;
        }


        return $this->get_patients($_SESSION['set_var']);
    }


    public function get_current_pagination(){

    }
}
