<?php
// Этот класс для выборки зарплат за прошлые месяцы
class Weges2 extends MyDb {
    private $val;
    private $profit;


    public function get_all() {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        foreach ($data as $d) {
            $array[$d['username']] = $this->profit_by_month($d['id']);

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
            $array = $this->profit_by_month($user_id);


        //p($array);
        return $array;
    }



  //Функция расчета коэффициэнта зарплаты в зависимости от выручки
    private function make_wage_rate($date) {
        $val = $this -> profit;
         if ($val <= $this->rateArr[25]['profit']) {
            $rate = $this->rateArr[25]['rate'];
        } elseif ($val >= $this->rateArr[25]['profit'] && $val < $this->rateArr[30]['profit']) {
            $rate = $this->rateArr[30]['rate'];
        } elseif ($val >= $this->rateArr[30]['profit'] && $val < $this->rateArr[35]['profit']) {
            $rate = $this->rateArr[30]['rate'];
        } elseif ($val >= $this->rateArr[35]['profit'] && $val < $this->rateArr[40]['profit']) {
            $rate = $this->rateArr[35]['rate'];
        } elseif ($val >= $this->rateArr[40]['profit'] && $val < $this->rateArr[45]['profit']) {
            $rate = $this->rateArr[40]['rate'];
        } elseif ($val >= $this->rateArr[45]['profit'] && $val < $this->rateArr[50]['profit']) {
            $rate = $this->rateArr[45]['rate'];
        } elseif ($val >= $this->rateArr[50]['profit'] && $val < $this->rateArr[55]['profit']){
            $rate = $this->rateArr[50]['rate'];
        } elseif ($val >= $this->rateArr[55]['profit'] && $val < $this->rateArr[60]['profit']) {
            $rate = $this->rateArr[55]['rate'];
        } elseif ($val >= $this->rateArr[60]['profit'] && $val < $this->rateArr[65]['profit']) {
            $rate = $this->rateArr[60]['rate'];
        } elseif ($val >= $this->rateArr[65]['profit']) {
            $rate = $this->rateArr[65]['rate'];
        }
        //echo $rate;
        return $rate;
        //echo $rate;
        return $rate;
    }


    //Рассчитываем зарплату каждого менеджера Внешняя функция
    private function return_wage_personal($user_id) {
        $revenue_forecast = $this -> val($user_id);
        $rate = $this -> make_wage_rate();
        $percent = $this->percent($user_id);
        $bonus = $this -> get_adm_bonus($user_id);
        $forecast = round($revenue_forecast * $rate * $percent + $bonus, 0);
        //p($forecast);
        return $forecast;
    }

    //Here we are getting bonuses from bonus table
    private function get_adm_bonus($rate,$user_id,$total) {
        $m = $this -> db();
        $q = "SELECT * FROM adm_bonus WHERE manager = ? AND bonus_id != 4 ";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);

        $sum = 0;
        foreach ($data as $d) {
            if ($rate <= $this->point AND $d['breakeven_point'] == 0) {
                continue;
            } else {
                $sum += $d['bonus_value'];
            }
        }
        //echo $sum . '<br>';
        if($user_id == 2){

             $sum = round($sum+$total*0.01);
         }
        return $sum;
    }

    private function percent($date,$user_id) {
        $total = $this->total($date);
        $m = $this -> db();
        $q = "SELECT val_manager as manager, SUM(`val_profit`) as profit
                    FROM      admin_val
                    WHERE DATE_FORMAT(`val_date`, '%Y-%m')   LIKE ?
                    AND `val_manager` = (SELECT user from userlist WHERE id = ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($date,$user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        $percent = round($data[0]['profit']/$total,3);
        return $percent;


    }

    private function total($date){
        $m = $this -> db();
        $q = "SELECT    val_manager as manager, SUM(`val_profit`) as profit
                    FROM admin_val
                    WHERE
                    DATE_FORMAT(`val_date`, '%Y-%m') =  ?";
        $t = $m -> prepare($q);
        $t -> execute(array($date));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $d = $data[0]['profit'];
        return $d;
    }

      private function profit($user_id) {
        $m = $this -> db();
        $q = "SELECT val_manager as manager, SUM(`val_profit`) as profit
                    FROM      admin_val
                    WHERE {$this->query}
                    AND `val_manager` = (SELECT user from userlist WHERE id = ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        $percent = $data[0]['profit'];

        return $percent;


    }
       private function rentability($date,$user_id) {

        $m = $this -> db();
        $q = "SELECT `val_manager`, AVG(`val_rent`) as rent
              FROM admin_val
              WHERE DATE_FORMAT(`val_date`, '%Y-%m')   LIKE ?
              AND `val_manager` = (SELECT user from userlist WHERE id = ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($date,$user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        $percent = round($data[0]['rent'],2);
        return $percent;

   }

       private function profit_by_month($user_id) {
        $m = $this -> db();
        $q = "SELECT val_manager as manager, DATE_FORMAT(val_date,'%Y-%m') as date, SUM(`val_profit`) as profit
                    FROM  admin_val
                    WHERE
                    DATE_FORMAT(`val_date`, '%Y%m') != DATE_FORMAT(CURDATE(), '%Y%m')
                    AND `val_manager` = (SELECT user from userlist WHERE id = ?)
                    GROUP BY MONTH(`val_date`)
                    ORDER BY val_date DESC
                    LIMIT 6";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        if($data = $t -> fetchAll(PDO::FETCH_ASSOC)){
        //p($data);
         foreach($data as $d){
             //p($d);
            $d['id'] = $user_id;
            $this->profit = $d['profit'];
            $d['total'] = $this->total($d['date']);
            $d['rent'] = $this->rentability($d['date'],$user_id);
            $d['rate'] = $this->make_wage_rate($d['date']);
            $d['dolya'] = $this->percent($d['date'], $user_id);
            $d['bonus'] = $this->get_adm_bonus($d['rate'], $user_id,$d['total']);
            $d['wage'] = round($d['profit'] * $d['rate']  + $d['bonus'], 0);
             $array[] = $d;
         }
         //p($array);
        return $array;
        }else{
            return FALSE;
        }

   }

}
