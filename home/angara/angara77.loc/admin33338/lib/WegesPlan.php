<?php

class WegesPlan extends MyDb {
    private $val;
    private $date;
    public $profit;

    //Функция расчета коэффициэнта зарплаты в зависимости от выполнения плана
    private function make_wage_rate($date, $user_id) {
        $val = $this -> total($date, $user_id);
        //$val = $this->profit;
        if ($val <= $this -> rateArr[25]['profit']) {
            $rate = $this -> rateArr[25]['rate'];
        } elseif ($val >= $this -> rateArr[25]['profit'] && $val < $this -> rateArr[30]['profit']) {
            $rate = $this -> rateArr[30]['rate'];
        } elseif ($val >= $this -> rateArr[30]['profit'] && $val < $this -> rateArr[35]['profit']) {
            $rate = $this -> rateArr[30]['rate'];
        } elseif ($val >= $this -> rateArr[35]['profit'] && $val < $this -> rateArr[40]['profit']) {
            $rate = $this -> rateArr[35]['rate'];
        } elseif ($val >= $this -> rateArr[40]['profit'] && $val < $this -> rateArr[45]['profit']) {
            $rate = $this -> rateArr[40]['rate'];
        } elseif ($val >= $this -> rateArr[45]['profit'] && $val < $this -> rateArr[50]['profit']) {
            $rate = $this -> rateArr[45]['rate'];
        } elseif ($val >= $this -> rateArr[50]['profit'] && $val < $this -> rateArr[55]['profit']) {
            $rate = $this -> rateArr[50]['rate'];
        } elseif ($val >= $this -> rateArr[55]['profit'] && $val < $this -> rateArr[60]['profit']) {
            $rate = $this -> rateArr[55]['rate'];
        } elseif ($val >= $this -> rateArr[60]['profit'] && $val < $this -> rateArr[65]['profit']) {
            $rate = $this -> rateArr[60]['rate'];
        } elseif ($val >= $this -> rateArr[65]['profit']) {
            $rate = $this -> rateArr[65]['rate'];
        }
        //echo $rate;
        return $rate;
    }

    public function get_all() {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        foreach ($data as $d) {
            $array[$d['username']] = $this -> profit_by_month($d['id']);
        }
        //p($array);
        return $array;
    }

    public function get_personal($user_id) {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = 'manager' AND id= ?";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        $array = $this -> profit_by_month($user_id);
        //p($array);
        return $array;
    }

    //Here we are getting bonuses from bonus table
    private function get_adm_bonus($rate, $user_id, $total) {
        $m = $this -> db();
        $q = "SELECT * FROM adm_bonus WHERE manager = ? AND bonus_id != 4";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);

