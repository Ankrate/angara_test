<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin') {
    if($_SESSION['type'] != 'manager'){
        header('location: /admin33338/');
    }
}
$user_id = $_SESSION['user_id'];
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Weges2.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Weges.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/WegesNew.php');
//require __DIR__ . '/../../config.php';
$all = get_all_val_data();
//p($all);
$daily = val_get_total_daily();

$manag = val_get_manager('Olesya');
$month = val_get_total_monthly();
$u = 1;
$today = val_get_today();
$ware = ware_get_today();
$ware_all = get_ware_all();
$cars_value = get_cars_value(); // Value of revenue by car
$viruchka = 0;
$valProf = 0;

$ck = get_adm_check_total();



$total_profit_for_today = $all[0]['total_profit'];
//$revenue_forecast = revenue_forecast($total_profit_for_today);

$object = new Weges2; // Класс для выборки зарплат за прошлые месяцы
$wages =$object->get_personal($user_id);
//p($wages);


$obj = new Weges;
$obj->demotivation_start_date = date("d");
$obj->val = $all[0]['total_profit'];
$wag = $obj->get_adm_all_managers();
$per = $obj->manager($user_id);


$obj->data = array('month'=>date('Y-m-d'), 'user_id'=>$user_id, 'plan_name'=> 'plan');
$plan_porter = $obj->get_percents();
$obj->data = array('month'=>date('Y-m-d'), 'user_id'=>$user_id, 'plan_name'=> 'plan2');
$plan_no_porter = $obj->get_percents();
//$test = $obj->percentage_rate($user_id, 'plan2', 40000, 115423);
//p($test);
//p($per);
$new = new MyDb;
$new->koeff();
$rate = $new->rateArr;
if($_SESSION['user'] == 'Olesya'){
    $chk_exp = $new->chk_date();   
}



?>

<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
            
            <script type="text/javascript" src="/admin33338/slider/js/bootstrap-slider.js"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php foreach($wag as $we) : ?>
          ['<?=$we['username']?>',     <?=$we['profit']/1000?>],
          <?php endforeach ?>
          
        ]);

        var options = {
          title: 'Прибыль по сотрудникам за текущий месяц',
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
          ['<?=$m['val_date']?>',  <?=($m['val_cost'])?>, <?=($m['val_profit'])?>, 970000],
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
          ['Дата', 'Продажи', 'Валовая прибыль', 'Точка безубыточности'],
           <?php foreach ($month as $m) :?>
          ['<?=$m['val_date']?>',  <?=($m['val_cost'])?>, <?=($m['val_profit'])?>, 970000],
          <?php $u++;?>
          <?php endforeach ?>
          
          
        ]);

        var options = {
          title: 'Показатели 2015 года',
          //curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('average_check'));

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
          title: 'Стоимость склада',
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
          title: 'Выручка по машинам'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piecar'));

        chart.draw(data, options);
      }
    </script>
  
    <!-- Pe chart revenue per manager -->
