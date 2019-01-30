<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
//echo $_SESSION['type'];
if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin') {
    header('location: /admin33338/');
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Weges.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/LinksPlan.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/CompaniesData.php');

$obj = new LinksPlan;
$links = $obj->show_expired(); //Alert if there is expared links
//require __DIR__ . '/../../config.php';
$all = get_all_val_data();
//p($all);
$daily = val_get_total_daily();

$manag = val_get_manager('Olesya');
 //Выбираем результаты каждый месяц все начиная с января 2015года
$u = 1;
$today = val_get_today();
$ware = ware_get_today();
$ware_all = get_ware_all();
$cars_value = get_cars_value(); // Value of revenue by car
$viruchka = 0;
$valProf = 0;
$ck = get_adm_check_total();

$manager_profit = manager_perfomance('val_profit'); //выбираем показатели выручки и прибыли за весь период начиная с ноября 2015
$manager_cost = manager_perfomance('val_cost');
$total_profit_for_today = $all[0]['total_profit'];



$object1 = new Weges;

$object1->val = $all[0]['total_profit'];
$wages = $object1->get_adm_all_managers();
$revenue_forecast = $object1->revenue_forecast();

$plan = $object1->select_plan(); // Общий план на компанию

//p($wages);
$scores = $object1->get_all_scores();
$calls = $object1->get_all_calls();
$all_calls = $object1->calls_by_car();
$conversion_month = $object1->conversion_month();
$conversion = $object1->conversion();

//Показатели компании экономика
$month = $object1->val_get_total_monthly();

$db = new MyDb;
$chk_exp = $db->chk_date();
if($today[0]['cost'] == FALSE){
    $today[0]['cost'] = 1;
}

$objCompany = new CompaniesData;
$objCompany->table = 'adm_companies_budget_value';
$objCompany->table2 = 'adm_companies_incom_value';
$objCompany->table3 = 'adm_companies_expens_value';
$dateBudget = date('Y-m-d');

$big_data = $objCompany->make_array(3); // Data for Advigatel
$big_data1 = $objCompany->make_array(1); //Data for angara77
//p($budget_advigatel);

//section sallary

$obj = new Weges;
$obj->demotivation_start_date = date("d");
$obj->val = $all[0]['total_profit'];
$wag = $obj->get_adm_all_managers();
//p($big_data1);
$tb = $big_data1[0]['budget']/date('t');
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
          ['Дата', 'Продажи', 'Валовая прибыль', 'Точка безубыточности'],
           <?php foreach ($month as $m) :?>
          ['<?=$m['val_date']?>',  <?=($m['val_cost'])?>, <?=($m['val_profit'])?>, 900000],
          <?php $u++;?>
          <?php endforeach ?>
          
          
        ]);

        var options = {
          title: 'Показатели 2015 года',
          //curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Дата', 'Склад', 'Waterline'],
           <?php foreach ($ware_all as $w) :?>
          ['<?=$w['ware_date']?>',  <?=($w['ware_cost'])?>, 2500000],
          <?php $u++;?>
          <?php endforeach ?>
          
          
        ]);

        var options = {
          title: 'Стоимость склада за последние 3 месяца',
          //curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('warehouse'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php foreach ($cars_value as $carsv) :?>
          ['<?=$carsv['car']?>',     <?=$carsv['cost'] / 1000?>],
          <?php endforeach ?>
        ]);

        var options = {
          title: 'Выручка по машинам за 3 мес'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piecar'));

        chart.draw(data, options);
      }
    </script>
    
    
