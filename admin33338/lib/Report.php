<?php
class Report extends MyDb {
    public $new_array;

    public function get_data() {
        $cars = $this -> get_cars();
        return $cars;
    }

    public function insert($table, $data, $manager_id, $manager_name) {
        $conn = $this -> db();
        $table = 'report';
        if ($this -> check_report($table) == FALSE) {
            $i = 0;
            foreach ($data['car_id'] as $c) {
                $n[$c] = array($data['calls'][$i], $data['sales'][$i]);
                ++$i;
            }

            $this -> new_array = $n;
            $count = 0;
            foreach ($n as $k => $d) {
                if (empty($d[0]) && empty($d[1])) {
                    continue;
                }

                $sql = "INSERT INTO " . $table . " (calls,sales,car_id, manager_id, manager_name) VALUES (:calls,:sales,:car_id,:manager_id, :manager_name)";
                $q = $conn -> prepare($sql);
                $q -> execute(array(':calls' => $d[0], ':sales' => $d[1], ':car_id' => $k, ':manager_id' => $data['user_id'], ':manager_name' => $data['user']));
                $count += $q -> rowCount();
            }
            if ($count > 0) {
                $this -> send_mail();
                return true;
            }
        } else {
            return false;
        }
    }

    public function reorder_get($data) {
        $i = 0;
        foreach ($data['car_id'] as $c) {
            $car = $this -> get_car_name($c);
            $n[$car[0]['title']] = array($data['calls'][$i], $data['sales'][$i]);

            ++$i;
        }
        return $n;
    }

    public $headers;
    public $to = 'angara77@gmail.com';
    public $from = 'angara99@gmail.com';
    public $subject;
    public $manager;
    public $message;

    private function send_mail() {

        $this -> headers = "Content-type: text/html; charset=utf-8 \r\n";
        $this -> headers .= "From: Ангара отчеты <" . $this -> from . ">\r\n";
        if (mail($this -> to, $this -> subject, $this -> message, $this -> headers)) {

            //echo 'Mail has sent!';
        }
    }

    protected function get_car_name($id) {

        $m = db();
        $q = 'SELECT title FROM ang_cars WHERE id = ?';
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

    public function get_manager_perfom() {
        $m = db();
        $manager = $this -> manager;
        $q = 'SELECT SUM(val_cost) as val_cost, SUM(val_profit) as val_profit, ROUND(AVG(val_rent),2) as val_rent, val_manager FROM admin_val WHERE val_date = CURDATE() and val_manager = ?';
        $t = $m -> prepare($q);
        $t -> execute(array($manager));
        if ($data = $t -> fetchAll(PDO::FETCH_ASSOC)) {
            return $data;
        } else {
            return FALSE;
        }
    }

    private function check_report($table) {
        $m = db();
        $q = 'SELECT id FROM ' . $table . ' WHERE DATE(`date`) = CURDATE() and manager_name = ?';
        $t = $m -> prepare($q);
        $t -> execute(array($this -> manager));
        $count = $t -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return FALSE;
        }
    }

    //Отчеты маркетологов
    public $type;
    private function get_mkt_score_names() {
        $type = $this->type;
        $m = db();
        $q = 'SELECT * FROM adm_mkt_rep_names WHERE enabled = "1" and type = ?';
        $t = $m -> prepare($q);
        $t -> execute(array($type));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

    public function get_data_mkt() {
        $score_names = $this -> get_mkt_score_names();
        return $score_names;
    }

    public function insert_mkt($table, $data, $manager_id, $manager_name) {
        $conn = $this -> db();
        $table = 'adm_mkt_rpt_daily';
        if ($this -> check_report($table) == FALSE) {
            $count = 0;
            foreach ($data['score'] as $key=>$value) {
                if(empty($value)){
                    continue;
                }
                $sql = "INSERT INTO " . $table . " (score_id, score_val, mng_id ,manager_name) VALUES (:score_id, :score_val, :mng_id, :mng_name)";
                $q = $conn -> prepare($sql);
                $q -> execute(array(':score_id' => $key, ':score_val' => $value, ':mng_id' => $data['user_id'], ':mng_name' => $data['user']));
                $count += $q -> rowCount();
            }
            if ($count > 0) {
                $this -> send_mail();
                return true;
            }
        } else {
            return false;
        }
    }
    
    public function get_mkt_score_names2($id) {

        $m = db();
        
        $q = 'SELECT * FROM adm_mkt_rep_names WHERE id = ?';
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

}
