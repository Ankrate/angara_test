<?php
class NewUser extends MyDb {

    public $user_id;
    public $table;
    // Table MySql
    public $data;
    //Get data received from new user addition
    public $myplan;
    public $plan_name;
//выбираем уволенных сотрудников
    public function mngs() {
        $m = $this -> db();
        $q = "SELECT * FROM userlist WHERE enabled = '0'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }
    //Выбираем работающих сотрудников
     public function mngs_yes() {
        $m = $this -> db();
        $q = "SELECT * FROM userlist WHERE enabled = '1'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function mngs2() {
        $m = $this -> db();
        $q = "SELECT * FROM userlist WHERE enabled = '1'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function plan() {
        $m = $this -> db();
        $q = "SELECT a.*, b.username FROM adm_plans as a
        LEFT JOIN userlist as b
        ON a.manager_id = b.id
         WHERE MONTH(a.date) = MONTH(CURDATE()) AND b.type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function plan_motiv() {
        $m = $this -> db();
        $q = "SELECT * FROM adm_plans
        WHERE manager_id = ? AND DATE_FORMAT(date,'%Y-%m') = DATE_FORMAT(?,'%Y-%m')";
        $t = $m -> prepare($q);
        $t -> execute(array($this -> user_id, $this -> data['month']));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function bonname() {
        $m = $this -> db();
        $q = "SELECT * FROM adm_bonus_name";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function bon($user_id, $bonus_id) {
        $m = $this -> db();
        $q = "SELECT a.*, b.id, b.manager, b.bonus_value, b.bonus_id, b.breakeven_point
        FROM adm_bonus_name as a
        LEFT JOIN adm_bonus as b
        ON a.id = b.bonus_id
        WHERE b.manager = ? AND a.id = ? ";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id, $bonus_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        if (!$data) {
            $data[0] = 0;
        }
        return ($data[0]);
        //return $data[0];
    }

    public function mng_select() {
        $m = $this -> db();
        $q = "SELECT * FROM userlist WHERE id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($this -> user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function insert() {
        $conn = $this -> db();
        $d = $this -> data;
        $this -> table = 'userlist';
        $sql = "INSERT INTO " . $this -> table . "
        (
          user,
          pass,
          username,
          tel,
          email,
          type,
          enabled,
          role,
          rolename,
          hire_date,
          fire_date
          ) VALUES
          (
          :user,
          :pass,
          :username,
          :tel,
          :email,
          :type,
          :enabled,
          :role,
          :rolename,
          :hire_date,
          :fire_date
          )";
        $q = $conn -> prepare($sql);
        $q -> execute(array(
          ':user' => $d['user'],
          ':pass' => md5($d['pass']),
          ':username' => $d['username'],
          ':tel' => $d['tel'],
          ':email' => $d['email'],
          ':type' => $d['type'],
          ':enabled' => $d['enabled'],
          ':role' => $d['role'],
          ':rolename' => $d['rolename'],
          ':hire_date' => $d['hire_date'],
          ':fire_date' => $d['fire_date']));
        $count = $q -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function delete() {
        $conn = $this -> db();
        $sql = "DELETE FROM userlist WHERE id = ?";
        $q = $conn -> prepare($sql);
        $q -> execute(array($this -> user_id));
        $count = $q -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        $conn = $this -> db();
        $d = $this -> data;
        $sql = "UPDATE userlist
        SET user = :user,
        pass = :pass,
        username = :username,
        type = :type,
        enabled = :enabled,
        role = :role,
        rolename = :rolename,
        hire_date = :hire_date,
        fire_date = :fire_date
        WHERE id = :user_id";
        if (strlen($d['pass']) != 32) {
            $d['pass'] = md5($d['pass']);
        }
        $values = array(':user' => $d['user'], ':pass' => $d['pass'], ':username' => $d['username'], ':type' => $d['type'], ':enabled' => $d['enabled'], ':role' => $d['role'], ':rolename' => $d['rolename'], ':hire_date' => $d['hire_date'], ':fire_date' => $d['fire_date'], ':user_id' => $d['id']);
        $q = $conn -> prepare($sql);
        $q -> execute($values);
        $count = $q -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function planupdate() {
        $conn = $this -> db();
        $d = $this -> data;
        $sql = "UPDATE adm_plans
        SET plan = :plan
        WHERE id = :id";

        $values = array(':plan' => $d['plan'], ':id' => $d['id']);
        $q = $conn -> prepare($sql);
        $q -> execute($values);
        $count = $q -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_managers_user() {
        $m = $this -> db();
        $q = "SELECT a.username, a.id as user_id, b.* FROM userlist as a
        LEFT JOIN adm_plans as b
        on a.id = b.manager_id
         WHERE a.enabled = '1' AND a.type = 'manager'
         AND extract(YEAR_MONTH FROM b.date) = extract(YEAR_MONTH FROM CURDATE())";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function get_salesmanagers() {
        $m = $this -> db();
        $q = "SELECT * FROM userlist
         WHERE enabled = '1' AND type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    private function check_plan_insert($date) {
        $m = $this -> db();
        $q = "SELECT id FROM adm_plans WHERE MONTH(date) = MONTH(?) AND YEAR(date) = YEAR(?) AND manager_id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($date,$date, $this -> data['user_id']));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $count = $t -> rowCount();
        if ($count > 0) {
            //p($data[0]);
            return $data[0];
        } else {
            return false;
        }
    }


    public function planinsert() {
        foreach ($this->data['plan'] as $dat => $plan) {
            if ($id = $this -> check_plan_insert($dat)) {
                $this -> planupdate2($id, $plan);
            } else {
                $this -> insertplan($dat, $plan);

            }
        }
        return true;
    }



    private function planupdate2($id, $plan) {
        $conn = $this -> db();
        $d = $this -> data;
        $sql = "UPDATE adm_plans
        SET plan = :plan,
        plan2 = :plan2
        WHERE id = :id";
        //p($plan);
        $values = array(':plan' => $plan['plan1'][0], ':plan2' => $plan['plan2'][0], ':id' => $id['id']);
        $q = $conn -> prepare($sql);
        $q -> execute($values);
        $count = $q -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }

    private function insertplan($dat, $plan) {
        //p($plan);
        $conn = $this -> db();
        $d = $this -> data;
        $this -> table = 'userlist';
        $sql = "INSERT INTO adm_plans (date, plan, manager_id,plan2) VALUES (:date, :plan1, :manager_id,:plan2)";
        $q = $conn -> prepare($sql);
        $q -> execute(array(':date' => $dat, ':plan1' => $plan['plan1'][0], ':manager_id' => $d['user_id'], ':plan2' => $plan['plan2'][0], ));
        $count = $q -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function get_plans2($id, $date) {
        $m = $this -> db();
        $q = "SELECT a.*, b.username FROM adm_plans as a
        LEFT JOIN userlist as b
        ON a.manager_id = b.id
        WHERE a.date = ? AND b.id = ?
        ORDER BY a.date";
        $t = $m -> prepare($q);
        $t -> execute(array($date, $id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        if ($data == FALSE) {
            $data[0]['plan'] = 0;
            $data[0]['plan2'] = 0;
        }
        return $data;
    }

    //bonuses inserter

    private function check_bonus_insert($id) {
        $m = $this -> db();
        $q = "SELECT id FROM adm_bonus WHERE bonus_id = ? AND manager = ? ";
        $t = $m -> prepare($q);
        $t -> execute(array($id, $this -> data['user_id']));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $count = $t -> rowCount();
        if ($count > 0) {
            //p($data[0]);
            return $data[0];
        } else {
            return false;
        }
    }

    public function bonusinsert() {
        foreach ($this->data['bonus'] as $dat => $plan) {
            if ($id = $this -> check_bonus_insert($dat)) {
                echo 'update';
                $this -> bonusupdate2($id, $plan);
            } else {
                echo 'insert';
                $this -> insertbonus($dat, $plan);
            }
        }
        return true;
    }

    private function bonusupdate2($id, $plan) {
        $conn = $this -> db();
        $d = $this -> data;
        $sql = "UPDATE adm_bonus
        SET bonus_value = :bonus_value
        WHERE id = :id";
        $values = array(':bonus_value' => $plan, ':id' => $id['id']);
        $q = $conn -> prepare($sql);
        $q -> execute($values);
        $count = $q -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }

    private function insertbonus($dat, $plan) {
        $conn = $this -> db();
        $d = $this -> data;
        if (!$plan) {
            $plan = 0;
        }
        $this -> table = 'userlist';
        $sql = "INSERT INTO adm_bonus (manager, bonus_value, bonus_id) VALUES (:manager, :bonus_value, :bonus_id)";
        $q = $conn -> prepare($sql);
        $q -> execute(array(':manager' => $d['user_id'], ':bonus_value' => $plan, ':bonus_id' => $dat));
        $count = $q -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function get_bonus2($id, $date) {
        $m = $this -> db();
        $q = "SELECT a.*, b.username FROM adm_plans as a
        LEFT JOIN userlist as b
        ON a.manager_id = b.id
        WHERE a.date = ? AND b.id = ?
        ORDER BY a.date";
        $t = $m -> prepare($q);
        $t -> execute(array($date, $id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        if ($data == FALSE) {
            $data[0]['plan'] = 0;
        }
        return $data;
    }

    //adm_stuff_percent_grade

    private function grade() {
        $m = $this -> db();
        $q = "SELECT * FROM adm_stuff_percenage_range";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);

        return $data;

    }

    public function check_adm_stuff_percent_grade() {
        $m = $this -> db();
        $percent = $this -> grade();
        foreach ($percent as $p) {
            $q = "SELECT * FROM adm_stuff_percent_grade WHERE DATE_FORMAT(date,'%Y-%m') = DATE_FORMAT(?,'%Y-%m') AND manager_id = ? AND plan_name_id = ? AND plan = ?";
            $t = $m -> prepare($q);
            $t -> execute(array($this -> data['month'], $this -> data['user_id'], $this -> plan_name, $p['id']));
            if (!$da = $t -> fetchAll(PDO::FETCH_ASSOC)) {
                $da[0] = null;
            }
            $data[$p['name']] = array('p_id' => $p['id'], 'adat' => $da[0]);

        }
        // p($data);
        return $data;
    }

    public function chk_table($id, $plan_name_id) {
        $m = $this -> db();
        $q = "SELECT id FROM adm_stuff_percent_grade WHERE id = ? AND plan_name_id = ? ";
        $t = $m -> prepare($q);
        $t -> execute(array($id, $plan_name_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $count = $t -> rowCount();
        if ($count > 0) {
            p($data);
            return $data[0]['id'];
        } else {
            return false;
        }
    }

    public function percentinsert() {
        $d = $this -> combine_array();
        foreach ($d['pers'] as $key => $each) {
            $id = $this -> chk_table($each['pid'], $d['plan_name_id']);
            if ($id == FALSE) {
                //echo "no id";
                $this -> insertpersent($d['user_id'], $key, $each['pvalue'], $d['plan_name_id'], $d['date']);
            } else {
                $this -> percentupdate($id, $each['pvalue']);
            }
        }
        return true;
    }

    private function percentupdate($id, $value) {
        $conn = $this -> db();
        //$d = $this->combine_array();
        $sql = "UPDATE adm_stuff_percent_grade
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

    private function insertpersent($manager_id, $plan, $value, $plan_name_id, $dat) {
        $conn = $this -> db();
        //$d = $this->combine_array();
        $sql = "INSERT INTO adm_stuff_percent_grade (manager_id, plan, value, plan_name_id, date) VALUES (:manager_id, :plan, :value, :plan_name_id, :date)";
        $q = $conn -> prepare($sql);
        $q -> execute(array(':manager_id' => $manager_id, ':plan' => $plan, ':value' => $value, ':plan_name_id' => $plan_name_id, ':date' => $dat));
        $count = $q -> rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }

    }

    private function combine_array() {
        $d = $this -> data;
        foreach ($d['pers'] as $k1 => $each) {
            // p($each);
            foreach ($each as $k2 => $each2) {
                $array[$k2] = array('pvalue' => $d['pers']['value'][$k2], 'pid' => $d['pers']['id'][$k2]);
                // p($each2);
            }
        }
        $d['pers'] = $array;
        //p($d);
        return $d;
    }

    //Copying percent manager from previous month


    private function get_managers_for_copy() {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    private function chk_copy_exist($manager_id) {
        $m = $this -> db();
        $q = "SELECT id FROM adm_stuff_percent_grade WHERE manager_id = ? AND YEAR(`date`) = YEAR(CURDATE()) AND MONTH(`date`) = MONTH(DATE_ADD(CURDATE(),INTERVAL 1 MONTH))";
        $t = $m -> prepare($q);
        $t -> execute(array($manager_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $count = $t -> rowCount();
        if ($count > 0) {;
            return TRUE;
        } else {
            return false;
        }
    }

    private function per_copy($manager_id, $start_date) {
        $m = $this -> db();
        $q = "INSERT INTO adm_stuff_percent_grade 
        ( manager_id, plan, `value`, plan_name_id, `date`)
        SELECT manager_id, plan, `value`, plan_name_id, DATE_ADD(`date`,INTERVAL 1 MONTH)
        FROM adm_stuff_percent_grade WHERE manager_id = :id AND YEAR(`date`) = YEAR(:start_date) AND MONTH(`date`) = MONTH(:start_date)";
        $t = $m -> prepare($q);
        $t -> execute(array(':id' => $manager_id, ':start_date' => $start_date));
        //$data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $count = $t -> rowCount();
        return $count;
    }

    public function percentcopy($start_date) {
        $mngs = $this -> get_managers_for_copy();
        foreach ($mngs as $m) {
            if ($check = $this -> chk_copy_exist($m['id'])) {
                continue;
            } else {
                if ($copy = $this -> per_copy($m['id'], $start_date)) {
                    //return true;
                }
            }
        }
            return true;
    }

    public function russian_month($month) {
        $date = explode("-", $month);
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
