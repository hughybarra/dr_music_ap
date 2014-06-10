<?php

class Paginator_Model{

    private $ipp;
    private $num_pages;

    public function __construct(){
        // setting items to view per page
        $this->ipp = 10;
        // make a new patient model
        $patient_model = new patient_model();

        // grab the number of rows int he databsae assign it to var
        $num_items = $patient_model->count_all_patients();
        // determin number of pages round to highest number
        $this->num_pages= ceil($num_items / $this->ipp);

    }

    /*
    * get _patients function grabs the current range set of patients and tells the range finder what range of patients to use
    */
    public function get_patients($set_var = 1){
        // range vars set the range of items to view from
        // here i'm setting the range vars dynamically so this pagination could work with any size databas
        $range_two = $this->ipp;
        $range_one = $set_var * $this->ipp - $this->ipp;

        // reset the range if range passes number of entries in database.
        // also setting range to zero if it drops under zero entries
        if ($range_one < 0){
            $range_one = 0;
        }
        if($range_two <= 0){
            $range_two = $this->ipp;
        }

        $patient_model = new patient_model();
        // passing in the range to the rangefinder
        return $patient_model->get_patient_range($range_one, $range_two);
    }

    /*
    * next function paginates us next passing the range finder the next set of variables to load
    */
    public function next(){
        // setting session var here to control range controller or else php will forget what iteration we're on
        $_SESSION['set_var']  += 1;

        // chceck to see if set_var is getting too big. Rest it io the number of pages
        if ($_SESSION['set_var'] > $this->num_pages){
            $_SESSION['set_var'] = $this->num_pages;
        }

        return $this->get_patients($_SESSION['set_var']);
    }

    /*
    * back function paginates us back passing the range finder the next set of variables to load
    */
    public function back(){
         // chceck to see if set_var is getting too big. Rest it io the number of pages
        $_SESSION['set_var'] -= 1;

        // chceck to see if set_var is getting too big. Rest it io the number of pages
        if ($_SESSION['set_var'] < 0 ){
            $_SESSION['set_var'] = 0;
        }

        return $this->get_patients($_SESSION['set_var']);
    }
}
