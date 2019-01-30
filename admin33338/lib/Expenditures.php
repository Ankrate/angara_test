<?php
class Expenditures extends MyDb {

    public $data;

    private function heads() {
        $m = $this -> db();
        $q = "SELECT * FROM admin_val_exp_name";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);

        return $data;

    }

    public function get_data() {
        $m = $this -> db();
        $heads = $this -> heads();
        foreach ($heads as $p) {
            $q = "SELECT * FROM admin_val_month_expenditures WHERE DATE_FORMAT(date,'%Y-%m') = DATE_FORMAT(?,'%Y-%m') AND exp_id = ?";
            $t = $m -> prepare($q);
            $t -> execute(array($this -> data['month'], $p['id']));
            $data = $t -> fetchAll(PDO::FETCH_ASSOC);
            $data['name'] = $p['name'];
            $d[$p['id']] = $data;
        }
        //p($d);
        return $d;
    }

    private function chk_table($id) {
        $m = $this -> db();
        $q = "SELECT id FROM admin_val_month_expenditures WHERE id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $count = $t -> rowCount();
        if ($count > 0) {
            //p($data);
            return $data[0]['id'];
        } else {
            return false;
        }
    }

    public function update_insert() {
        //$d = $this -> data;
        $d = $this->combine_array();
        foreach ($d['exps'] as $k => $v) {
            $id = $this -> chk_table($v['id']);
            if ($id == FALSE) {
                //echo "no id";
                $this -> insert($k, $v['value'], $d['month']);
            } else {
                $this -> update($id, $v['value']);
            }
        }
        return true;
    }

    private function update($id, $value) {
        $conn = $this -> db();
        //$d = $this->combine_array();
        $sql = "UPDATE admin_val_month_expenditures
        SET value = :value
        WHERE id = :id";
        $values = array(':value' => $value, ':id' => $id);
        $q = $conn -> prepare($sql);
        $q -> execute($values);
        $count = $q -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function insert($exp_id, $value, $dat) {
        $conn = $this -> db();
        $sql = "INSERT INTO admin_val_month_expenditures (exp_id, value, date) VALUES (:exp_id, :value, :date)";
        $q = $conn -> prepare($sql);
        $q -> execute(array(':exp_id' => $exp_id, ':value' => $value, ':date' => $dat));
        $count = $q -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    private function combine_array() {
        $d = $this -> data;
        foreach ($d['exps'] as $k1=>$each) {
           // p($each);
             foreach($each as $k2=>$each2){
            $array[$d['exps']['exp_id'][$k2]] = array('value'=>$d['exps']['val'][$k2],'id'=>$d['exps']['id'][$k2]);
            // p($each2);
             }
        }
        $d['exps'] = $array;
       // p($d);
        return $d;
    }

}