<div class="container-fluid">
    
    <div class="row demotiv">
        
            <?php
                    if (date('d') > 5) {
                        if( $per['rate_porter'] <= 0.4 && date("j") > 13){
                            $text = <<<HTML
                            <div class="col-md-3">
                                <div class="alert alert-danger" role="alert">Паника! Высокая вероятность получить демотивацию за невыполнение плана по Портерам на сумму {$new->demotivation} руб! <i class="fa fa-ambulance" aria-hidden="true"></i></div>
                                </div>        
HTML;
                            
                            echo $text;
                        }
                        if($per['rate_no_porter'] <= 0.4 && date("j") > 13){
                            $text2 = <<<HTML
                            <div class="col-md-3">
                                <div class="alert alert-danger" role="alert">Паника! Высокая вероятность получить демотивацию за невыполнение плана по НЕ Портер на сумму {$new->demotivation} руб! <i class="fa fa-ambulance" aria-hidden="true"></i></div>
                                </div>        
HTML;
                            echo $text2;
                        }
                    }
            ?>
        </div>
        <?php if($_SESSION['user'] == 'Olesya' ):?>
        <div class="row">
            
                <?php if($chk_exp == TRUE):?>
                    <div class="col-md-2">
                       <a href="/admin33338/report/expenses.php"><div class="alert alert-danger demotiv" role="alert">Паника! Не записаны расходы за прошлый месяц! <i class="fa fa-money" aria-hidden="true"></i></i></div></a> 
                    </div>
                <?php endif?>
            
        </div>
        <?php endif?>
    </div>
   <div class="row">
       
        <div class="col-md-8">
            <div class="table-responsive">
            <table class="table table-bordered adm-level cl1">
                <caption class="text-left">Прогноз мотивации на текущий месяц</caption>
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
                        <td><?=round($per['profit_porter']/$per['plan']*100)?>%</td>
                        <td><?=round($per['rate_porter']*100)?>%</td>
                        <td><?=$per['bonus_rate_porter']?>%</td>
                        <td><?=number_format($per['motiv_porter'])?> руб</td>
                        
                    </tr>
                    <tr>
                        <td>НЕ Портер</td>
                        <td><span class='plan'><?=number_format($per['plan2'])?> руб</span></td>
                        <td><?=number_format($per['profit_no_porter'])?> руб</td>
                        <td><?=number_format($per['personal_forecast_no_porter'])?> руб</td>
                        <td><?=round($per['profit_no_porter']/$per['plan2']*100)?>%</td>
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
  <!--    <div class="row">
        <div class="col-md-6">
            <h4>Из чего состоит окладная часть <?=$_SESSION['name']?>:</h4>
            <ul class="list-inline">
                <?php foreach($per['oklad'] as $okl):?>
                    <li></li><?=$okl['bonus']?> = <?=$okl['bonus_value']?> руб</li>
                <?php endforeach?>
                <li>Мотивация/Демотивация за выполнение/невыполнение плана: <?=$new->premia?> руб</li>
            </ul>
                
        </div>
        <div class="col-md-6">
            <h4>Выполнение плана:</h4>
            <div class="col-md-6">
                План: <?=number_format($per['plan'])?><br>
                Прогноз выполнения плана: <?=number_format($per['personal_forecast'])?><br>
            </div>
            <div class="col-md-6">
                Разница до плана: <?php echo number_format(round($per['plan']- $per['personal_forecast'])); ?><br>
                <h5>Прогноз премии за план:<span class="red"> <?php if($per['plan']- $per['personal_forecast'] >= 0){echo '-' . $new->premia;}else{echo $new->premia;}?></span></h5>
            </div>
             
                
                 
        </div>
    </div>    
   <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered adm-level cl1">
                   <caption class="text-left">Моделирование зарплаты от прибыли</caption>
                    <thead>
                        <tr>
                            <th><?=$_SESSION['name']?></th>
                            <th>Личная прибыль</th>
                            <th>Доля в прибыли</th>
                            <th>Оклад</th>
                            <th>Проценты</th>
                            <th>ЗП</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="100" data-slider-max="1000" data-slider-step="5" data-slider-value="300"/></td>
                            <td id="div-profit"></td>
                            <td id="div-dolya"></td>
                            <td id="div-bonus"></td>
                            <td id="div-rate"></td>
                            <td id="div1"></td>
                        </tr>
                    </tbody>
                </table>
                </div>
        </div>
    </div> -->
    <?php if($_SESSION['name'] == 'Vostrikova Olesya'):?>
    <div class="row">
        <div class="col-md-12">
            
            <div id=""></div>
            
                <div class="table-responsive">
                <table class="table table-bordered adm-level">
                   <caption class="text-left"> Зарплата за прошлые месяцы <?=$_SESSION['name']?></caption>
                    <thead>
                        <tr>
                            <th>Месяц</th>
                            <th>Прибыль общая</th>
                            <th>Прибыль личная</th>
                            <th>Рентабельность</th>
                            <th>Доля в прибыли %</th>
                            <th>KPI</th>
                            <th>ЗП</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($wages as $w2) : ?>
                        <tr>
                            <td><?=date('Y-M',strtotime($w2['date']))?></td>
                            <td><?=number_format($w2['total'])?> руб</td>
                            <td><?=number_format($w2['profit'])?> руб</td>
                            <td><?=$w2['rent']?>%</td>
                            <td><?=$w2['dolya']*100?> %</td>
                            <td><?=$w2['rate']*100?> %</td>
                            <td><?=number_format($w2['wage'])?> руб</td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                </div>
                
            </div>
    </div>
    <?php endif?>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Эффективность менеджеров</div>
                    <div class="panel-body">
                        <div id="piechart_3d" style="width: 100%; height: 100%; max-height: 600px"></div>            
                    </div>
            </div>
        </div>
        <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Выручка по машинам</div>
                            <div class="panel-body">
                                <div id="piecar" style="width: 100%; height: 100%; max-height: 600px"></div>            
                            </div>
                    </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            
        
            <h1>Mотивация на  <span class="red"><?=$obj->russian_month()?></span> <?=$_SESSION['name']?></h1>
            <!-- <blockquote><h4>Пример: <span class="green">План: 450 000 руб, реально сделал прибыли на 510 000 руб</span><br>Зарплата = 15000 + 510 000 (личная прибыль) <span class="red">x</span> 9%  = 60 900 руб + 2 000 руб (перевыполнение плана)<br>
                <b>Итого = 62 900 руб</b><br></h4></blockquote>
                <h2>Недовыполнение считается так же</h2>
               <blockquote> <h4>Пример: <span class="green">План: 450 000 руб, реально сделал прибыли на 420 000 руб</span><br>Зарплата = 15000 + 420 000 (личная прибыль) <span class="red">x</span> 7,5%  = 51 500 руб - 2 000 руб (недовыполнение плана)<br>
                <b>Итого = 41 500 руб</b><br></h4></blockquote> -->
            <div class="row">
                <div class="col-md-6">
                    <h5>Таблица мотивации по <span class="red">Портерам</span></h5>
                        <div class="table-responsive">
                            <table class="table table-bordered adm-level">
                                <!-- <caption class="text-left"> Таблица коэффициентов в зависимости от прибыли <span class="red">КП</span></caption> -->
                                <thead>
                                    <tr>
                                        <th>Процент выполнения плана</th>
                                        <th>Проценты мотивации</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($plan_porter as $key1=>$por) : ?>
                                        <tr class="<?php if($per['rate_porter']*100 > $key1-5 AND $per['rate_porter']*100 < $key1+5){echo 'fon_green';}?>">
                                            <td><?=$key1?>%</td>
                                                <td><?=$por['adat']['value']?> %</td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5>Таблица мотивации по <span class="red">НЕ Портерам</span></h5>
                        <div class="table-responsive">
                            <table class="table table-bordered adm-level">
                                <!-- <caption class="text-left"> Таблица коэффициентов в зависимости от прибыли <span class="red">КП</span></caption> -->
                                <thead>
                                    <tr>
                                        <th>Процент выполнения плана</th>
                                        <th>Проценты мотивации</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($plan_no_porter as $key2=>$nopor) : ?>
                                        <tr class="<?php if($per['rate_no_porter']*100 > $key2-5 AND $per['rate_no_porter']*100 < $key2+5){echo 'fon_green';}?>">
                                            <td><?=$key2?>%</td>
                                                <td><?=$nopor['adat']['value']?> %</td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    <div class="col-md-2">
    </div>
