<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['name'])) {
    if($_SESSION['user'] != 'Olesya' OR $_SESSION['user'] != 'admin'){
        header('location: /admin33338/');
    }
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/ExpencesInsert.php');


//p($_POST);
//p($_GET);
$obj = new ExpencesInsert;
$cur_date = date('Y-m-d');

if(isset($_POST['month-pick']) AND !empty($_POST['month-pick'])){
$_SESSION['selected_month'] = $_POST['month-pick'];
    $year_month = date('Y-m', strtotime($_SESSION['selected_month']));
    $_GET['month-pick'] = $year_month;
//p($_SESSION['selected_month'] . '  session_post');

}elseif(isset($_GET['month-pick']) AND !empty($_GET['month-pick'])){
    $_SESSION['selected_month'] = $_GET['month-pick'];
    $year_month = date('Y-m', strtotime($_SESSION['selected_month']));
//    p($_SESSION['selected_month'] . '  session get');
    
}else{
    $year_month = date('Y-m');
}

//echo $year_month;
$year_month_day = $year_month . '-01';

if($_GET['action'] == 'exp_edit' OR @$_POST['action'] == 'exp_edit'){
    $obj->company_id = $_GET['com_id'];
    $company = $obj->company_select();
    $obj->table = 'adm_companies_expens_value';
    $fields = $obj->fields();
    $fields2 = $obj->fields_inc2();
    //p($company);
    //p($fields2);
}

if(@$_GET['action'] == 'insertdayexp' OR @$_POST['action'] == 'insertdayexp'){
    $obj->data = $_POST;
    if($obj->budget_work()){
        //echo $year_month;
    header('Location:/admin33338/insert/expences_insert.php?action=exp_edit&com_id='. $obj->company_id  . '&month-pick=' .  $year_month);
    //echo 'good';
    }
}elseif(@$_POST['action'] == 'insertincom'){
        $obj2->company_id = $_GET['com_id'];
        $obj2 -> table = 'adm_companies_incom_value';
        $obj2->data = $_POST;
        if($obj2->budget_work()){
            header('Location:/admin33338/insert/finance_insert.php?action=budget_edit&com_id='. $obj->company_id );
        }
    
}elseif(@$_POST['action'] == 'insertmargin'){
    $obj3 = new ExpencesInsert;
    $obj3->company_id = $_GET['com_id'];
    $obj3->table = 'adm_companies_incom_value_real';
    $obj3->data = $_POST;
    if($obj3->budget_work()){
            header('Location:/admin33338/insert/expences_insert.php?action=exp_edit&com_id='. $obj->company_id);
        }
}elseif((@$_POST['action'] == 'ballance')){
    $obj->insert_ballance($_POST);
    header('Location:/admin33338/insert/expences_insert.php?action=exp_edit&com_id='. $obj->company_id);
}
//p($_POST);
//p($obj2->data);
//$obj->data = $_POST;
//$obj->rebuild_array();
//p($user);
//$data = $obj->get_data();
//p($plan);
$sum_month = $obj->SumByMonth($year_month_day);
$sum_zp = $obj->SumFzpByMonth($year_month_day);
$show_ballance = $obj->get_ballance();
//p($show_ballance);

$date = date('Y-m-d H:i:s');
$total_sum = 0;
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
        
    
        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">
            <?php if($_GET['action'] == 'exp_edit'):?>
            
                   
                       <form action="" method="post">
                           <div class="row padding-10">
                               <div class="col-md-1 padding-10"><h6>Текущий месяц: <?=$obj->rus_month($year_month . '-01') ?></h6>
                                   </div>
                           <div class="col-md-3">
                               <div class="input-group mb-3">
                                  <input type="date" class="form-control" aria-describedby="basic-addon2" name="month-pick" value="<?=$year_month_day?>">
                                  <div class="input-group-append">
                                    <button class="btn btn-outline-success" type="submit">Выбрать</button>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-2 pdg"><span>Расходы текущие: </span><?=number_format($sum_month['summa'])?></div>
                              <div class="col-md-2 pdg"><span>Зарплата: <?=number_format($sum_zp['summa'])?></span></div>
                              <div class="col-md-2 pdg"><span>Все затраты: <?=number_format($sum_zp['summa'] + $sum_month['summa'])?></span></div>
                           </div>
                           </form>
                           <div class="row" style="padding:0 0 10px 15px;">
                               
                               <div class="col-md-4">
                               <form class="form-inline" action="" method="post">
                              <div class="control-group">
                                
                              </div>
                              <div class="control-group">
                                
                                <div class="controls form-inline">
                                    <!-- <label for="inputKey">Долг поставщикам: </label> -->
                                    <input type="text" class="input-small form-control" placeholder="Долг поставщикам" id="inputKey" name="debt" value="<?=$show_ballance['debt']?>">
                                    <!-- <label for="inputValue">Деньги на счетах: </label> -->
                                    <input type="number" class="input-small form-control" placeholder="Деньги на счетах" id="inputValue" name="money" value="<?=$show_ballance['money']?>">
                                    <button class="btn btn-outline-success" type="submit">Записать</button>
                                    <input type="hidden"  name="action"  value="ballance">
                                </div>
                              </div>
                            </form>
                           </div>
                           <div class="col-md-2 pdg"><span>Дата записи: </span><?=$show_ballance['date']?></div>
                           <div class="col-md-2 pdg"><span>Долг поставщику: </span><?=number_format($show_ballance['debt'])?></div>
                           <div class="col-md-2 pdg"><span>Деньги на счетах: </span><?=number_format($show_ballance['money'])?></div>
                           <div class="col-md-2 pdg "><span>Балланс денег: </span><span class="badge badge-success"><?=number_format($show_ballance['money'] - $show_ballance['debt'])?> руб</span></div>  
                           </div>
                           <!-- <h6 class="text-left">Расходы Компании <?=$company[0]['name']?> за <?=$year_month?></h6> -->
                           <div class="wrapper">
                           <div class="table-responsive">
                           <form method="post" action="">
                            <table class="table table-bordered adm-level table-fixed">
                                <thead>
                                    <tr class="d-flex">
                                        <th scope="col" class="col-1">Дата</th>
                                        <?php foreach($fields as $sal):?>
                                        <th scope="col" class="col-1"><?=$sal['name']?></th>


                                        <?php endforeach?>
                                    </tr>
                                    <tr class="d-flex">
                                        <th scope="col" class="col-1">Сумма</th>
                                            <?php foreach($fields as $s):?>
                                            <?php
                                            //p($s);
                                            $obj->table_summ = 'adm_companies_expens_value';
                                            $month = $year_month . '-01';
                                            $summ = $obj->exp_summ_article($s['id'], $month, $obj->company_id);
                                            //p($summ);

                                            ?>
                                        <th scope="col" class="col-1"><?=number_format($summ[0]['summa'])?></th>

                                            <?php
                                            $total_sum += $summ[0]['summa']; ?>
                                            <?php endforeach?>

                                    </tr>
                            </thead>
                            <tbody> 
                                    <?php
                                        
                                        $days=cal_days_in_month(CAL_GREGORIAN,date('m', strtotime($year_month)), date('Y', strtotime($year_month)));
                                     for($i=1;$i<=$days;$i++):?>
                                        <tr>
                                        <td class="col-md-1"><?=$i?></td>
                                        <?php foreach($fields as $sal):?>
                                            <?php
                                            
                                            $date = $year_month . '-'.$i;
                                             $pla = $obj->get_exp($sal['id'],$date,$obj->company_id);
                                             //p($pla);
                                            
                                            if(!isset($pla[0]['id'])){
                                                $pla[0]['id'] = 0;
                                            }
                                            ?>
                                        <td class="col-md-1"><input type="text" class="form-control" name="ex_value[<?=$date?>][<?=$sal['id']?>][<?=@$pla[0]['id']?>][value]"   value="<?=number_format($pla[0]['value'])?>" placeholder="План в рублях"></td>
                                        <!-- <td><textarea wrap="soft" type="text" class="form-control " name="ex_value[<?=$date?>][<?=$sal['id']?>][<?=@$pla[0]['id']?>][description]" ><?php if (isset($pla[0]['description'])){echo $pla[0]['description'];}?></textarea></td> -->
                                            <?php endforeach?>
                                        </tr>
                                        <?php endfor?>
                            </tbody>
                        </table>
                                    <input type="hidden"  name="field_id"  value="<?=$sal['id']?>">
                                    <input type="hidden"  name="action"  value="insertdayexp">
                                    <input type="hidden"  name="date"  value="<?=$cur_date?>">
                                    <input type="hidden"  name="month-pick"  value="<?=$year_month?>">
                                    <input type="hidden"  name="company_id"  value="<?=$obj->company_id?>">
                                    <button type="submit" class="btn btn-outline-success">Сохранить</button>
                                    <span> </span>
                       </form>
                    </div>
                </div>
           <?php endif?>
        </div>
    </body>
</html>