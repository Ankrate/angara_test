<?php
class Allegro extends AdvigatelConnection {

    public $eng_model;
    public $eng_year;
    public $eng_part;

    public function get_eng_model() {
        $m = $this -> db();
        if (!$this -> eng_year) {
            $q = "SELECT * FROM offers WHERE title LIKE ? AND title LIKE ?";
            $t = $m -> prepare($q);
            $t -> execute(array('%' . $this -> eng_part . '%', '%' . $this -> eng_model . '%'));
            $data = $t -> fetchAll(PDO::FETCH_ASSOC);
            //p( $data);
            return $data;

        } else {
            $q = "SELECT * FROM offers WHERE title LIKE ? AND title LIKE ? AND title LIKE ? ";

            $t = $m -> prepare($q);
            $t -> execute(array('%' . $this -> eng_part . '%', '%' . $this -> eng_model . '%', '%' . $this -> eng_year . '%'));
            $data = $t -> fetchAll(PDO::FETCH_ASSOC);
            //p( $data);
            return $data;
        }
    }

}
