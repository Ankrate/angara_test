<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');

//print_r($_GET);
class AjaxWage extends MyDb {
    public $total;
    public function result(){
        //$_GET= json_encode($_GET);
        $total = $_GET['total'];
        $user_id = $_GET['id'];
        $dolya = $_GET['dolya'];
        $rate = $this->make_wage_rate($total);
        $bonus = $this->get_adm_bonus($rate, $total, $user_id);
        $forecast['wage'] = number_format($total*1000*$rate+$bonus);
        $forecast['rate'] = $rate;
        $forecast['bonus'] = $bonus;
        $forecast['dolya'] = $dolya;
        $forecast['id'] = $user_id;
        $forecast['profit'] = number_format($total*1000);
       
        echo json_encode($forecast);
        
        
    } 
    
    private function make_wage_rate($total) {
        $val = $total*1000;
        $this->k = $this->koeff();
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
    }
     private function get_adm_bonus($rate,$total,$user_id) {
        $m = $this -> db();
        $q = "SELECT * FROM adm_bonus WHERE manager = ? ";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p( $data);
        
        $sum = 0;
        foreach ($data as $d) {
            
                $sum += $d['bonus_value'];
            
        }
        //echo $sum . '<br>';
        if($user_id == 2){
            
             $sum = round($sum+$total*1000*0.01);
         }
        if($total >= $this->personal_plan($user_id)){
            $sum = $sum + $this->premia;
        }else{
            $sum = $sum - $this->premia;
        }
        return $sum;
    }
      private function personal_plan($user_id){
        $m = $this -> db();
        $q = "SELECT * FROM `adm_plans` WHERE MONTH(date) = MONTH(CURDATE()) AND manager_id = ?";
        $t = $m -> prepare($q);
        $t -> execute(array($user_id));
        $data = $t -> fetchAll(PDO::FETCH_ASSOC);
        //p($data[0]['plan']);
        return $data[0]['plan']/1000;
        
    }

}


/* Send as JSON */
     
$o = new AjaxWage;
$o->result();