        $sum = 0;
        foreach ($data as $d) {
            if ($rate <= $this -> point AND $d['breakeven_point'] == 0) {
                continue;
            } else {
                $sum += $d['bonus_value'];
            }
        }
        //echo $sum . '<br>';
        if ($user_id == 2) {

            $sum = round($sum + $total * 0.01);
        }
        return $sum;
    }

    private function get_plan_month($date, $user_id, $plan) {
        $m = $this -> db();
        $q = "SELECT * FROM adm_plans WHERE
             DATE_FORMAT(`date`, '%Y-%m') = ?
             AND manager_id = ?";

        $t = $m -> prepare($q);
        $t -> execute(array($date, $user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        if ($plan == 'porter') {
            return $data[0]['plan'];
        } elseif ($plan == 'noporter') {
            return $data[0]['plan2'];
        }
    }

    //Функция вычислени процентов от сделанной прибыли портер
    private function percent_porter($date, $user_id, $plan_id = 'plan') {
        $total = $this -> total_all($date);
        $m = $this -> db();
        $profit = $this -> get_prof_by_month_porter($date, $user_id);
        $plan = $this -> get_plan_month($date, $user_id, 'porter');
        //echo($plan) . ' - ' . $date . '<br>';
        $percentage = $profit / $plan;
        //p($percentage);

        return round($percentage, 4);

    }

    //то же не портер
    private function percent_no_porter($date, $user_id, $plan_id = 'plan2') {
        $total = $this -> total_all($date);
        $m = $this -> db();
        $profit = $this -> get_prof_by_month_no_porter($date, $user_id);
        $plan = $this -> get_plan_month($date, $user_id, 'noporter');
        $percentage = $profit / $plan;
        return round($percentage, 4);
    }
//Функция выбора процентов от сделанной прибыли
    public function get_bonus_value($date, $user_id, $plan_name, $value) {
        if($value > 13){
            $value = 13;
        }elseif($value < 4){
            return 0;
        }
        $m = $this -> db();
        $q = "SELECT * FROM `adm_stuff_percent_grade` WHERE DATE_FORMAT(date,'%Y-%m') = ?
        AND manager_id = ?
        AND plan_name_id = ?
        AND  plan > ?
        ORDER BY plan ASC LIMIT 1";
        $t = $m -> prepare($q);
        $t -> execute(array($date, $user_id, $plan_name, $value));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data[0]['value'];
    }

    //Функция выбора прибыли каждого менеджера
    private function total($date, $user_id) {
        $m = $this -> db();
        $q = "SELECT val_manager as manager, SUM(`val_profit`) as profit
                    FROM admin_val
                    WHERE
                    DATE_FORMAT(`val_date`, '%Y-%m') =  ?
                    AND `val_manager` = (SELECT user from userlist WHERE id = ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($date, $user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $d = $data[0]['profit'];
        //$this->p($d);
        return $d;
    }

    private function total_all($date) {
        $m = $this -> db();
        $q = "SELECT val_manager as manager, SUM(`val_profit`) as profit
                    FROM admin_val
                    WHERE
                    DATE_FORMAT(`val_date`, '%Y-%m') =  ?";
        $t = $m -> prepare($q);
        $t -> execute(array($date));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $d = $data[0]['profit'];
        //$this->p($d);
        return $d;
    }

    private function rentability($date, $user_id) {

        $m = $this -> db();
        $q = "SELECT `val_manager`, AVG(`val_rent`) as rent
              FROM admin_val
              WHERE DATE_FORMAT(`val_date`, '%Y-%m')   LIKE ?
              AND `val_manager` = (SELECT user from userlist WHERE id = ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($date, $user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        $percent = round($data[0]['rent'], 2);
        return $percent;

    }

    private function get_prof_by_month_porter($date, $user_id) {
        $m = $this -> db();
        $q = "SELECT val_manager as manager, DATE_FORMAT(val_date,'%Y-%m') as date, SUM(`val_profit`) as profit
                    FROM  admin_val
                    WHERE
                    DATE_FORMAT(`val_date`, '%Y-%m') = ?
                    AND `val_manager` = (SELECT user from userlist WHERE id = ?) AND val_car LIKE ?";

        $t = $m -> prepare($q);
        $t -> execute(array($date, $user_id, 'porter%'));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data[0]['profit'];
    }

    private function get_prof_by_month_no_porter($date, $user_id) {
        $m = $this -> db();
        $q = "SELECT val_manager as manager, DATE_FORMAT(val_date,'%Y-%m') as date, SUM(`val_profit`) as profit
                    FROM  admin_val
                    WHERE
                    DATE_FORMAT(`val_date`, '%Y-%m') = ?
                    AND `val_manager` = (SELECT user from userlist WHERE id = ?) AND val_car NOT LIKE ?";

        $t = $m -> prepare($q);
        $t -> execute(array($date, $user_id, 'porter%'));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data[0]['profit'];
    }

    private function get_oklad($user_id) {
        $m = $this -> db();
        $q = "SELECT SUM(bonus_value) as summa FROM `adm_bonus` WHERE `manager` = ? AND bonus_id != 4";

        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data[0]['summa'];
    }

    public function get_plan_porter($user_id, $date, $value) {
        $m = $this -> db();
        $q = "SELECT SUM(bonus_value) as summa FROM `adm_bonus` WHERE `manager` = ?  AND bonus_id != 4";

        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data[0]['summa'];
    }

    public function profit_by_month($user_id, $limit = 12) {
        $m = $this -> db();

        $q = "SELECT val_manager as manager, DATE_FORMAT(val_date,'%Y-%m') as date, SUM(`val_profit`) as profit
                    FROM  admin_val
                    WHERE
                    DATE_FORMAT(`val_date`, '%Y-%m') != DATE_FORMAT(CURDATE(), '%Y-%m')
                    AND `val_manager` = (SELECT user from userlist WHERE id = :id)
                    GROUP BY DATE_FORMAT(val_date,'%Y-%m')
                    ORDER BY val_date DESC
                    LIMIT {$limit} ";

        $t = $m -> prepare($q);
        //$t->bindValue(':limit', PDO::PARAM_INT);
        $t -> execute(array('id' => $user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        foreach ($data as $d) {
            //p($d);
            $d['id'] = $user_id;
            $d['porter'] = $this -> get_prof_by_month_porter($d['date'], $user_id);
            $d['no_porter'] = $this -> get_prof_by_month_no_porter($d['date'], $user_id);
            $d['total'] = $this -> total($d['date'], $user_id);
            $d['total_all'] = $this -> total_all($d['date']);
            $d['rent'] = $this -> rentability($d['date'], $user_id);
            $d['rate'] = $this -> make_wage_rate($d['date'], $user_id);
            $d['dolya'] = $this -> percent_porter($d['date'], $user_id);
            $d['dolya2'] = $this -> percent_no_porter($d['date'], $user_id);
            $d['oklad'] = $this -> get_oklad($user_id);
            $d['bonus_porter'] = $this-> get_bonus_value($d['date'], $user_id, 'plan', $d['dolya']*10);
            $d['bonus_no_porter'] = $this-> get_bonus_value($d['date'], $user_id, 'plan2', $d['dolya2']*10);
            $d['wage'] = round($d['oklad'] + $d['porter']*$d['bonus_porter']/100 + $d['no_porter']*$d['bonus_no_porter']/100, 0);
            $array[] = $d;
        }
        if (!isset($array)) {
            $array = false;
        }
        //p($array);
        return $array;
    }

}
