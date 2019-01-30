<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//echo $_SESSION['type'];
if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin') {
    header('location: /admin33338/');
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Weges.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/LinksPlan.php');

//$objlink = new LinksPlan;
//$links = $objlink->show_expired(); //Alert if there is expared links
//require __DIR__ . '/../../config.php';
$all = get_all_val_data();
//p($all);
$daily = val_get_total_daily();

$manag = val_get_manager('Olesya');
$month = val_get_total_monthly(); //Выбираем результаты каждый месяц все начиная с января 2015года
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
//p($scores);
$calls = $object1->get_all_calls();
$all_calls = $object1->calls_by_car();
$conversion_month = $object1->conversion_month();
$conversion = $object1->conversion();

$obj = new Weges;
$obj->demotivation_start_date = date("d");
$obj->val = $all[0]['total_profit'];
$wag = $obj->get_adm_all_managers();
//p($wag);


?>

<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php foreach($wages as $we) : ?>
          ['<?=$we['username']?>',     <?=$we['profit']/1000?>],
          <?php endforeach ?>
          
        ]);

        var options = {
          title: 'Выручка по сотрудникам за текущий месяц',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
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
    <!-- Прибыль по сотрудникам за весь период с ноября 2015 -->
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php foreach ($all_calls as $alcl) :?>
          <?php if($alcl['calls'] == FALSE) {continue;}?>
          ['<?=$alcl['title']?>',     <?=$alcl['calls'] ?>],
          <?php endforeach ?>
        ]);

        var options = {
          title: 'Количество звонков по машинам за текущий месяц'
        };

        var chart = new google.visualization.PieChart(document.getElementById('revenue_year'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php foreach ($manager_profit as $man_proft) :?>
          <?php if($man_proft['val_manager'] == FALSE) {continue;}?>
          ['<?=$man_proft['val_manager']?>',     <?=$man_proft['summa'] / 1000?>],
          <?php endforeach ?>
        ]);

        var options = {
          title: 'Валовая прибыль по сотрудникам с 1 ноября 2015'
        };

        var chart = new google.visualization.PieChart(document.getElementById('profit_year'));

        chart.draw(data, options);
      }
    </script>
 
    <!-- Pe chart revenue per manager -->
