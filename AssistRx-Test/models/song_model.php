<?php

// include 'my_model.php';

class song_model extends my_model
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
        $sql = $this->db->prepare('select * from songs');

        // expects that sql is a pdo prepared stmt
        $sql->execute();

        // http://php.net/manual/en/pdostatement.fetchall.php
        return $sql->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * TODO: comment this function
     *
     * @author hopeful candadite
     * @since  date
     * @param  [type] $patient_id [description]
     * @param  [type] $song_data [description]
     * @return [type] [description]
     */
    public function save_song_for_patient($patient_id, $song_data)
    {

        // md5 the data to do check
        $string_song_data = json_encode($song_data);

        // check if song exists in the database
        $result = $this->check_for_existing_song(md5($string_song_data));

        // checks for song in the dtabase
        if (!$result){

            // the song does not exist int he database

            // insert the song into the database
            $song_sql = $this->db->prepare("
                INSERT INTO songs
                (song_name, song_artist, song_data)
                VALUES (:song_name, :song_artist, :song_data)
            ");

            // expects that sql is a pdo prepared stmt
            $song_sql->execute(array(
                'song_name'   => $song_data['trackName'],
                'song_artist' => $song_data['artistName'],
                'song_data'   => json_encode($song_data)
            ));
            // grab the id of lastinsert
            $song_id = $this->db->lastInsertId();
        }
        else{

            // the song already exists in the database.
            $song_object=  $this->get_song_id(md5($string_song_data));
            // set the patients information to set
            $song_id = $song_object['song_id'];
        }


        //update patient song_id
        $patient_sql = $this->db->prepare("
            UPDATE patients
            SET favorite_song_id = :song_id
            WHERE patient_id = :patient_id
        ");

        $patient_sql->execute(array(
            'song_id'    => $song_id,
            'patient_id' => $patient_id
        ));

        // check the database for unused songs
        // if song is not attached to a user remove it
        $song_sql = $this->db->prepare("
            DELETE FROM songs
            WHERE song_id NOT IN (
                SELECT favorite_song_id FROM patients where favorite_song_id IS NOT NULL
            )
        ");
        $song_sql->execute();

        // if patient didn't exist, return some type of error
        //
        // return rows affected or True ? - up to you!
        // again here i was not sure what to do because of how i built this function.
        // the function will always have a patient becuase of the way I built the functionality.
    }

    /*
    *Search the song db with data hash value and return song id it belongs to
    */
    public function get_song_id($song_hash){

        $sql = $this->db->prepare("
            SELECT song_id FROM songs
            WHERE song_hash = :song_hash
        ");

        $sql->bindParam(':song_hash', $song_hash, PDO::PARAM_STR);
        $sql->execute();

        return $sql->fetch();
    }

    /*
    *
    *Chek to see if song exists in the database
    *
    */
    public function check_for_existing_song($song_hash){

        $sql = $this->db->prepare("
            SELECT song_id FROM songs
            WHERE song_hash = :song_hash
        ");

        $sql->bindParam(':song_hash', $song_hash, PDO::PARAM_STR);
        $sql->execute();

        return $sql->fetch();
    }

    /*
    *Search for patient song in the database
    */
    public static function get_patient_song($song_id){

        $sql = $this->db->prepare('
            SELECT song_data FROM songs
            WHERE song_id IN (
                                SELECT favorite_song_id FROM patients
                                WHERE favorite_song_id = :song_id
                             )
        ');
        $sql->bindParam(':song_id', $song_id, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fecth();
    }

}