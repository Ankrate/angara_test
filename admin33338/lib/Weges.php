<?php
class Weges extends MyDb
{
    public $val = '';
    private $profit;
    public $month;
    private $min_plan = 0.25;

    public function truncate($table) {
        $m = db();
        $truncate = "TRUNCATE TABLE {$table}";
        $t = $m -> prepare($truncate);
        $t -> execute();
    }

    public function get_all_managers()
    {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    //Function pick up managers
    public function get_adm_all_managers()
    {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        $sum = 0;

        foreach ($data as $d) {
            $this -> profit = $this -> profit($d['id']);
            $profit = $this -> profit($d['id']);
            $percent = $this -> percent($d['id']);
            $bonus = $this -> get_adm_bonus($d['id']);
            $rate = $this -> make_wage_rate();
            //$user_array = $this -> return_wage_personal($d['id'], $profit);
            $rent = $this -> rentability($d['id']);
            $plan = $this -> personal_plan_for_admin($d['id']);
            //$d['weges'] = $user_array;
            $d['percent'] = $percent;
            $d['bonus'] = $bonus;
            $d['rate'] = $rate;
            $d['profit'] = $profit;
            $d['rent'] = $rent;
            $d['plan'] = $plan['plan'];

            $array[] = $d;
        }

        //p($array);
        return $array;
    }

    public function manager($user_id)
    {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = 'manager' AND id= ?";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        $sum = 0;

        foreach ($data as $d) {
            $plan = $this -> personal_plan($d['id']);
            $profit = $this -> profit($user_id);
            $profit_porter = $this -> profit_porter($user_id);
            $profit_no_porter = $this -> profit_no_porter($user_id);
            $personal_forecast_porter = $this -> personal_forecast_porter($profit_porter);
            $personal_forecast_no_porter = $this -> personal_forecast_no_porter($profit_no_porter);
            $motiv_porter = $this -> percentage_rate($user_id, 'plan', $plan['plan'], $personal_forecast_porter);
            $motiv_no_porter = $this -> percentage_rate($user_id, 'plan2', $plan['plan2'], $personal_forecast_no_porter);
            $bonus = $this -> get_adm_bonus($user_id);
            $rent = $this -> rentability($user_id);

            $d['bonus'] = $bonus;
            $d['rate_porter'] = $motiv_porter['rate'];
            $d['rate_no_porter'] = $motiv_no_porter['rate'];
            $d['profit'] = $profit;
            $d['profit_porter'] = $profit_porter;
            $d['profit_no_porter'] = $profit_no_porter;
            $d['rent'] = $rent;
            $d['all_forecast'] = $this -> revenue_forecast();
            $d['personal_forecast_porter'] = $personal_forecast_porter;
            $d['personal_forecast_no_porter'] = $personal_forecast_no_porter;
            $d['plan'] = $plan['plan'];
            $d['plan2'] = $plan['plan2'];
            $d['motiv_porter'] = $motiv_porter['salary'];
            $d['motiv_no_porter'] = $motiv_no_porter['salary'];
            $d['bonus_rate_porter'] = $motiv_porter['bonus_rate'];
            $d['bonus_rate_no_porter'] = $motiv_no_porter['bonus_rate'];
            $d['oklad'] = $this -> get_adm_oklad($d['id']);
            $d['today_porter'] = $this -> today_porter($d['id']);
            $d['today_no_porter'] = $this -> today_no_porter($d['id']);

            $array = $d;
        }
        return $array;
    }

    //Функция расчета коэффициэнта зарплаты в зависимости от выручки
    private function make_wage_rate()
    {
        $val = $this -> personal_forecast_porter($this -> profit);
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
        //echo $rate;
        return $rate;
    }

    //Функция прогноза валовой прибыли за текущий месяц
    public function revenue_forecast()
    {
        $days = $this -> count_days();
        //var_dump($days);
        if ($days == 0) {
            $days = 1;
        }
        $day = date("t");
        //echo $days;
        if ($days > 25 and $days < $day) {
            $forecast = $this -> val / ($days) * $day;
        } elseif ($days < $day) {
            $forecast = ($this -> val / $days * ($day - 8)) + ($this -> val / $days * 0.54 * 8);
        } elseif ($days == $day) {
            $forecast = $this -> val / $days * $day + $this -> val / $days;
        }

        //echo $forecast . '<br>';
        return $forecast;
    }

    //Прогноз личной прибыли Портер
    private function personal_forecast_porter($profit)
    {
        $days = $this -> count_days();
        if ($days == 0) {
            $days = 1;
        }

        $day = date("t");
        if ($days > 25 and $days < $day) {
            $forecast = $profit / ($days) * $day;
        } elseif ($days < $day) {
            $forecast = ($profit / $days * ($day - 9)) + ($profit / $days * 0.54 * 9);
        } elseif ($days == $day) {
            $forecast = $profit / $days * $day + $profit / $days;
        }
        //echo $forecast . '<br>';
        return round($forecast);
    }

    //Прогноз личной прибыли Не Портер
    private function personal_forecast_no_porter($profit)
    {
        $days = $this -> count_days();
        if ($days == 0) {
            $days = 1;
        }
        $day = date("t");
        if ($days > 24 and $days < $day) {
            $forecast = $profit / ($days) * $day;
        } elseif ($days < $day) {
            $forecast = ($profit / $days * ($day - 9)) + ($profit / $days * 0.54 * 9);
        } elseif ($days == $day) {
            $forecast = $profit / $days * $day + $profit / $days;
        }
        return round($forecast);
    }

    //Функция определения количества дней с начала месяца

    private function count_days()
    {
        $first_day = strtotime(date('Y-m-00'));
        $today = strtotime(date('Y-m-d'));
        $time_diff = abs($today - $first_day);
        $days = intval($time_diff / 86400);
        return $days;
    }

    //Рассчитываем зарплату каждого менеджера Внешняя функция
    private function return_wage_personal($user_id)
    {
        $personal_forecast = $this -> personal_forecast($this -> profit);
        $rate = $this -> make_wage_rate();
        $percent = $this -> percent($user_id);
        $bonus = $this -> get_adm_bonus($user_id);
        $plan = $this -> personal_plan($user_id);
        if ($personal_forecast >= $plan) {
            $forecast = round($personal_forecast * $rate + $bonus + $this -> premia, 0);
        } else {
            $forecast = round($personal_forecast * $rate + $bonus - $this -> premia, 0);
        }
        //p($this->profit);
        return $forecast;
    }

    //Here we are getting bonuses from bonus table
    private function get_adm_bonus($user_id)
    {
        $m = $this -> db();
        $q = "SELECT * FROM adm_bonus WHERE manager = ? AND bonus_id != 4";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        $rate = $this -> make_wage_rate();
        $sum = 0;
        foreach ($data as $d) {
            if ($rate <= $this -> point and $d['breakeven_point'] == 0) {
                continue;
            } else {
                $sum += $d['bonus_value'];
            }
        }
        //echo $sum . '<br>';
        if ($user_id == 2) {
            $val = $this -> revenue_forecast();
            $sum = round($sum + $val * 0.01);
        }
        return $sum;
    }

    private function get_adm_oklad($user_id)
    {
        $m = $this -> db();
        $q = "SELECT * FROM adm_bonus WHERE manager = ? ";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        return $data;
    }

    private function percent($user_id)
    {
        $total = $this -> total();
        $m = $this -> db();
        $q = "SELECT val_manager as manager, SUM(`val_profit`) as profit
                    FROM      admin_val
                    WHERE ( val_date between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )
                    AND `val_manager` = (SELECT user from userlist WHERE id = ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        if ($total == 0) {
            $total = 1;
        }
        $percent = round($data[0]['profit'] / $total, 3);

        return $percent;
    }

    //Вытягиваем прибыль по портеру и не портеру на сегодня
    private function today_porter($user_id)
    {
        $total = $this -> total();
        $m = $this -> db();
        $q = "SELECT val_manager as manager, SUM(`val_profit`) as profit
                    FROM      admin_val
                    WHERE val_date = CURDATE()
                    AND val_car LIKE 'porter%'
                    AND `val_manager` = (SELECT user from userlist WHERE id = ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);

        return $data[0]['profit'];
    }

    private function today_no_porter($user_id)
    {
        $total = $this -> total();
        $m = $this -> db();
        $q = "SELECT val_manager as manager, SUM(`val_profit`) as profit
                    FROM      admin_val
                    WHERE val_date = CURDATE()
                    AND val_car NOT LIKE 'porter%'
                    AND `val_manager` = (SELECT user from userlist WHERE id = ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data[0]['profit'];
    }

    private function total()
    {
        $m = $this -> db();
        $q = "SELECT    val_manager as manager, SUM(`val_profit`) as profit
                    FROM      admin_val
                    WHERE (val_date between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW())";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $d = $data[0]['profit'];
        return $d;
    }

    private function profit($user_id)
    {
        $m = $this -> db();
        $q = "SELECT val_manager as manager, SUM(`val_profit`) as profit
                    FROM admin_val
                    WHERE ( val_date between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )
                    AND `val_manager` = (SELECT user from userlist WHERE id = ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        $percent = $data[0]['profit'];
        return $percent;
    }

    private function profit_porter($user_id)
    {
        $val_car = 'porter';
        $m = $this -> db();
        $q = "SELECT val_manager as manager, SUM(`val_profit`) as profit
                    FROM admin_val
                    WHERE ( val_date between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )
                    AND `val_manager` = (SELECT user from userlist WHERE id = ?) AND val_car LIKE ?";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id, '%' . $val_car . '%'));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        $percent = $data[0]['profit'];
        return $percent;
    }

    private function profit_no_porter($user_id)
    {
        $val_car = 'porter';
        $m = $this -> db();
        $q = "SELECT val_manager as manager, SUM(`val_profit`) as profit
                    FROM admin_val
                    WHERE ( val_date between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )
                    AND `val_manager` = (SELECT user from userlist WHERE id = ?) AND val_car NOT LIKE ?";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id, '%' . $val_car . '%'));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        $percent = $data[0]['profit'];
        return $percent;
    }

    private function rentability($user_id)
    {
        $m = $this -> db();
        $q = "SELECT `val_manager`, AVG(`val_rent`) as rent FROM admin_val WHERE
          ( val_date between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )
           AND `val_manager` = (SELECT user from userlist WHERE id = ?)";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        $percent = round($data[0]['rent'], 2);
        return $percent;
    }

    //Begginig second part of code new motivativation scheme start
    private $managerCount;
    private $planAll;
    private $planPerson;
    //Выбираем менеджеров активных
    private function count_managers()
    {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $t -> rowCount();
    }

    public function count_managers_all()
    {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $t -> rowCount() - 1;
    }

    public function get_mngs3()
    {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = ?";
        $t = $m -> prepare($q);
        $t -> execute(array('manager'));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function select_plan()
    {
        $mngs = $this -> get_mngs3();
        $m = $this -> db();
        $sum = 0;
        $sum2 = 0;
        foreach ($mngs as $mn) {
            $q = "SELECT plan, plan2 FROM `adm_plans` WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE()) and manager_id = ?";
            $t = $m -> prepare($q);
            $t -> execute(array($mn['id']));
            $data = $t -> fetchAll(PDO::FETCH_ASSOC);
            $sum += @$data[0]['plan'];
            $sum2 += @$data[0]['plan2'];
        }

        return $sum + $sum2;
    }

    private function personal_plan_for_admin($user_id)
    {
        $m = $this -> db();
        $q = "SELECT * FROM `adm_plans` WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE()) AND manager_id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return array('plan' => @$data[0]['plan'], 'plan2' => @$data[0]['plan2']);
    }

    public function personal_plan($user_id)
    {
        $m = $this -> db();
        $q = "SELECT * FROM `adm_plans` WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE()) AND manager_id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return array('plan' => @$data[0]['plan'], 'plan2' => @$data[0]['plan2']);
    }

    private function get_scores($user_id)
    {
        $m = $this -> db();
        $q = "SELECT a.score_id, AVG(IFNULL( a.score_val,0)) AS avg_score, b.score_name
                FROM report_executive a
                LEFT JOIN report_score b
                ON a.score_id = b.id
                WHERE (
                DATE
                BETWEEN DATE_FORMAT( NOW( ) ,  '%Y-%m-01' )
                AND NOW( )
                )
                AND a.manager_id = ?
                GROUP BY a.score_id";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    private function get_calls($user_id)
    {
        $m = $this -> db();
        $q = "SELECT a.manager_name, a.manager_id, SUM(a.calls) as calls, SUM(a.sales) as sales, a.car_id, b.title FROM report  as a
                LEFT JOIN ang_cars as b
                on a.car_id = b.id
                WHERE (
                DATE
                BETWEEN DATE_FORMAT( NOW( ) ,  '%Y-%m-01' )
                AND NOW( )
                )
                AND manager_id = ?
                GROUP BY car_id;";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function get_all_scores()
    {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        foreach ($data as $d) {
            $d['scores'] = $this -> get_scores($d['id']);
            //p($d['id']);
            $array[] = $d;
        }
        //p($array);
        return $array;
    }

    public function get_all_calls()
    {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        foreach ($data as $d) {
            $d['calls'] = $this -> get_calls($d['id']);
            //p($d['id']);
            $array[] = $d;
        }
        //p($array);
        return $array;
    }

    public function calls_by_car()
    {
        $m = $this -> db();
        $q = "SELECT SUM(a.calls) as calls, SUM(a.sales) as sales, a.car_id, b.title FROM report  as a
                LEFT JOIN ang_cars as b
                on a.car_id = b.id
                WHERE (
                DATE
                BETWEEN DATE_FORMAT( NOW( ) ,  '%Y-%m-01' )
                AND NOW( )
                )
                GROUP BY car_id
                ORDER BY calls DESC";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        // p($data);
        return $data;
    }

    public function calls_grafics($car_id)
    {
        $m = $this -> db();
        $q = "SELECT DATE_FORMAT(date,'%Y-%m-%d') as date, SUM(sales) as sales,SUM(calls) as calls FROM report WHERE date > now()-interval 3 month AND car_id = ? GROUP BY DATE_FORMAT(date,'%Y-%m-%d') ORDER BY date ";
        $t = $m -> prepare($q);
        $t -> execute(array($car_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        // p($data);
        return $data;
    }

    public function calls_total()
    {
        $m = $this -> db();
        $q = "SELECT DATE_FORMAT(date,'%Y-%m-%d') as date, SUM(sales) as sales,SUM(calls) as calls FROM report WHERE date > now()-interval 3 month GROUP BY DATE_FORMAT(date,'%Y-%m-%d') ORDER BY date ";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        // p($data);
        return $data;
    }

    public function select_all_cars()
    {
        $m = $this -> db();
        $q = "SELECT * FROM ang_cars WHERE calls_report = '1' ORDER BY sort";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        // p($data);
        return $data;
    }

    public function conversion_month()
    {
        $m = $this -> db();
        $q = "SELECT SUM(a.calls) as calls, SUM(a.sales) as sales, a.car_id, b.title FROM report  as a
                LEFT JOIN ang_cars as b
                on a.car_id = b.id
                WHERE (
                DATE
                BETWEEN DATE_FORMAT( NOW( ) ,  '%Y-%m-01' )
                AND NOW( )
                )
                GROUP BY car_id
                ORDER BY calls DESC";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $d) {
            if ($d['calls'] == false) {
                $d['calls'] = 1;
            }
            $d['conversion'] = round($d['sales'] / $d['calls'], 2);
            $array[] = $d;
        }
        return @$array;
    }

    public function conversion()
    {
        $m = $this -> db();
        $q = "SELECT SUM(a.calls) as calls, SUM(a.sales) as sales, a.car_id, b.title FROM report  as a
                LEFT JOIN ang_cars as b
                on a.car_id = b.id
                GROUP BY car_id
                ORDER BY calls DESC";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $d) {
            if ($d['calls'] == 0) {
                $d['calls'] == 1;
            }
            @$d['conversion'] = round($d['sales'] / $d['calls'], 2);
            $array[] = $d;
        }
        return $array;
    }

    //Показатели экономики компании

    public function val_get_total_monthly()
    {
        $m = $this -> db();
        //$q = "SELECT * FROM admin_val_month where YEAR(val_date) = YEAR(NOW()) and MONTH(val_date) < MONTH(NOW()) ORDER BY val_date";
        $q = "SELECT * FROM admin_val_month WHERE val_date != (SELECT MAX(val_date) FROM admin_val_month) ORDER BY val_date";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function get_exp($month)
    {
        $m = $this -> db();
        $q = "SELECT SUM(value) as exp_value FROM admin_val_month_expenditures WHERE DATE_FORMAT(date,'%Y-%m') = DATE_FORMAT(?,'%Y-%m')";
        $t = $m -> prepare($q);
        $t -> execute(array($month));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

// Получаем расходы на рекламу за прошлый месяц
//Mysql table
//adm_companies_expens_value
    public function g_w($month)
    {
        $m = $this -> db();
        $q = "SELECT max(ware_cost) as cost, ware_unit as unit, ware_date FROM `admin_warehouse` WHERE ware_date = LAST_DAY(?)";
        $t = $m -> prepare($q);
        $t -> execute(array($month));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function g_fzp($month)
    {
        $m = $this -> db();
        $q = "SELECT SUM(value) as fzp, date FROM `admin_val_month_expenditures` WHERE DATE_FORMAT(date,'%Y-%m') = DATE_FORMAT(?,'%Y-%m') AND (exp_id = 1 OR exp_id = 3)";
        $t = $m -> prepare($q);
        $t -> execute(array($month));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function g_office($month)
    {
        $m = $this -> db();
        $q = "SELECT SUM(value) as office, date FROM `admin_val_month_expenditures` WHERE DATE_FORMAT(date,'%Y-%m') = DATE_FORMAT(?,'%Y-%m') AND exp_id = 2";
        $t = $m -> prepare($q);
        $t -> execute(array($month));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function g_people($date)
    {
        $datenow = date('Y-m-d');
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE company_id = 1 AND fire_date >= ? AND hire_date <= ?";
        $t = $m -> prepare($q);
        $t -> execute(array($date, $date));
        $data = $t -> fetchAll(PDO::FETCH_NUM);
        $q = $t -> rowCount() - 1;
        //p($q);
        return $q;
    }

    public function compare_class_red($com1, $com2)
    {
        if ($com1 < $com2) {
            echo 'red';
        } else {
            echo 'green';
        }
    }

    //Эта функция выдергивает значение мотивации в процентах согласно прогноза выполнения плана

    public function percentage_rate($user_id, $plan_name_id, $plan, $profit)
    {
        $m = $this -> db();
        if (empty($date)) {
            $date = date("Y-m-d");
        }
        if ($plan == false) {
            $plan = 1;
        }
        $plan_do = $profit / $plan;

        if (($plan_do < $this -> min_plan) && ($this -> demotivation_start_date > 15)) {
            $result = $this -> demotivation;
            return array('salary' => $result, 'rate' => $plan_do, 'bonus_rate' => 0);
        } elseif ($plan_do >= $this -> min_plan and $plan_do < 1.4) {
            $from = $plan_do * 10 - 0.5;
            $to = $plan_do * 10 + 0.5;
            $q = "SELECT value FROM adm_stuff_percent_grade WHERE manager_id = ? AND plan_name_id = ? AND plan BETWEEN ? AND ? AND MONTH(date) = MONTH(?) AND YEAR(date) = YEAR(?)";
            $t = $m -> prepare($q);
            $t -> execute(array($user_id, $plan_name_id, $from, $to, $date, $date));
            $data = $t -> fetchAll(PDO::FETCH_ASSOC);
            //p($data);
            $result = $profit * $data[0]['value'] / 100;
            return array('salary' => $result, 'rate' => $plan_do, 'bonus_rate' => $data[0]['value']);
        } elseif ($plan_do > 1.4) {
            $from = 14;
            $to = 60;
            $q = "SELECT value FROM adm_stuff_percent_grade WHERE manager_id = ? AND plan_name_id = ? AND plan BETWEEN ? AND ? AND MONTH(date) = MONTH(?) AND YEAR(date) = YEAR(?)";
            $t = $m -> prepare($q);
            $t -> execute(array($user_id, $plan_name_id, $from, $to, $date, $date));
            $data = $t -> fetchAll(PDO::FETCH_ASSOC);
            $result = $profit * $data[0]['value'] / 100;
            return array('salary' => $result, 'rate' => $plan_do, 'bonus_rate' => $data[0]['value']);
        } elseif ($plan_do < $this -> min_plan) {
            $from = $plan_do * 10 - 0.5;
            $to = 5;
            $q = "SELECT value FROM adm_stuff_percent_grade WHERE manager_id = ? AND plan_name_id = ? AND plan BETWEEN ? AND ? AND MONTH(date) = MONTH(?) AND YEAR(date) = YEAR(?)";
            $t = $m -> prepare($q);
            $t -> execute(array($user_id, $plan_name_id, $from, $to, $date, $date));
            $data = $t -> fetchAll(PDO::FETCH_ASSOC);
            $result = $profit * $data[0]['value'] / 100;
            return array('salary' => $result, 'rate' => $plan_do, 'bonus_rate' => $data[0]['value']);
        }
    }

    public function get_percents()
    {
        $m = $this -> db();
        $percent = $this -> grade();
        foreach ($percent as $p) {
            $q = "SELECT * FROM adm_stuff_percent_grade WHERE DATE_FORMAT(date,'%Y-%m') = DATE_FORMAT(?,'%Y-%m') AND manager_id = ? AND plan_name_id = ? AND plan = ?";
            $t = $m -> prepare($q);
            $t -> execute(array($this -> data['month'], $this -> data['user_id'], $this -> data['plan_name'], $p['id']));
            if (!$da = $t -> fetchAll(PDO::FETCH_ASSOC)) {
                $da[0] = null;
            }
            $data[$p['name']] = array('p_id' => $p['id'], 'adat' => $da[0]);
        }
        return $data;
    }

    private function grade()
    {
        $m = $this -> db();
        $q = "SELECT * FROM adm_stuff_percenage_range";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);

        return $data;
    }

    public function get_salary_all()
    {
        $m = $this -> db();
        $q = "SELECT SUM(value) as summa FROM adm_personell_salary WHERE  extract(YEAR_MONTH FROM date) = extract(YEAR_MONTH FROM ?)";
        $t = $m -> prepare($q);
        $t -> execute(array(date('Y-m-d')));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function get_ballance()
    {
        $m = $this -> db();
        $q = "SELECT * FROM adm_companies_ballance WHERE id =(SELECT max(id) FROM adm_companies_ballance)";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data[0];
    }

    public function russian_month()
    {
        $date = explode(".", date("d.m.Y"));
        switch ($date[1]) {
            case 1:
                $m = 'Январь';
                break;
            case 2:
                $m = 'Феврал';
                break;
            case 3:
                $m = 'Март';
                break;
            case 4:
                $m = 'Апрель';
                break;
            case 5:
                $m = 'Май';
                break;
            case 6:
                $m = 'Июнь';
                break;
            case 7:
                $m = 'Июль';
                break;
            case 8:
                $m = 'Август';
                break;
            case 9:
                $m = 'Сентябрь';
                break;
            case 10:
                $m = 'Октябрь';
                break;
            case 11:
                $m = 'Ноябрь';
                break;
            case 12:
                $m = 'Декабрь';
                break;
        }
        return $m . ' ' . $date[2];
    }

    public function getUid($calls_date, $mng_id)
    {
        $m = $this -> db();
        $q = "SELECT DISTINCT score_uid,row_number FROM admin_mng_calls
        WHERE DATE(insert_date) = :insert_date  AND mng_id = :mng_id
        ";
        $t = $m -> prepare($q);
        $t -> execute(array(':insert_date' => $calls_date, ':mng_id' => $mng_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    //Функции для запуска крона каждый день
    public function ajaxData($calls_date, $mng_id)
    {
        $m = $this -> db();
        $make_array = $this -> getUid($calls_date, $mng_id);
        $data = [];
        foreach ($make_array as $k => $v) {
            $q = "SELECT a.insert_date as date, SUM(a.score) as ocenka, AVG(a.score) as srednee, b.score as deal, c.score as tel  FROM admin_mng_calls  a
        LEFT JOIN admin_mng_calls_deal  b
        ON a.score_uid = b.score_uid
        AND a.row_number = b.row_number
        LEFT JOIN admin_mng_calls_phone  c
        ON a.score_uid = c.score_uid
        AND a.row_number = c.row_number
        WHERE DATE(a.insert_date) = ? AND a.row_number = ? AND a.mng_id = ? AND a.score_uid = ?
        ";
            $t = $m -> prepare($q);
            $t -> execute(array(date('Y-m-d', strtotime($calls_date)), $v['row_number'], $mng_id, $v['score_uid']));
            //$data = $t -> fetchAll(PDO::FETCH_ASSOC);
            $data[] = $t -> fetchAll(PDO::FETCH_ASSOC);
        }

        if (!empty($data)) {
            return $data;
        } else {
            return false;
        }
    }

    private function doMath($calls_date, $mng_id)
    {
        $data = $this -> ajaxData($calls_date, $mng_id);
        if ($data) {
            $i = 0;
            $array = [];
            $score = 0;
            foreach ($data as $k => $v) {
                $i++;
                $calls = $i;
                $score += $v[0]['ocenka'];
            }
            $avg = round($score / $calls, 2);
            $array = ['mng_id' => $mng_id, 'avg_score' => $avg, 'calls' => $calls, 'date' => $v[0]['date']];
            return $array;
        }
    }

    public function insertCalls($calls_date)
    {

        $mngs = $this -> get_all_managers();
        foreach ($mngs as $k => $mng) {
            $data = $this -> doMath($calls_date, $mng['id']);
            if(!$data){
              continue;
            }
            $this -> callsInserter($data);
        }
    }

    private function callsInserter($array)
    {
        $m = $this -> db();
        $q = "INSERT INTO admin_mng_calls_dayly
        (mng_id,
        avg_score,
        calls,
        date)
        VALUES
        (
        :mng_id,
        :avg_score,
        :calls,
        :date
        )
        ";
        $t = $m -> prepare($q);
        $t -> execute(array(':date' => $array['date'], ':mng_id' => $array['mng_id'], ':calls' => $array['calls'], ':avg_score' => $array['avg_score']));
        //$data = $t -> fetchAll(PDO::FETCH_ASSOC);
    }

    private function ch($date, $mng_id)
    {
        $m = $this -> db();
        $q = "SELECT id FROM admin_mng_calls_dayly WHERE date = ? AND mng_id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($date, $mng_id));
        $count = $t -> rowCount();
        return $count;
    }
    public function getAllRecords()
    {
        $m = $this -> db();
        $q = "SELECT DISTINCT insert_date FROM admin_mng_calls";
        $t = $m -> prepare($q);
        $t -> execute(array());
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    //Конец функций для крона

    //Сравниваем данные за вчера и за сегодня
    public function val_get_date($date)
    {
        $m = db();
        $q = "SELECT SUM(val_cost) as cost, SUM(val_profit) as profit, ROUND(AVG(val_rent),2) as rent FROM admin_val where val_date = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($date));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function yesterdayProfit($tb)
    {
        $today = date('Y-m-d');
        $yesterday = date("Y-m-d", time() - 60 * 60 * 24);
        $today_fin =$this->val_get_date($today);
        $yesterday_fin = $this->val_get_date($yesterday);
        $diff_cost =  round(100 - $today_fin[0]['cost']*100/($yesterday_fin[0]['cost']));
        $diff_profit = round(($today_fin[0]['profit']-$tb)*100/$tb);
        $d = ['diff_cost' => $diff_cost,'diff_profit' => $diff_profit];
        return $d;
    }

    public function get_ware_3month()
    {
        $m = db();
        $q = "SELECT AVG(ware_cost) as ware_avg FROM admin_warehouse WHERE ware_date > DATE_SUB(now(), INTERVAL 3 MONTH)";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function get_ware_today()
    {
        $m = db();
        $q = "SELECT * FROM admin_warehouse WHERE ware_date = DATE(NOW())";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //var_dump($data);
        if ($data == null) {
            $q = "SELECT * FROM admin_warehouse WHERE ware_date = SUBDATE(CURDATE(),1)";
            $t = $m -> prepare($q);
            $t -> execute();
            return $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function getHappyness($numberOfMonth = 1)
    {
        $m = db();
        $q = "SELECT AVG(avg_score)  as avg_score, AVG(calls) as calls FROM admin_mng_calls_dayly_last WHERE date BETWEEN  DATE_SUB(now(), INTERVAL 1 MONTH) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
        $t = $m -> prepare($q);
        $t -> execute(array($numberOfMonth));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $qOld = "SELECT AVG(avg_score)  as avg_score, AVG(calls) as calls FROM admin_mng_calls_dayly_last WHERE date BETWEEN DATE_SUB(now(), INTERVAL 2 MONTH) AND DATE_SUB(now(), INTERVAL 1 MONTH)";
        $t = $m -> prepare($qOld);
        $t -> execute();
        $dataOld = $t -> fetchAll(PDO::FETCH_ASSOC);
        $array = ['avg_score_old' => $dataOld[0]['avg_score'], 'avg_score_last_month' => $data[0]['avg_score'], 'calls_old' => $dataOld[0]['calls'], 'calls_month' => $data[0]['calls']];
        return $array;
    }
    public function getCalls()
    {
        $m = db();
        $q = "SELECT SUM(calls) as calls, date FROM admin_mng_calls_dayly_last WHERE date BETWEEN  DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE()
    GROUP BY date
    ";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $qOld = "SELECT SUM(calls) as calls, date FROM admin_mng_calls_dayly_last WHERE date BETWEEN DATE_SUB(now(), INTERVAL 2 MONTH)  AND  DATE_SUB(now(), INTERVAL 1 MONTH)
    GROUP BY date";
        $t = $m -> prepare($qOld);
        $t -> execute();
        $dataOld = $t -> fetchAll(PDO::FETCH_ASSOC);
        $array = ['calls_yesterday' => $data, 'calls_month_ago' => $dataOld];
        return $array;
    }
    //Вытягиваем фонд заработной платы по всем сотрудникам
    public function getFzpBudget()
    {
        $m = db();
        $q = "SELECT SUM(bonus_value) as value FROM `adm_bonus` WHERE bonus_id = 4";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data[0];
    }
    //Количетсво продаж у каждого менеджера за определенный день
    private function getSalesQuatityMng($mng, $days)
    {
        $m = db();
        $q = "SELECT SUM(c) as sales FROM (
          SELECT COUNT(id) as c
          FROM
           `val_insert_sales_by_manager` WHERE manager = ? AND  date BETWEEN  DATE_SUB(CURDATE(), INTERVAL ? DAY) AND CURDATE() GROUP BY DATE(date)
         ) AS t";
        $t = $m -> prepare($q);
        $t -> execute(array($mng, $days));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data[0];
    }
    //Количество звонков  у каждого менеджера в день
    public function getCallsQuatityMng($mng_id, $days)
    {
        $m = db();
        $q = "SELECT SUM(calls) as calls, AVG(avg_score) as score FROM admin_mng_calls_dayly_last WHERE mng_id = ? AND date BETWEEN  DATE_SUB(CURDATE(), INTERVAL ? DAY) AND CURDATE()";
        $t = $m -> prepare($q);
        $t -> execute(array($mng_id, $days));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data[0];
    }
    //количество звонков за прошлый месяц по компании для вычисления отдачи рекламы
    private function getCallsQuatityRoi()
    {
        $m = db();
        $q = "SELECT SUM(calls) as calls FROM admin_mng_calls_dayly_last WHERE YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
        $t = $m -> prepare($q);
        $t -> execute(array());
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data[0]['calls'];
    }
// Расходы на рекламу в прошлом месяце
    private function getExpensesRoi()
{
    $m = db();
    $q = "SELECT SUM(value) as expenses FROM adm_companies_expens_value WHERE YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
AND MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND name_id IN (2,3,4)";
    $t = $m -> prepare($q);
    $t -> execute(array());
    $data = $t -> fetchAll(PDO::FETCH_ASSOC);
    return $data[0]['expenses'];
}

//Считаем рои

public function getRoi(){
  $calls = $this->getCallsQuatityRoi();
  $money = $this->getExpensesRoi();
  $cost = ceil($money/$calls);
  return array('calls' => $calls, 'money' => $money, 'cost' => $cost );
}

    //Считаем конверсию каждого менеджера за один день, передаем дату в метод

    public function getConversion($days)
    {
        $m = db();
        $q = "SELECT user,id FROM userlist WHERE enabled = '1' AND type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $d = [];
        foreach ($data as $dat) {
            $calls = $this->getCallsQuatityMng($dat['id'], $days);
            $sales = $this->getSalesQuatityMng($dat['user'], $days);
            //p($calls);
            if (!$calls['calls']) {
                continue;
            }
            $conversion = $sales['sales'] / $calls['calls'];
            $d[$dat['id']] = ['calls' => $calls['calls'], 'sales' => $sales['sales'], 'conversion' => $conversion ];
        }
        return $d;
    }
    public function conversionAllCompany($days)
    {
        $conv = $this->getConversion($days);
        $i = 0;
        $cl = 0;
        $cs = 0;
        $cc = 0;
        $conversion = [];
        foreach ($conv as $k=>$v) {
            $i++;

            $cl += $v['calls'];
            $cs += $v['sales'];

        }
        $cc = ($cs/$days)/($cl/$days);
        $calls_date = $this->getCallsDate();
        $sales_date = $this->getSalesDate();
        $conversion = ['calls' => $cl/$days, 'sales' => $cs/$days, 'conversion' => $cc, 'calls_date' => $calls_date, 'sales_date' => $sales_date];
        return $conversion;
    }
    //Проверяем дату звонков когда послендий раз заносили в табцу
    private function getCallsDate()
    {
        $m = db();
        $q = "SELECT MAX(date) as calls_date FROM admin_mng_calls_dayly_last LIMIT 1";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data[0]['calls_date'];
    }
    //Проверяем дату продаж в таблице
    private function getSalesDate()
    {
        $m = db();
        $q = "SELECT MAX(date) as sales_date FROM val_insert_sales_by_manager LIMIT 1";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data[0]['sales_date'];
    }

//Функции для вставки звонков в постоянную таблицу
public function callsInserterLast($date)
{
    $m = $this -> db();

    $qDelete = "DELETE FROM `admin_mng_calls_dayly_last` WHERE date > ?";
    $t = $m -> prepare($qDelete);
    $t->execute(array($date));

    $q = "INSERT INTO admin_mng_calls_dayly_last
    (mng_id,
    avg_score,
    calls,
    date)
    SELECT
    mng_id,
    avg_score,
    calls,
    date
    FROM admin_mng_calls_dayly
    WHERE date >?
    ";
    $t = $m -> prepare($q);
    $t -> execute(array($date));


    //удаляем старые оценки из самой первой таблицы

    //$dt = date('Y-m-d', strtotime('today - 32 days'));

    $qDelete2 = "DELETE FROM `admin_mng_calls` WHERE insert_date < ?";
    $t = $m -> prepare($qDelete2);
    $t->execute(array($date));


}






}