<div class="container-fluid">
    <div class="row adm-alert">
        <div class="col-md-12">
                <span class="badge badge-danger">Точка безубыточности: &nbsp; &nbsp;<span><?=$tb?></span></span>
                    <span class="badge badge-info" role="alert">Выручка: &nbsp; &nbsp;<span><?=number_format($today[0]['cost'])?></span> руб</span>
                    <span class="badge <?=compare_class($today[0]['profit'],$tb)?>" role="alert">Прибыль: &nbsp; &nbsp;<span><?=number_format($today[0]['profit'])?></span> руб</span>         
                    <span class="badge badge-info" role="alert">Рентабельность: &nbsp; &nbsp;<span><?=round($today[0]['profit']/$today[0]['cost'],3)*100?></span>%</span>
                    <span class="badge <?=compare_class($ware[0]['ware_cost'],2450000)?>" role="alert">Склад: &nbsp; &nbsp;<span><?=@number_format($ware[0]['ware_cost'])?></span> руб</span>
                    <span class="badge badge-info" role="alert">Средний чек:  &nbsp;<span><?=round(average($ck))?></span> руб</span>
                    <span class="badge <?=compare_class_red($revenue_forecast,$big_data1[0]['expenses'])?>" role="alert">Расходы: &nbsp; &nbsp;<span><?=number_format($big_data1[0]['expenses'])?></span> руб</span>
                    <span class="badge <?=compare_class_red($revenue_forecast,$plan)?>" role="alert">Прогноз: &nbsp; &nbsp;<span><?=@number_format($revenue_forecast)?></span> руб</span>
                    <span class="badge <?=compare_class_red($revenue_forecast,$plan)?>" role="alert">План: &nbsp; &nbsp;<span><?=@number_format($plan)?></span> руб</span>
                    
        </div>
    </div>
    <div class="row">
        
            <?php if(date("d") >= 25 AND date("d") < 26  ):?>
                <div class="col-md-2">
                       <a href="/admin33338/newuser/"><div class="alert alert-danger demotiv" role="alert">Пора делать мотивацию на следующий месяц </div></a>
                       </div>
                <?php endif?>
            
            
                    <?php if($links == TRUE):?>
                        <div class="col-md-2">
                       <a href="/admin33338/linksplan/"><div class="alert alert-danger demotiv" role="alert">Паника! Просроченные ссылки! <i class="fa fa-ambulance" aria-hidden="true"></i></div></a>
                       </div>
                <?php endif?>
            <?php if($chk_exp == TRUE):?>
                    <div class="col-md-2">
                       <a href="/admin33338/report/expenses.php"><div class="alert alert-danger demotiv" role="alert">Паника! Не записаны расходы за прошлый месяц! <i class="fa fa-money" aria-hidden="true"></i></i></div></a> 
                    </div>
                <?php endif?>
        </div>
        <!--Table for Angara77-->
        
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered adm-level">
                    <caption class="text-left">Angara77</caption>
                        <thead>
                            <tr>
                                <th>Дата</th>
                                <th>План Расходов</th>
                                <th>План Маржи</th>
                                <th>План Чист Приб</th>
                                <th>План Денег в обороте</th>
                                <th> </th>
                                <th>Реально Расходов</th>
                                <th>Прогноз Маржи</th>
                                <th>Реально Денег в Обороте</th>
                                <th>Прогноз Чист. Прибыли</th>
                            </tr>
                        </thead>
                
                        <tbody>
                            <?php foreach($big_data1 as $b_adv):?>
                                <?php $chist_profit = $revenue_forecast - $b_adv['expenses'];?>
                            <!-- <?php if(date('Y-m',strtotime($b_adv['date'])) == date('Y-m')){ echo 'val-green';}?> -->
                            <tr class="<?php if(date('Y-m',strtotime($b_adv['date'])) == date('Y-m')){ echo 'val-green';}?>">
                                <td><?=date('Y F',strtotime($b_adv['date']))?></td>
                                <td><?=number_format($b_adv['budget'])?></td>
                                <td><?=number_format($b_adv['margin'])?></td>
                                <td class="<?php if($b_adv['plan_profit'] < 0){echo'red';}?>"><?=number_format($b_adv['plan_profit'])?></td>
                                <td><?=number_format($b_adv['oborot'])?></td>
                                <td> </td>
                                <td><?=number_format($b_adv['expenses'])?></td>
                                <td><?=@number_format($revenue_forecast)?></td>
                                <td><?=@number_format($ware[0]['ware_cost'])?></td>
                                <td class="<?php if($chist_profit > 0){echo'green';}else{echo 'red';}?>"><b><?=@number_format($chist_profit)?></b></td>
                            </tr>
                            <?php endforeach?>
                            
                        </tbody>
                    </table>
                    
        </div>
        </div> <!-- Table angara77 -->
        
        
        <!--Table for advigatel-->
        
        <!--  <div class="row">
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
                            <?php if(date('Y-m',strtotime($b_adv['date'])) == date('Y-m')){ echo 'val-green';}?>
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
                                <td class="<?php if($b_adv['real_profit'] < 0){echo'red';}?>"><b><?=number_format($b_adv['real_profit'])?></b></td>
                            </tr>
                            <?php endforeach?>
                            
                        </tbody>
                    </table>
                    
                 </div> -->
        </div> <!-- first row -->
   
   
    
        
        
            <div class="row">
                <div class="col-md-6">       
                    <div class="panel panel-primary">
                            <div class="panel-heading">Стоимость товаров на складах</div>
                        <div class="panel-body">
                            <div id="warehouse" style="width: 100%; height: 100%; max-height: 500px"></div>
                        </div>
                    </div>
                </div>
            
       <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Выручка по машинам за 3 мес</div>
                            <div class="panel-body">
                                <div id="piecar" style="width: 100%; height: 100%; max-height: 600px"></div>            
                            </div>
                   </div>
           </div>
    </div><!--row-->
 
    
    <div class="row">
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/admin33338/personal/index.php');?>
    </div>
        </div>
        <div id="chart_div" style="width: 400px; height: 120px;"></div>
   
    </div>


<!-- Показатели экономики -->
    
    <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Дата', 'Качество', 'Точка качества'],
           <?php foreach ($d_array as $dat=>$m) :?>
          ['<?=$dat?>',  <?=$m['quality']?>, 80],
          <?php $u++;?>
          <?php endforeach ?>
          
          
        ]);

        var options = {
          title: 'Качество управления',
          //curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('quality'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Дата', 'Коэффициент', 'Точка безубыточности'],
           <?php foreach ($d_array as $dat=>$m) :?>
          ['<?=$dat?>',  <?=$m['chist']?>, 0],
          <?php $u++;?>
          <?php endforeach ?>
          
          
        ]);

        var options = {
          title: 'Коэффициент чистой прибыли',
          //curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chist'));

        chart.draw(data, options);
      }
    </script>
</body>
</html>





