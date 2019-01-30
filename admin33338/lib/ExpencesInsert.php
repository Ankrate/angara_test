<?php
class ExpencesInsert extends MyDb {

    public $company_id;
    public $table;
    public $table2;
    // Table MySql
    public $data;
    //Get data received from new user addition
    public $myplan;
    public $plan_name;
    public $table_summ;

    public function company_select() {
        $m = $this -> db();
        $q = "SELECT * FROM adm_companies WHERE id= ?";
        $t = $m -> prepare($q);
        $t -> execute(array($this -> company_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function companies() {
        $m = $this -> db();
        $q = "SELECT * FROM adm_companies";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function fields() {
        $m = $this -> db();
        $q = "SELECT * FROM adm_companies_expes_name";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function fields_incom() {
        $m = $this -> db();
        $q = "SELECT * FROM adm_companies_incom_name";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function get_exp($id, $date, $com_id) {
        $m = $this -> db();
        $table = $this -> table;
        $table2 = $this -> table2;
        $q = "SELECT a.*, b.name FROM adm_companies_expens_value as a
        LEFT JOIN adm_companies_expes_name as b
        ON a.name_id = b.id
        WHERE a.date = ? AND b.id = ? AND a.company_id = ?
        ORDER BY a.date";
        $t = $m -> prepare($q);
        $t -> execute(array($date, $id, $com_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        if (!$data) {
            $data[0]['value'] = 0;
        }
        //p($data);
        return $data;
    }

    public function get_incom($id, $date, $com_id) {
        $m = $this -> db();
        $table = $this -> table;
        $table2 = $this -> table2;
        $q = "SELECT a.*, b.name FROM adm_companies_incom_value as a
        LEFT JOIN adm_companies_incom_name as b
        ON a.name_id = b.id
        WHERE a.date = ? AND b.id = ? AND a.company_id = ?
        ORDER BY a.date";
        $t = $m -> prepare($q);
        $t -> execute(array($date, $id, $com_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        if (!$data) {
            $data[0]['value'] = 0;
        }
        //p($data);
        return $data;
    }

    public function exp_summ_article($name_id, $date, $company_id) {
        $m = $this -> db();
        //echo $this->table;
        $q = "SELECT SUM(value) as summa FROM {$this->table_summ} WHERE name_id = ? AND extract( YEAR_MONTH FROM date) = extract(YEAR_MONTH FROM ?) AND company_id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($name_id, $date, $company_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function budget_work() {

        foreach ($this->data['ex_value'] as $month => $name_arr) {
            foreach ($name_arr as $name_id => $val_arr) {
                foreach ($val_arr as $id => $val) {
                    
                    //p($val_arr);
                    if ($val['value'] == 0) {
                        continue;
                    }
                    if ($uid = $this -> check_insert($id) != 0) {
                        $this -> budget_update($id, $val['value']);
                    } elseif ($id == 0 OR $id == FALSE) {
                        $this -> budget_insert($this -> table, $this -> data['company_id'], $name_id, $month, $id, $val['value']);
                    }
                }
            }
        }
        return true;
    }

    private function check_insert($id) {
        $m = $this -> db();
        $q = "SELECT id FROM {$this->table} WHERE id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $count = $t -> rowCount();
        if ($count > 0) {
            //p($data[0]['id']);
            return $data[0]['id'];
        } else {
            return $data = 0;
        }
    }

    private function budget_update($id, $val) {
        $val = str_replace(',', '', $val);
        $conn = $this -> db();
        $sql = "UPDATE {$this -> table} SET value = :val
        WHERE id = :id";
        //p($plan);
        $values = array(':val' => $val, ':id' => $id);
        $q = $conn -> prepare($sql);
        $q -> execute($values);
        $count = $q -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }

    private function budget_insert($table, $company_id, $name_id, $month, $id, $val) {
        //p($plan);
        $val = str_replace(',', '', $val);
        $conn = $this -> db();
        $sql = "INSERT INTO {$this->table}(company_id, name_id, value, date) VALUES (:company_id, :name_id, :value, :date)";
        $q = $conn -> prepare($sql);
        $q -> execute(array(':company_id' => $company_id, ':name_id' => $name_id, ':value' => $val,  ':date' => $month));
        $count = $q -> rowCount();
        if ($count > 0) {

            return true;
        } else {
            return false;
        }

    }
    
    public function insert_ballance($ballance) {
        $conn = $this -> db();
        $sql = "INSERT INTO adm_companies_ballance (debt,money) VALUES (:debt, :money)";
        $q = $conn -> prepare($sql);
        $q -> execute(array(':debt' => $ballance['debt'], ':money' => $ballance['money']));
        $count = $q -> rowCount();
        if ($count > 0) {

            return true;
        } else {
            return false;
        }

    }
    
    
     public function get_ballance() {
        $m = $this -> db();
        $q = "SELECT * FROM adm_companies_ballance WHERE id =(SELECT max(id) FROM adm_companies_ballance)";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
            return $data[0];
    }

    public function russian_month() {
        $date = explode(".", date("d.m.Y"));
        switch ($date[1]) {
            case 1 :
                $m = 'Январь';
                break;
            case 2 :
                $m = 'Феврал';
                break;
            case 3 :
                $m = 'Март';
                break;
            case 4 :
                $m = 'Апрель';
                break;
            case 5 :
                $m = 'Май';
                break;
            case 6 :
                $m = 'Июнь';
                break;
            case 7 :
                $m = 'Июль';
                break;
            case 8 :
                $m = 'Август';
                break;
            case 9 :
                $m = 'Сентябрь';
                break;
            case 10 :
                $m = 'Октябрь';
                break;
            case 11 :
                $m = 'Ноябрь';
                break;
            case 12 :
                $m = 'Декабрь';
                break;
        }
        return $m . ' ' . $date[2];
    }

    public function fields_inc2() {
        $m = $this -> db();
        $q = "SELECT * FROM adm_companies_incom_name";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function get_inc2($id, $date, $com_id) {
        $m = $this -> db();
        $table = $this -> table;
        $table2 = $this -> table2;
        $q = "SELECT a.*, b.name FROM adm_companies_incom_value_real as a
        LEFT JOIN adm_companies_incom_name as b
        ON a.name_id = b.id
        WHERE extract( YEAR_MONTH FROM a.date) = extract( YEAR_MONTH FROM ?) AND b.id = ? AND a.company_id = ?
        ORDER BY a.date";
        $t = $m -> prepare($q);
        $t -> execute(array($date, $id, $com_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        if (!$data) {
            $data[0]['value'] = 0;
        }
        //p($data);
        return $data;
    }
    
    public function SumByMonth($year_month){
        $m = $this->db();
        $table = $this->table;
        $q = "SELECT SUM(value) as summa FROM `adm_companies_expens_value` WHERE extract(YEAR_MONTH FROM date) =  extract(YEAR_MONTH FROM ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($year_month));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data[0];
    }
    
     public function SumFzpByMonth($year_month){
        $m = $this->db();
        $table = $this->table;
        $q = "SELECT SUM(value) as summa FROM `adm_personell_salary` WHERE extract(YEAR_MONTH FROM date) =  extract(YEAR_MONTH FROM ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($year_month));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data[0];
    }

}
