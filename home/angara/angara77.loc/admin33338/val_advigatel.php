<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
//echo $_SESSION['type'];
if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'advigatel_head') {
    header('location: /admin33338/');
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/CompaniesData.php');



$objCompany = new CompaniesData;
$objCompany->table = 'adm_companies_budget_value';
$objCompany->table2 = 'adm_companies_incom_value';
$objCompany->table3 = 'adm_companies_expens_value';
$dateBudget = date('Y-m-d');

$big_data = $objCompany->make_array(3);
//p($big_data);








?>

<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
    
    <script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

    
    
    <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Дата', 'Расходы', 'Маржа', 'План декабря'],
           <?php foreach ($big_data as $dat=>$m) :?>
          ['<?=$m['date']?>',  <?=$m['expenses']?>,<?=$m['real_margin']?>, 500000],
          
          <?php endforeach ?>
          
          
        ]);

        var options = {
          title: 'Расходы-Доходы',
          //curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chist'));

        chart.draw(data, options);
      }
    </script>
    
    
    <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Дата', 'Чистая Прибыль', 'Горизонт'],
           <?php foreach ($big_data as $m1) :?>
          ['<?=$m1['date']?>',  <?=$m1['real_profit']?>, 500000],
          
          <?php endforeach ?>
          
          
        ]);

        var options = {
          title: 'Рост чистой прибыли',
          //curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('quality'));

        chart.draw(data, options);
      }
    </script>
    
    
    
<div class="container-fluid">
        <!--Table for Advigatel-->
        
         <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered adm-level">
                    <caption class="text-left">ADvigatel</caption>
                        <thead>
                            <tr>
                                <th>Дата</th>
                                <th>План Расходов</th>
                                <th>План Маржи</th>
                                <th>План Чист Приб</th>
                                <th>План Денег в обороте</th>
                                <th> </th>
                                <th>Реально Расходов</th>
                                <th>Реально Маржи</th>
                                <th>Реально Денег в Обороте</th>
                                <th>Реально Прибыль</th>
                            </tr>
                        </thead>
                
                        <tbody>
                            <?php foreach($big_data as $b_adv):?>
                            <!-- <?php if(date('Y-m',strtotime($b_adv['date'])) == date('Y-m')){ echo 'val-green';}?> -->
                            <tr class="<?php if(date('Y-m',strtotime($b_adv['date'])) == date('Y-m')){ echo 'val-green';}?>">
                                <td><?=date('Y F',strtotime($b_adv['date']))?></td>
                                <td><?=number_format($b_adv['budget'])?></td>
                                <td><?=number_format($b_adv['margin'])?></td>
                                <td class="<?php if($b_adv['plan_profit'] < 0){echo'red';}?>"><?=number_format($b_adv['plan_profit'])?></td>
                                <td><?=number_format($b_adv['oborot'])?></td>
                                <td> </td>
                                <td><?=number_format($b_adv['expenses'])?></td>
                                <td><?=number_format($b_adv['real_margin'])?></td>
                                <td><?=number_format($b_adv['real_oborot'])?></td>
                                <td class="<?php if($b_adv['real_profit'] < 0){echo'red';}?>"><?=number_format($b_adv['real_profit'])?></td>
                            </tr>
                            <?php endforeach?>
                            
                        </tbody>
                    </table>
                    
        </div>
        </div> <!-- first row -->
   
   
    
        <!-- <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered adm-level">
                    <caption class="text-left">Основные показатели бизнеса</caption>
                        <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Выручка</th>
                                <th>Валовая прибыль</th>
                                <th>Рентабельность</th>
                                <th>Расходы всего</th>
                                <th>ФЗП</th>
                                <th>Чистая прибыль</th>
                                <th>Прибыль на сотрудника</th>
                                <th>Стоимость склада</th>
                                <th>Units склада</th>
                                <th>Обор-ть склада</th>
                                <th>Доля валовой прибыли</th>
                                <th>Доля чистой прибыли</th>
                                <th>Доля эксплуат. расходов</th>
                                <th>Доля ФЗП</th>
                                <th>К-во упр</th>
                                
                            </tr>
                        </thead>
                
                        <tbody>
                            <?php foreach($month as $mth):?>
                            <?php $exp = $object1->get_exp($mth['val_date']);
                            $exp = round($exp[0]['exp_value']);
                            $net_profit = $mth['val_profit'] - $exp;
                            $ware_cost = $object1->g_w($mth['val_date']);
                            $oborot_sklada = $mth['val_cost']/$ware_cost[0]['cost'];
                            $d_val = round($mth['val_profit']/$mth['val_cost'],3);
                            $d_chist = round($net_profit/$mth['val_cost'],3);
                            $d_office = $object1->g_office($mth['val_date']);
                            $d_expen = round($d_office[0]['office']/$mth['val_cost'],3);
                            $fzp = $object1->g_fzp($mth['val_date']);
                            $d_fzp = round($fzp[0]['fzp'] / $mth['val_cost'],3);
                            $people = $object1->g_people();
                            $d_people = number_format(round($mth['val_profit']/$people));
                            $quality = $oborot_sklada*$ware_cost[0]['cost']*(1+$d_chist)/$d_fzp/$d_expen/1000000;
                            $d_array[$mth['val_date']] =array('quality'=>$quality,'chist'=>$d_chist); 
                            ?>
                            
                            <tr>
                                <td><?=date('Y F',strtotime($mth['val_date']))?></td>
                                <td><?=number_format($mth['val_cost'])?></td>
                                <td><?=number_format($mth['val_profit'])?></td>
                                <td><?=round($mth['val_rent'],2)?>%</td>
                                <td><?=number_format($exp)?></td>
                                <td><?=number_format(round($fzp[0]['fzp']))?></td>
                                <td class="<?=$object1->compare_class_red($net_profit,0)?>"><?=number_format($net_profit)?></td>
                                <td class="<?=$object1->compare_class_red($d_people,number_format(PROFIT_NORM_EMPLOYEE))?>"><?=$d_people?></td>
                                <td><?=number_format($ware_cost[0]['cost'])?></td>
                                <td><?=number_format($ware_cost[0]['unit'])?></td>
                                <td><?=round($oborot_sklada,2)?></td>
                                <td><?=$d_val?></td>
                                <td><?=$d_chist?></td>
                                <td><?=$d_expen?></td>
                                <td><?=$d_fzp?></td>
                                <td><?=round($quality)?></td>
                                
                            </tr>
                            <?php endforeach?>
                            
                        </tbody>
                    </table>
                    
        </div>
        </div>  --><!-- first row -->
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                            <div class="panel-heading">Качество управления</div>
                        <div class="panel-body">
                            <div id="quality" style="width: 100%; height: 100%; max-height: 500px"></div>
                        </div>
                    </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                            <div class="panel-heading">Расходы-Доходы</div>
                        <div class="panel-body">
                            <div id="chist" style="width: 100%; height: 100%; max-height: 500px"></div>
                        </div>
                    </div>
            </div>
        </div>
        <div id="chart_div" style="width: 400px; height: 120px;"></div>
   
    </div>
</body>
</html>