<div class="container-fluid">
    <?php
 foreach ($wag as $mkey => $mvalue):
    $user_id = $mvalue['id'];
    $per = $obj->manager($user_id);
    $obj->data = array('month'=>date('Y-m-d'), 'user_id'=>$user_id, 'plan_name'=> 'plan');
    $plan_porter = $obj->get_percents();
    $obj->data = array('month'=>date('Y-m-d'), 'user_id'=>$user_id, 'plan_name'=> 'plan2');
    $plan_no_porter = $obj->get_percents();

 ?>   
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
            <table class="table table-bordered adm-level cl1">
                <caption class="text-left"><?=$mvalue['username']?></caption>
                <thead>
                    <tr>
                        
                        <th>Машины</th>           
                        <th>План</th>
                        <th>Прибыли сделано</th>
                        <th>Прогноз прибыли</th>
                        <th>Выполнено фактически</th>
                        <th>Прогноз выполнения плана</th>
                        <th>Прогноз мотивации %</th>
                        <th>Прогноз мотивации руб</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Портеры</td>
                        
                        <td><span class='plan'><?=number_format($per['plan'])?> руб</span></td>
                        <td><?=number_format($per['profit_porter'])?> руб</td>
                        <td><?=number_format($per['personal_forecast_porter'])?> руб</td>
                        <td><?=@round($per['profit_porter']/$per['plan']*100)?>%</td>
                        <td><?=round($per['rate_porter']*100)?>%</td>
                        <td><?=$per['bonus_rate_porter']?>%</td>
                        <td><?=number_format($per['motiv_porter'])?> руб</td>
                        
                    </tr>
                    <tr>
                        <td>НЕ Портер</td>
                        <td><span class='plan'><?=number_format($per['plan2'])?> руб</span></td>
                        <td><?=number_format($per['profit_no_porter'])?> руб</td>
                        <td><?=number_format($per['personal_forecast_no_porter'])?> руб</td>
                        <td><?=@round($per['profit_no_porter']/$per['plan2']*100)?>%</td>
                        <td><?=round($per['rate_no_porter']*100,2)?>%</td>
                        <td><?=$per['bonus_rate_no_porter']?>%</td>
                        <td><?=number_format($per['motiv_no_porter'])?> руб</td>
                        
                    </tr>
                    
                </tbody>
            </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="table-responsive">
            <table class="table table-bordered adm-level cl1">
                <caption class="text-left">Прогноз зарплаты на текущий месяц</caption>
                <thead>
                    <tr>           
                        <th>Оклад</th>
                        <th>Рассчет</th>
                        <th>Прогноз Зарплаты</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=number_format($per['bonus'])?> руб</td>
                        <td><?=number_format($per['bonus'])?>+<?=number_format($per['motiv_porter'])?>+<?=number_format($per['motiv_no_porter'])?></td>
                        <td><?=number_format($per['bonus']+$per['motiv_porter']+$per['motiv_no_porter'])?> руб</td>
                        
                    </tr>
                    
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <?php endforeach?>
    <div class="row">
        <div class="col-md-12 hidden-xs">
            <div class="table-responsive">
            <table class="table table-bordered adm-level">
                <caption class="text-left">KPI текущего месяца</caption>
                <thead>
                    <tr>
                        <th>Менеджер</th>
                        <?php foreach($scores[1]['scores'] as $sc):?>
                        <th><?=$sc['score_name']?></th>
                        <?php endforeach?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($scores as $ud):?>
                    <tr>
                        <td><?=$ud['username']?></td>
                        <?php foreach($ud['scores'] as $w):?>
                        <td><?=round($w['avg_score'],3)?></td>
                        <?php endforeach ?>
                    </tr>
                   <?php endforeach ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="row"><!-- Big row -->
        <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Показатели эффективности сотрудников текущий месяц</div>
                            <div class="panel-body">
                                <div id="piechart_3d" style="width: 100%; height: 100%; max-height: 600px"></div>            
                            </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Выручка по сотрудникам за год</div>
                            <div class="panel-body">
                                <div id="revenue_year" style="width: 100%; height: 100%; max-height: 600px"></div>            
                            </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Прибыль по сотрудникам за год</div>
                            <div class="panel-body">
                                <div id="profit_year" style="width: 100%; height: 100%; max-height: 600px"></div>            
                            </div>
                    </div>
                </div>
    </div> <!-- Big row end -->
    <div class="row">
        <div class="col-md-6 hidden-xs">
            <div class="table-responsive">
            <table class="table table-bordered adm-level">
                <caption class="text-left">Конверсия за текущий месяц</caption>
                <thead>
                    <tr>
                        <th>Машина</th>
                        <th>Звонков</th>
                        <th>Продаж</th>
                        <th>Конверсия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($conversion_month as $convm):?>
                    <tr>
                        <td><?=$convm['title']?></td>
                        <td><?=$convm['calls']?></td>
                        <td><?=$convm['sales']?></td>
                        <td><?=$convm['conversion']?></td>
                    </tr>
                   <?php endforeach ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="col-md-6 hidden-xs">
            <div class="table-responsive">
            <table class="table table-bordered adm-level">
                <caption class="text-left">Конверсия c 1 апреля 2016</caption>
                <thead>
                    <tr>
                        <th>Машина</th>
                        <th>Звонков</th>
                        <th>Продаж</th>
                        <th>Конверсия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($conversion as $conv):?>
                    
                    <tr>
                        <td><?=$conv['title']?></td>
                        <td><?=$conv['calls']?></td>
                        <td><?=$conv['sales']?></td>
                        <td><?=$conv['conversion']?></td>
                        
                    </tr>
                   <?php endforeach ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 hidden-xs">
            <div class="table-responsive">
                <?php foreach($calls as $ca):?>
                    <div class="col-md-3">
            <table class="table table-bordered adm-level">
                <caption class="text-left">Конверсия <?=$ca['username']?></caption>
                <thead>
                    <tr>
                        <th>Машина</th>
                        <th>Звонков</th>
                        <th>Продаж</th>
                        <th>Конверсия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ca['calls'] as $cal):?>
                    <tr>
                        <td><?=$cal['title']?></td>                        
                        <td><?=$cal['calls']?></td>
                        <td><?=$cal['sales']?></td>
                        <td><?=round($cal['sales']/$cal['calls'],2)?></td>
                    </tr>
                   <?php endforeach ?>
                </tbody>
            </table>
            </div>
           <?php endforeach ?> 
            </div>
        </div>
    </div>
</div>
</body>
</html>





