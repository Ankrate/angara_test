<?php
class CompaniesData extends MyDb {

    public $table;
    public $table2;
    public $table3;
    public $company_id;


    public function make_array($company_id){
        $cb = $this->companies_budget($company_id);
        $data = array();
        foreach($cb as $k=>$v){
            $tmp = $this->companies_incom($company_id, $v['date'],1);
            $tmp2 = $this->companies_incom($company_id, $v['date'],2);
            $expenses = $this->expenses_current($v['date'], $company_id);
            $incom_current_m = $this->companies_incom_current();
            $incom_current_o = $this->companies_incom_current($company_id, $v['date'], 2);
            //p($incom_current_m);
            $v['budget'] = $this->getFzpBudget() + $v['budget'];
            @$v['margin'] = $tmp[0]['value'];
            @$v['oborot'] = $tmp2[0]['value'];
            $v['expenses'] = $expenses[0]['sum_exp'];
            $v['plan_profit'] = $v['margin'] - $v['budget'];
            $v['real_margin'] = @$incom_current_m[0]['profit'];
            $v['real_oborot'] = @$incom_current_m[0]['cost'];
            $v['real_profit'] = $v['real_margin'] - $v['expenses'];
            $data[] = $v;
        }
        if($data){
        return $data;
        }else{
            return 1;
        }
    }

    //Вытягиваем данные по фзп на этот месяца
    private function getFzpBudget(){
      $m = db();
      $q = "SELECT SUM(bonus_value) as value FROM `adm_bonus` WHERE bonus_id = 4";
      $t = $m -> prepare($q);
      $t -> execute();
      $data = $t -> fetchAll(PDO::FETCH_ASSOC);
      return $data[0]['value'];
    }


    private function companies_budget($company_id) {
        $m = $this -> db();
        if($company_id == 3){
        $q = "SELECT date, SUM(value) as budget FROM {$this->table} WHERE company_id = ? AND date BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 MONTH) AND CURDATE() GROUP BY MONTH(date) ORDER BY date DESC";
        $t = $m -> prepare($q);
        $t -> execute(array( $company_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);

        return $data;
        }elseif($company_id == 1){
            $q = "SELECT date, SUM(value) as budget FROM {$this->table} WHERE   company_id = ? AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
        $t = $m -> prepare($q);
        $t -> execute(array( $company_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);

        return $data;
        }
    }

   private function companies_incom($company_id, $date,$id) {
        $m = $this -> db();
        $q = "SELECT * FROM {$this->table2} WHERE company_id = ? AND EXTRACT(year_month FROM date) = EXTRACT(year_month FROM ?) AND name_id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array( $company_id, $date, $id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);

        return $data;
    }
   private function companies_incom_current () {
        $date = date('Y-m-1');
        $m = $this -> db();
        $q = "SELECT SUM(val_profit) as profit, SUM(val_cost) as cost FROM admin_val WHERE val_date BETWEEN DATE(?) AND CURDATE() ";
        $t = $m -> prepare($q);
        $t -> execute(array($date));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);

        return $data;
    }


   private function expenses_current($date,$company_id) {
        $m = $this -> db();
        $q = "SELECT  SUM(`value`) as sum_exp
                    FROM      {$this->table3}
                    WHERE EXTRACT(year_month FROM date) = EXTRACT(year_month FROM ?)
                    AND company_id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($date,$company_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data);
        return $data;

    }

}
