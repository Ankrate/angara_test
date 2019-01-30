<?php
class MyDb {
    public $demotivation = 0;
    public $demotivation_start_date;
    public $premia = 2000;
    protected $k = 1;
    protected $val85 = 850000;
    protected $val95 = 950000;
    protected $val100 = 1000000;
    protected $val110 = 1100000;
    protected $val115 = 1150000;
    protected $val135 = 1350000;
    protected $val150 = 1500000;
    protected $val170 = 1700000;

    protected $rate1 = 0.06;
    protected $rate2 = 0.06;
    protected $rate3 = 0.07;
    protected $rate4 = 0.07;
    //protected $rate5 = 0.11;
    protected $rate5 = 0.08;
    protected $rate6 = 0.09;
    protected $rate7 = 0.11;
    protected $rate8 = 0.13;
    protected $point = 0.06;

    public $rateArr = array(25 => array('profit' => 250000, 'rate' => 0.05), 30 => array('profit' => 300000, 'rate' => 0.06), 35 => array('profit' => 350000, 'rate' => 0.07), 40 => array('profit' => 400000, 'rate' => 0.075), 45 => array('profit' => 450000, 'rate' => 0.08), 50 => array('profit' => 500000, 'rate' => 0.09), 55 => array('profit' => 550000, 'rate' => 0.095), 60 => array('profit' => 600000, 'rate' => 0.10), 65 => array('profit' => 650000, 'rate' => 0.105));

    protected function db() {

        try {
            $dsn = 'mysql:dbname=' . ANG_DBNAME . ';host=' . ANG_HOST;
            $pdo = new PDO($dsn, ANG_DBUSER, ANG_DBPASS);
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo -> exec("set names utf8");

        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
        return $pdo;
    }

    protected function p($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }//Конец функции

    //Если менеджеров больше трех к общей прибыли используется коэффициент к-во менеджеров/3
    public function get_managers() {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = 'manager'";
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_NUM);

        $q = $t -> rowCount();
        //p($q);
        return $q;
    }

    public $role;
    public $type;
    public function get_mngs() {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND type = ? AND role = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($this -> type, $this -> role));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function get_mngs2() {
        $m = $this -> db();
        $q = "SELECT username,id FROM userlist WHERE enabled = '1' AND role LIKE ?";
        $t = $m -> prepare($q);
        $t -> execute(array('%' . $this -> role . '%'));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;
    }

    public function koeff() {
        $raw = $this -> get_managers();
        if ($raw > 3) {
            $this -> k = $raw / 3;
        } else {
            $this -> k = 1;
        }
        //echo $this->k;
        return $this -> k;
    }

    protected function get_cars() {

        $m = db();
        $q = 'SELECT * FROM ang_cars';
        $t = $m -> prepare($q);
        $t -> execute();
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

    public function redirect() {
        if ($this -> type == 'editor') {
            $url = 'editors.php';
        } elseif ($this -> type == 'marketolog') {
            $url = 'editors.php';
        } elseif ($this -> type == 'admin') {
            $url = '';
        } elseif ($this -> type == 'manager') {
            $url = 'manager.php';
        } else {
            $url = '';
        }
        return $url;
    }

    //Функция проверяет есть ли расходы за текущий месяц, если нет и конец месяца, то алерт
    private function chk_expenses($month) {
        $m = $this -> db();
        $q = "SELECT * FROM admin_val_month_expenditures WHERE  DATE_FORMAT(date,'%Y-%m') = DATE_FORMAT(?,'%Y-%m')";
        $t = $m -> prepare($q);
        $t -> execute(array($month));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $count = $t -> rowCount();
        if ($count > 0) {
            return FALSE;
        } else {
            return TRUE;
        }

    }

    private function chk_table_year($month) {
        $m = $this -> db();
        $q = "SELECT * FROM admin_val_month_expenditures WHERE  DATE_FORMAT(date,'%Y-%m') = DATE_FORMAT(?,'%Y-%m')";
        $t = $m -> prepare($q);
        $t -> execute(array($month));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $d) {
            if ($d['value'] != 0) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function chk_date() {
        $start = $month = strtotime('2016-01-01');
        $end = strtotime('now - 1 month');
        while ($month < $end) {
            $chk = $this -> chk_expenses(date('Y-m-d', $month));
            $chk2 = $this -> chk_table_year(date('Y-m-d', $month));
            if ($chk == TRUE) {
                return TRUE;
            } elseif ($chk2 == TRUE) {
                return TRUE;
            }
            $month = strtotime("+1 month", $month);
        }
    }
    public function chk_tbl($table, $date) {
        $m = $this -> db();
        $q = "SELECT id FROM " . $table ." WHERE  DATE_FORMAT(date,'%Y-%m') = DATE_FORMAT(?,'%Y-%m')";
        $t = $m -> prepare($q);
        $t -> execute(array($date));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        $count = $t -> rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function rus_month($month) {
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
        return $date[2] .' '.$m. ' '. $date[0];
    }
//Возвращает только месяц и год
    public function rus_month_only($month) {
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
        return $m. ' '. $date[0];
    }


    //Метод проверки последней записи в таблице
    public function getLastDate($table, $dateColumn = 'date')
    {
        $m = db();
        $q = "SELECT MAX(?) as last_date FROM ". $table." LIMIT 1";
        $t = $m -> prepare($q);
        $t -> execute(array($dateColumn));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        return $data[0]['last_date'];
    }

}
