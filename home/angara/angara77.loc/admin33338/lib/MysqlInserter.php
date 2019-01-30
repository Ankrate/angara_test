<?php
//include 'MyDb.php';
class MysqlInserter extends MyDb {
    public $columns = array('manager_id', 'score_', 'score_val');
    public $table = 'report_executive';
    public $data = array( array(1, 'Тупость', 3), array(2, 'cleverty', 5));

    public function insert_template() {
        $conn = $this -> db();
        $string_q = implode(',', $this -> columns);
        $count = count($this -> columns);
        $values = str_replace(',', ',:', $string_q);
        $values = preg_replace('/^/', ':', $values);
        $v = explode(',', $values);
        $sql = "INSERT INTO " . $this -> table . " ($string_q) VALUES (" . $values . ")";
        $co = 0;
        foreach ($this->data as $d) {
            $i = 0;
            foreach ($d as $dl) {
                $b[$v[$i]] = $dl;
                ++$i;
            }

            $q = $conn -> prepare($sql);
            $q -> execute($b);
            $co += $q -> rowCount();
        }
        echo 'inserted ' . $co . ' rows';
    }

    private function insert() {
        $conn = $this -> db();

        $sql = "INSERT INTO " . $this -> table . " (manager_id, score_id, score_val) VALUES (:manager_id, :score_id, :score_val)";

        foreach ($this->data as $key => $d) {
            //array_unshift($d,$key);
            //$this -> p($d);
            $co = 0;
            foreach ($d as $keyin => $in) {
                $q = $conn -> prepare($sql);
                $q -> execute(array(':manager_id' => $key, ':score_id' => $keyin, ':score_val' => $in));

            }
            $co += $q -> rowCount();
        }

        //echo 'inserted ' . $co . ' rows';
    }

    public function check_report_insert() {
        $m = db();
        $q = 'SELECT id FROM ' . $this -> table . ' WHERE DATE(`date`) = CURDATE()';
        $t = $m -> prepare($q);
        $t -> execute();
        $count = $t -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            $this -> insert();
            return FALSE;
        }
    }

    public function get_score() {

        $m = db();
        $q = 'SELECT * FROM report_score';
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

}