</div>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <ul class="motivation-list">
            <li>При выполнении плана продаж менее чем на 40% по любой товарной группе, применяется демотивация в размере <span class="red"><?=$obj->demotivation?> руб</span>.</li>
            <li>Планы продаж и мотивация на следующий месяц составляются не позднее 28 числа текущего месяца.</li>
            <li>Руководитель объявлет план продаж и мотивацию сотрудникам до начала следующего месяца.</li>
            <li>В течение месяца план продаж и мотивация измененению <span class="red">НЕ подлежат!</span></li>
        </ul>
    </div>
    <div class="col-md-2">
    </div>
        </div>
</div>
</body>
<!-- <script>

$(function(){
  $('#ex1').slider({
        formater: function(value) {
          return 'Current value: '+value;
        }
  }).on('slideStop', function(ev){
     var value = $('#ex1').val();
     console.log(value);
     $.ajax({url: "ajax-wage.php",dataType:"json", data:{total:value,id:'<?=$user_id?>',dolya:'<?=$per['percent']?>'}, success: function(result){
        
                $("#div-dolya").html((result.dolya*100).toFixed(2) + ' ' + '%');
                $("#div1").html(result.wage + ' ' + 'руб');
                $("#div-bonus").html(result.bonus  + ' ' + 'руб');
                $("#div-rate").html((result.rate*100).toFixed(0)  + ' ' + '%');
                $("#div-profit").html(result.profit  + ' ' + 'руб');
    }});
  });
});



</script> -->
</html>





