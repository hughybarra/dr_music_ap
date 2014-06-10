<?php

include 'my_model.php';

class patient_model extends my_model
{

    public function __construct()
    {

        // constructing the parent gives us
        // access to the db through $this->db
        // which is a native php mysqli interface
        parent::__construct();
    }

    public function list_all()
    {
        $sql = $this->db->prepare('select * from patients');

        // expects that sql is a pdo prepared stmt
        $sql->execute();

        // http://php.net/manual/en/pdostatement.fetchall.php
        return $sql->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Gets a Patient's data joined with their favorite song
     *
     * @author Daniel Walker <daniel.walker@assistrx.com>
     * @since  5/15/13
     * @param  int $patient_id
     * @return stdClass the joined sql records
     */
    public function get_by_id($patient_id = NULL)
    {
        $sql = $this->db->prepare("
            SELECT *
            FROM patients
            LEFT JOIN songs
                ON patients.favorite_song_id = songs.song_id
            WHERE  patient_id = ?
        ");

        // execute with the patiend id (goes where the ? is in the query above)
        $sql->execute(array($patient_id));

        return $sql->fetchObject();
    }

    /**
    *Counts total number of patients in database
    * @author Hugh Ybarra <hugh.ybarra@gmail.com>
    */
    public function count_all_patients(){
        $sql = $this->db->prepare("
            SELECT * FROM patients
        ");

        $sql->execute();
        $rows = $sql->fetchAll();
        $rowCount = count($rows);
        return $rowCount;
    }

    /**
    *Pagination function
    *
    */
    public function get_patient_range($range_one, $range_two){

        $sql = $this->db->prepare("
            SELECT * from patients
            ORDER BY patient_name
            LIMIT :range_one, :range_two
        ");

        $sql->bindParam(':range_one', $range_one, PDO::PARAM_INT);
        $sql->bindParam(':range_two', $range_two, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_CLASS);
    }

    /*
    *find if patient has a song or not
    *
    */
    public function patient_song($patient_id){

        $sql = $this->db->prepare("
            SELECT * FROM patients
            WHERE favorite_song_id IS NOT NULL
            AND patient_id = :patient_id
        ");

        $sql->bindParam(':patient_id', $patient_id, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetch();
    }

    /*
    *Search for patient song in the database
    */
    public function get_patient_song($song_id){

        $sql = $this->db->prepare('
            SELECT song_data FROM songs
            WHERE song_id IN (
                                SELECT favorite_song_id FROM patients
                                WHERE favorite_song_id = :song_id
                             )
        ');
        $sql->bindParam(':song_id', $song_id, PDO::PARAM_INT);
        $sql->execute();

        // var_dump($sql->fetch()['song_data']);

        return json_decode($sql->fetch()['song_data'], true);
    }
}

