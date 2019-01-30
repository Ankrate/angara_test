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
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/interviews/InterviewClass.php');

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

$big_data1 = $objCompany->make_array(1); //Data for angara77
$big_data = $objCompany->make_array(3);
$tb = $big_data1[0]['budget']/date('t');
//Выбираю уже выданную зарплату на сегодня
$fzp = $object1->get_salary_all()[0]['summa'];
$show_ballance = $object1->get_ballance();
$count_managers = $object1->count_managers_all();
//p($count_managers);

//p($budget_advigatel);
//Получаем просроченные задачи на сегодня
$taskObj = new InterviewClass;
$tasks = $taskObj -> get_tasks_expired2();
//p($tasks);
//Вытягиваем количество и оценку звонков
$all_mngs = $object1->get_mngs3();
foreach($all_mngs as $kmng=>$vmng){
$mng_calls[] = $object1->mng_calls($vmng['id']);
    $mng_calls[$kmng]['user'] = $vmng['username'];
}

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
          ['<?=$m['val_date']?>',  <?=($m['val_cost'])?>, <?=($m['val_profit'])?>, 1200000],
          <?php $u++;?>
          <?php endforeach ?>
          
          
        ]);

        var options = {
          title: 'Показатели эффективности',
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
        <div class="col-md-8">
                <span class="badge badge-info">Точка G: &nbsp; &nbsp;<span><?=number_format(round($tb))?></span></span>
                    <span class="badge badge-info" role="alert">Выручка: &nbsp; &nbsp;<span><?=number_format($today[0]['cost'])?></span> руб</span>
                    <span class="badge <?=compare_class($today[0]['profit'],$tb)?>" role="alert">Прибыль: &nbsp; &nbsp;<span><?=number_format($today[0]['profit'])?></span> руб</span>         
                    
                    <span class="badge <?=compare_class($ware[0]['ware_cost'],2450000)?>" role="alert">Склад: &nbsp; &nbsp;<span><?=@number_format($ware[0]['ware_cost'])?></span> руб</span>
                    
                    
                    <span class="badge <?=compare_class_red($revenue_forecast,$plan)?>" role="alert">Прогноз: &nbsp; &nbsp;<span><?=@number_format($revenue_forecast)?></span> руб</span>
                    <span class="badge <?=compare_class_red($revenue_forecast,$plan)?>" role="alert">План: &nbsp; &nbsp;<span><?=@number_format($plan)?></span> руб</span>
                    <span class="badge btn-primary" role="alert">Сотрудников: &nbsp; &nbsp;<span class="badge badge-light"><?=$count_managers?></span></span>
                    
        </div>
        <div class="col-md-4">
            <?php foreach($tasks as $task):?>
               <?php
                            if(date('Y-m-d H:m',strtotime($task['task_timestamp'])) > date('Y-m-d H:m')){
                                        $task_background = 'task_background_green';
                                    }else{
                                        $task_background = 'task_background_red';
                                    }
                               ?>
                    <div class="d-inline-flex">
                    <div id="<?=$task['id']?>" class="card mycard-val <?=$task_background?>" style="width: 12rem;">
                    <div class="card-body">
                    <div><?=date('d F H:i', strtotime($task['task_timestamp']))?><a class="done-task" href="javascript:ajaxDone(<?=$task['id']?>,<?=$task['people_id']?>)"><span  class="float-md-right my-done" data-toggle="tooltip" data-placement="top" title="Завершить задачу"><i class="fas fa-check"></i></span></a></div>
                    <div><a href="/admin33338/interviews/people_edit.php?people_id=<?=$task['people_id']?>"><?=$task['name']?></a></div>
                    <div><?=$task['task_name'] ?><a href="/admin33338/interviews/edit_task_noajax.php?form_id=<?=$task['id']?>"><span  class="float-md-right"><i class="fas fa-pencil-alt"></i></span></a>
                        
                    </div>
                    </div>
                    </div>
                    </div>
            <?php endforeach ?>
        </div>
                     
                </div>
    <div class="row">
        <div class="col-md-12">
            <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">-7%</span>
            
            <span class="badge badge-info" role="alert">Средний чек:  &nbsp;<span><?=round(average($ck))?></span> руб</span>
            <span class="badge badge-info" role="alert">Рентабельность: &nbsp; &nbsp;<span><?=round($today[0]['profit']/$today[0]['cost'],3)*100?></span>%</span>
            <span class="badge <?=compare_class_red($revenue_forecast,$big_data1[0]['expenses'])?>" role="alert">Расходы: &nbsp; &nbsp;<span><?=number_format($big_data1[0]['expenses'] + $fzp)?></span> руб</span>
            <span class="badge badge-secondary" role="alert">Дата записи:  &nbsp;<span><?=$show_ballance['date']?></span></span>
            <span class="badge badge-danger" role="alert">Долг поставщикам:  &nbsp;<span><?=number_format($show_ballance['debt'])?></span> руб</span>
            <span class="badge badge-success" role="alert">Деньги на счетах:  &nbsp;<span><?=number_format($show_ballance['money'])?></span> руб</span>
            <span class="badge badge-success" role="alert">Балланс:  &nbsp;<span><?=number_format($show_ballance['money'] - $show_ballance['debt'])?></span> руб</span>
        </div>
    </div>
    <div class="row">
        
            <?php if(date("d") >= 25 AND date("d") < 26  ):?>
                <div class="col-md-2">
                       <a href="/admin33338/newuser/"><div class="alert alert-danger demotiv" role="alert">Пора делать мотивацию на следующий месяц </div></a>
                       </div>
                <?php endif?>
            
            
                    <!-- <?php if($links == TRUE):?>
                        <div class="col-md-2">
                       <a href="/admin33338/linksplan/"><div class="alert alert-danger demotiv" role="alert">Паника! Просроченные ссылки! <i class="fa fa-ambulance" aria-hidden="true"></i></div></a>
                       </div>
                                    <?php endif?> -->
            <?php if($chk_exp == TRUE):?>
                    <div class="col-md-2">
                       <a href="/admin33338/report/expenses.php"><div class="alert alert-danger demotiv" role="alert">Паника! Не записаны расходы за прошлый месяц! <i class="fa fa-money" aria-hidden="true"></i></i></div></a> 
                    </div>
                <?php endif?>
        </div>
        
        
        
        <!--Table for angara77-->
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
                                <th>Прогноз Расходов</th>
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
                                <td><?=number_format($b_adv['expenses'] + $fzp)?></td>
                                <td><?=@number_format($revenue_forecast)?></td>
                                <td><?=@number_format($ware[0]['ware_cost'])?></td>
                                <td class="<?php if($revenue_forecast > $b_adv['expenses']){echo 'green';}else{echo 'red';}?>"><b><?=number_format($rash = ($big_data1[0]['expenses'] + $fzp)/date('d')*date('t'))?></b></td>
                                <td class="<?php if(($revenue_forecast - $rash) > 0){echo 'green';}else{echo 'red';}?>"><b><?=@number_format($revenue_forecast - $rash)?></b></td>
                            </tr>
                            <?php endforeach?>
                            
                        </tbody>
                    </table>
                    
        </div>
        </div>
        
        <div class="row">
        <div class="col-md-4">
            <table class="table table-bordered adm-level">
                <caption class="text-left">Результаты текущего месяца </caption>
                <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Выручка</th>
                        <th>Вал</th>
                        <th>Рент</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($daily as $day):?>
                    <tr   class="<?php echo ($day['daily_profit'] < $tb) ? 'val-red' : 'val-green' ?>">
                        <td><?=date('d/m/Y' ,strtotime($day['DATE']))?></td>
                        <td><?=number_format($day['daily_revenue'])?> руб</td>
                        <td><?=number_format($day['daily_profit'])?></td>
                        <td><?=round($day['daily_profit']/$day['daily_revenue'],3)*100?>%</td>
                    </tr>
                    <?php endforeach?>
                    <tr class="info field-green bold">
                        <td>Итого:</td>
                        <td><?=number_format($all[0]['total_revenue'])?></td>
                        <td><?=number_format($all[0]['total_profit'])?></td>
                        <td><?=round($all[0]['total_profit']/$all[0]['total_revenue']*100,2)?>%</td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="col-md-4">
                <div class="text-left capt">Результаты текущего месяца </div>
            <div class="panel panel-primary">
                        <div class="panel-heading">Выручка по машинам за 3 мес</div>
                            <div class="panel-body">
                                <div id="piecar" style="width: 100%; height: 100%; max-height: 600px"></div>            
                            </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-bordered adm-level">
                <caption class="text-left">Результаты по машинам за этот мес</caption>
                <thead>
                    <tr>
                        <th>Менеджер</th>
                        <th>Кол-во звонков</th>
                        <th>Средний бал</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $im = 0;
                    $cal = 0;
                    $sco = 0;
                    ?>
                    <?php foreach($mng_calls as $mngv):?>
                        
                    <tr>
                        <td><?=$mngv['user']?></td>
                        <td><?=$mngv['calls']?></td>
                        <td class="red"><b><?=round($mngv['score'],2)?></b></td>
                        
                        <?php
                        $im++;
                         $cal += $mngv['calls']; 
                         $sco += $mngv['score'];
                         ?>
                        
                    </tr>
                    <?php endforeach?>
                    <tr class="info field-green bold">
                        <td>Итого:</td>
                        <td class="green"><b><?=$cal?></b></td>
                        <td class="green"><b><?=round($sco/$im,2)?></b></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered adm-level">
                <caption class="text-left">Результаты по машинам за этот мес</caption>
                <thead>
                    <tr>
                        <th>Машина</th>
                        <th>Выручка</th>
                        <th>Вал</th>
                        <th>Рент</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cars_value as $cv):?>
                        <?php if($cv['cost'] == null) continue;?>
                    <tr>
                        <td><?=$cv['car']?></td>
                        <td><?=number_format($cv['cost'])?> руб</td>
                        <td><?=number_format($cv['profit'])?></td>
                        <td><?=round($cv['rent'],2)?>%</td>
                        <?php $viruchka += $cv['cost']?>
                        <?php $valProf += $cv['profit']?>
                    </tr>
                    <?php endforeach?>
                    <tr class="info field-green bold">
                        <td>Итого:</td>
                        <td><?=number_format($viruchka)?> руб</td>
                        <td><?=number_format($valProf)?> руб</td>
                        <td><?=round($valProf/$viruchka*100,2)?>%</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        
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
                            <div class="panel-heading">Динамика маржинальной прибыли на сотрудника</div>
                        <div class="panel-body">
                            <div id="chist" style="width: 100%; height: 100%; max-height: 500px"></div>
                        </div>
                    </div>
            </div>
        </div>
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
                <div class="panel-heading">Показатели эффективности компании за <?=date('Y')?> год</div>
                    <div class="panel-body">
            <div id="curve_chart" style="width: 100%; height: 100%; max-height: 500px"></div>
                    </div>
                </div>
        </div>
    </div>
    
    
        <div class="row">
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
                                <th>Количество сотр</th>
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
                            <?php foreach(array_reverse($month) as $mth):?>
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
                            $people = $object1->g_people($mth['val_date']);
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
                                <td class="<?=$object1->compare_class_red($net_profit,0)?> field-green"><?=number_format($net_profit)?></td>
                                <td><?=$people?></td>
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
        </div> <!-- first row -->
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
          ['Дата', 'Маржинальная прибыль', 'Норма прибыли'],
           <?php foreach ($month as $dat=>$m) :?>
           <?php 
                    $people1 = $object1->g_people($m['val_date']);
                    $d_people1 = round($m['val_profit']/$people1);
           ?>
          ['<?=$m['val_date']?>',  <?=$d_people1?>, 150000],
          <?php $u++;?>
          <?php endforeach ?>
          
          
        ]);

        var options = {
          title: 'Маржинальная прибыль на сотрудника',
          //curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chist'));

        chart.draw(data, options);
      }
    </script>
</body>
</html>





