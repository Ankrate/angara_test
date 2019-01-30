<?php
class SalaryInsert extends MyDb {

    private $company_id = 1;
    public $post;
    public $data1;

      public function get_enabled_stuff() {
        $m = $this -> db();
        $q = "SELECT id,username,type FROM userlist WHERE enabled = '1'";
        $t = $m -> prepare($q);
        $t -> execute(array($this -> company_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }


      public function get_stuff_salary($manager_id, $date) {
        $m = $this -> db();
        $q = "SELECT SUM(value) as summa, type FROM adm_personell_salary WHERE manager_id = ? AND extract(YEAR_MONTH FROM date) = extract(YEAR_MONTH FROM ?) ";
        $t = $m -> prepare($q);
        $t -> execute(array($manager_id,$date));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

      public function get_stuff_sallary_dates($manager_id,$date) {
        $m = $this -> db();
        $q = "SELECT id, value,date FROM adm_personell_salary WHERE manager_id = ? AND extract(YEAR_MONTH FROM date) = extract(YEAR_MONTH FROM ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($manager_id,$date));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

      public function get_stuff_oklad($manager_id) {
        $m = $this -> db();
        $q = "SELECT SUM(bonus_value) as summa FROM adm_bonus WHERE manager = ? AND bonus_id = 4";
        $t = $m -> prepare($q);
        $t -> execute(array($manager_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data[0];
    }


    private function data_insert($manager_id, $value, $type, $date) {
        //p($plan);

        $conn = $this -> db();
        $sql = "INSERT INTO adm_personell_salary (manager_id, value, type, date) VALUES (:manager_id, :value, :type, :date)";
        $q = $conn -> prepare($sql);
        $q -> execute(array(':manager_id' => $manager_id, ':value' => $value, ':type' => $type, ':date' => $date));
        $count = $q -> rowCount();
        if ($count > 0) {

            return true;
        } else {
            return false;
        }

    }

    public function data_arr_insert(){
        foreach($this->post['data'] as $manager_id => $value){
           // p($value);
            if($value['value'] == '' OR $value['value'] == 0){
                continue;
            }
           $this->data_insert($manager_id, $value['value'], $value['type'], $value['date']);
        }
        return TRUE;
    }


    public function get_personal_salary($manager_id, $date) {
        $m = $this -> db();
        $q = "SELECT * FROM adm_personell_salary  WHERE manager_id = ? AND extract(YEAR_MONTH FROM date) = extract(YEAR_MONTH FROM ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($manager_id, $date));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function get_m($id) {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

     private function update_personal_salary($id, $val) {
        $conn = $this -> db();
        $sql = "UPDATE adm_personell_salary SET value = :val
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

     public function updmng(){
         foreach($this->data1 as $id => $val){
             $this->update_personal_salary($id, $val);
         }
         return true;
     }



      public function russian_month($date) {
        $date = explode("-", $date);
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
        return $m . ' ' . $date[0];
    }








}
