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
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/CompaniesData.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/interviews/InterviewClass.php');
$obj = new Weges;
$objCompany = new CompaniesData;
//Выводим показатели выручки на сегодня
$today = val_get_today();
//Вытягиваем точку безубыточности
$objCompany->table = 'adm_companies_budget_value';
$objCompany->table2 = 'adm_companies_incom_value';
$objCompany->table3 = 'adm_companies_expens_value';
$big_data = $objCompany->make_array(1); //Data for angara77
$tb = $big_data[0]['budget']/date('t');// Точка Джи на этот месяц
//p($big_data);
// Счтитаем проценты от точки Джи
$percent = $obj->yesterdayProfit($tb);
//Получаем Балланс на сегодня
$show_ballance = $obj->get_ballance();
//p($show_ballance);
//Средний склад за последние 3 месяца
$ware_avg3month = $obj->get_ware_3month()[0]['ware_avg'];
//Склад на сегодня
$ware_today = $obj->get_ware_today()[0]['ware_cost'];
//Получаем общюю среднюю оценку по всей компании массив из оценки за последний месяц и предыдущий
$happyness = $obj -> getHappyness(1);
//Вытягиваем звонки
$avg_calls = $obj->getCalls();
//Получаю примерное значение фонда заработной платы по всем сотрудникам
$fzp = $obj->getFzpBudget();
//Получаем план продаж на компанию
$plan = $obj->select_plan();
//Считаем работающий народ на сегодня
$count_managers = $obj->count_managers_all();
//Звонки и конверсию по менеджерам за посление х дней
$days = HOW_MANY_DAYS;
$conversion = $obj->getConversion($days);
//Общая конверсия по всей компании за посление х дней
$conversionAll = $obj-> conversionAllCompany($days);
//p($conversionAll);
//Выводим просроченные задачи
$taskObj = new InterviewClass;
$tasks = $taskObj -> get_tasks_expired2();
//Получаем количество звонков за прошлый месяц, стоимость рекламы, и рои
$roi = $obj->getRoi();
//p($roi);

?>

<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>


<div class="container-fluid bgc-grey-100">
  <div class="row">
          <!-- <div class="p-2 col-12 main-panel"> -->
              <!-- <div class="main-panel-main"> -->
                <div class="col-md-3 main-panel" >
                  <!-- <span class="dot dot-red"></span>
                  <span class="dot dot-yellow"></span>
                  <span class="dot dot-green"></span> -->
                  <div id="chart_gauge" style="width: 400px; height: 120px;"></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fas fa-chart-pie"></i> Маржа</span>
                  <div class="count green"><?=number_format($today[0]['profit'])?></div>
                  <?php if($percent['diff_profit'] > 0 ) {$color2 = 'green'; $percent_class2 = 'fa-long-arrow-alt-up';}else{$color2 = 'red'; $percent_class2 = 'fa-long-arrow-alt-down';}?>
                  <span class="count_bottom"><i class="<?=$color2?>"><i class="fas <?=$percent_class2?>"></i><?=$percent['diff_profit']?>% </i> From G point</span>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fas fa-balance-scale"></i> Балланс</span>
                  <?php
                    $ballance = $show_ballance['money'] - $show_ballance['debt'];
                    if($ballance > 0){$bcolor = 'green'; $bicon = 'fas fa-plus';}else{$bcolor = 'pink'; }
                   ?>
                  <div class="count <?=$bcolor?>"><i class="<?=$bicon?>" style="font-size: 1.1rem; vertical-align:middle;"></i> <?=number_format($ballance)?></div>
                  <span class="count_bottom"><i class="<?=$bcolor?>"><i class="far fa-clock"></i></i> <?=date('d M H:i', strtotime($show_ballance['date']))?></span>
                </div>
                <?php
                  $warehouse = $ware_today - $ware_avg3month;
                  if($warehouse > 0){$wcolor = 'green'; $wicon = 'fas fa-long-arrow-alt-up';}else{$wcolor = 'pink'; $wicon = 'fas fa-long-arrow-alt-down';}
                 ?>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fas fa-warehouse"></i> Склад</span>
                  <div class="count"><?=number_format($ware_today)?></div>
                  <span class="count_bottom <?=$wcolor?>"><i ><i class="<?=$wicon?>"></i></i><?=number_format(round($warehouse))?> </i> От среднего за 3 мес</span>
                </div>
                <?php
                  $newHappyness = round($happyness['avg_score_last_month'] - $happyness['avg_score_old'], 2);
                  if($newHappyness > 0){$wcolor = 'green'; $wicon = 'fas fa-long-arrow-alt-up';}else{$wcolor = 'pink'; $wicon = 'fas fa-long-arrow-alt-down';}
                 ?>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fas fa-smile"></i></i></i> Уровень счастья <span class="bold">10.0 max</span></span>
                  <div class="count"><?=round($happyness['avg_score_last_month'], 2)?></div>
                  <span class="count_bottom <?=$wcolor?>"><i><i class="<?=$wicon?>"></i><?=$newHappyness?> </i> От прошлого месяца</span>
                </div>
              <!-- </div> -->
              <!-- </div> -->
            </div>
            <?php if(!empty($tasks)): ?>
            <div class="row" style="background-color: #fff;">
              <!-- Выводим просроченные задачи -->
              <div class="col">
                  <?php foreach($tasks as $task):?>
                     <?php
                                  if(date('Y-m-d H:m',strtotime($task['task_timestamp'])) > date('Y-m-d H:m')){
                                              $task_background = 'task_background_green';
                                          }else{
                                              $task_background = 'task_background_red';
                                          }
                                     ?>
                          <div class="d-inline-flex p-2">
                          <div id="<?=$task['id']?>" class="card mycard-val <?=$task_background?> p-2" style="width: 12rem;">
                          <div><?=date('d F H:i', strtotime($task['task_timestamp']))?><a class="done-task" href="javascript:ajaxDone(<?=$task['id']?>,<?=$task['people_id']?>)"><span  class="float-md-right my-done" data-toggle="tooltip" data-placement="top" title="Завершить задачу"><i class="fas fa-check"></i></span></a></div>
                          <div><a href="/admin33338/interviews/people_edit.php?people_id=<?=$task['people_id']?>"><?=$task['name']?></a></div>
                          <div><?=$task['task_name'] ?><a href="/admin33338/interviews/edit_task_noajax.php?form_id=<?=$task['id']?>"><span  class="float-md-right"><i class="fas fa-pencil-alt"></i></span></a>
                          </div>
                          </div>
                          </div>
                  <?php endforeach ?>
              </div>
            </div>
          <?php endif ?>
            <div class="row">
              <div class="p-2 col-md-6 main-panel">
                  <div class="main-panel-next">
                    <h4 class="green"><a class="green hover-green" href="val2.php">Маркетинг</a></h4>
                    <div class="">Звонков: <span class="bold green"><?=$roi['calls']?></span></div>
                    <div class="">Денег на рекламу: <span class="bold green"><?=number_format($roi['money'])?></span></div>
                    <div class="">Стоимость звонка: <span class="bold green"><?=$roi['cost']?></span></div>
                    <div id="chart_div" style="width: 100%; height: 300px;"></div>
                  </div>
              </div>
               <div class="p-2 col-md-6 main-panel">
                   <div class="main-panel-next">
                     <h4 class="green"><a class="green hover-green" href="val2.php">Финансы</a></h4>
                     <div class="table-responsive">
                     <table class="table fin-table">
                           <thead>
                             <tr>
                               <th scope="col">Name</th>
                               <th scope="col">План</th>
                               <th scope="col">Прогноз</th>
                               <th scope="col">Факт</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <th scope="row">Маржа</th>
                               <td><?=number_format($plan)?></td>
                               <td><?=number_format($big_data[0]['real_margin']/date('d')*date('t'))?></td>
                               <td><?=number_format($big_data[0]['real_margin'])?></td>
                             </tr>
                             <tr>
                               <th scope="row">Расходы</th>
                               <td><?=number_format($big_data[0]['budget'])?></td>
                               <td><?=number_format($big_data[0]['expenses']/date('d')*date('t'))?></td>
                               <td><?=number_format($big_data[0]['expenses'])?></td>
                             </tr>
                             <tr>
                               <th scope="row">Деньги</th>
                               <td class="pink">-<?=number_format($show_ballance['debt'])?></td>
                               <td class="green">+<?=number_format($show_ballance['money'])?></td>
                               <td class="<?=$bcolor?>"><?=number_format($show_ballance['money'] - $show_ballance['debt'])?></td>
                             </tr>
                           </tbody>
                           </table>
                           </div>
                   </div>
               </div>
             </div>
       <div class="row">
         <div class="p-2 col-md-6 main-panel">
             <div class="main-panel-next">
               <h4 class="green">Продажи</h4>
               <div class=""> Среднее кол-во звонков в день за последние <?=$days?> дней <span class="bold green"><?=round($conversionAll['calls'],2)?></span></div>
               <div class="">Среднее кол-во продаж в день за последние <?=$days?> дней <span class="bold green"><?=round($conversionAll['sales'],2)?></span></div>
               <div class="">Средняя конверсия за последние <?=$days?> дней <span class="bold green"><?=round($conversionAll['conversion'],2)?></span></div>
               <div class="">Дата звонков <span class="bold green"><?=$conversionAll['calls_date']?></span></div>
               <div class="">Дата продаж <span class="bold green"><?=$conversionAll['sales_date']?></span></div>
               <div class=""></div>
             </div>
         </div>
          <div class="p-2 col-md-6 main-panel">
              <div class="main-panel-next">
                <h4 class="green">Генеральный Директор</h4>
                <div class="table-responsive">
                <table class="table fin-table">
                      <thead>
                        <tr>
                          <th scope="col">NAME</th>
                          <th scope="col">ФЗП</th>
                          <th scope="col">G SPOT</th>
                          <th scope="col">СОТРУДНИКОВ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">ЗНАЧЕНИЕ</th>
                          <td><?=number_format($fzp['value'])?></td>
                          <td><?=number_format($tb)?></td>
                          <td><?=$count_managers?></td>

                        </tr>
                      </tbody>
                      </table>
                      </div>

              </div>
          </div>
        </div>
        <div class="row">
          <div class="p-2 col-md-6 main-panel">
              <div class="main-panel-next">


              </div>
          </div>
          <div class="p-2 col-md-6 main-panel">
              <div class="main-panel-next">
                <?php
                  $calls = $happyness['calls_month'] - $happyness['calls_old'];
                  if($calls > 0){$wcolor = 'green'; $wicon = 'fas fa-long-arrow-alt-up';}else{$wcolor = 'pink'; $wicon = 'fas fa-long-arrow-alt-down';}
                 ?>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fas fa-phone"></i></i></i> Кол-во звонков в день на человека </span>
                  <div class="count"><?=round($happyness['calls_month'])?></div>
                  <span class="count_bottom <?=$wcolor?>"><i><i class="<?=$wicon?>"></i><?=$newHappyness?> </i> От прошлого месяца</span>
                </div>
                <div class="pink">fzp = <?=$fzp['value']?></div>
                <div class="pink"> Бюджет <?=$big_data[0]['budget']?></div>
                <div class="pink"> Расходы текущие<?=$big_data[0]['expenses']?></div>
                <div class="pink">Маржа на сегодня <?=$big_data[0]['real_margin']?></div>
                <div class="pink">Баланс на сегодня <?=$big_data[0]['real_profit']?></div>
                <div class="pink">Точка безубыточности <?=number_format($tb)?></div>
                <div class="pink">План продаж <?=number_format($plan)?></div>
                <div class="pink">Количество сотрудников <?=$count_managers?></div>
              </div>
          </div>
        </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['дата', '<?=date('M')?>', '<?=date('M', strtotime('-1 months'));?>'],


          <?php foreach($avg_calls['calls_yesterday'] as $ck => $cv):?>

          ['<?=$cv['date']?>',  <?=(!empty($cv['calls'])) ? $cv['calls'] : 2 ?>,      <?=(!empty($avg_calls['calls_month_ago'][$ck]['calls'])) ? $avg_calls['calls_month_ago'][$ck]['calls'] : 1 ?>],
        <?php endforeach ?>

        ]);

        var options = {
          vAxis: {minValue: 0},
          colors: ['#55efc4','#74b9ff']
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">

    //Загружаем круглые приборы
          google.charts.load('current', {'packages':['gauge']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Label', 'Value'],
              ['Маржа', <?=round($today[0]['profit']*60/$tb)?>],
              ['CPU', 55],
              ['Качество', <?=round($happyness['avg_score_last_month'], 2)*10?> ]
            ]);

            var options = {
              width: 400, height: 120,
              //redFrom: 0, redTo: 40,
              yellowFrom:40, yellowTo: 60,
              greenFrom: 60, greenTo: 100,
              minorTicks: 5
            };

            var chart = new google.visualization.Gauge(document.getElementById('chart_gauge'));

            chart.draw(data, options);

            // setInterval(function() {
            //   data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
            //   chart.draw(data, options);
            // }, 13000);
            // setInterval(function() {
            //   data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
            //   chart.draw(data, options);
            // }, 5000);
            // setInterval(function() {
            //   data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
            //   chart.draw(data, options);
            // }, 26000);
          }
        </script>



</body>
</html>
