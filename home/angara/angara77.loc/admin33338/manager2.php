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
//require __DIR__ . '/../../config.php';
$all = get_all_val_data();
//p($all);
$daily = val_get_total_daily();
//p($daily);
//$personal = get_data_by_manager($_SESSION['user']); //here we are getting personal profit for today
//p($personal);
//$kirill = get_data_by_manager('Kirill');
//$olesya = get_data_by_manager('Olesya');
//$aleksey = get_data_by_manager('Aleksey');
$manag = val_get_manager('Olesya');
$month = val_get_total_monthly();
$u = 1;
$today = val_get_today();
$ware = ware_get_today();
$ware_all = get_ware_all();
$cars_value = get_cars_value(); // Value of revenue by car
$viruchka = 0;
$valProf = 0;
//p($cars_value);
$ck = get_adm_check_total();
//p($_SESSION);
//echo revenue_forecast(181200);

//get_adm_bonus($user_id,0.08);
$total_profit_for_today = $all[0]['total_profit'];
$revenue_forecast = revenue_forecast($total_profit_for_today);
//$personal_profit_for_today = $personal[0]['mng_profit'];
//$persent = round($personal_profit_for_today/$total_profit_for_today,3);
//$rate = make_wage_rate($revenue_forecast);
//$wage_forecast = return_wage_personal($total_profit_for_today,$persent, $user_id);
//Добавляем управленческий KPI Olesya
//if($_SESSION['user'] == 'Olesya'){
//    $wage_forecast = $wage_forecast + $revenue_forecast*0.01;
//}
$obj = new Weges2;
$wages =$obj->get_personal($user_id);
//p($wages);
$objW = new Weges;
$objW->val = $all[0]['total_profit'];
$wag = $objW->get_adm_all_managers();
$per = $objW->manager($user_id);
//p($per);
$new = new MyDb;
$new->koeff();

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
  </head>
  <body>
    <!-- Pe chart revenue per manager -->
<div class="container-fluid">
    <div class="row  <?php if($_SESSION['name'] != 'Vostrikova Olesya') { echo 'hidden-sm hidden-md hidden-lg';}?>">
        <div class="col-md-12">
            <ul class="list-inline">
                <li role="presentation" class="btn-primary">Сегодня: &nbsp; &nbsp;<span><?=date('l d/m/Y')?></span></li>
                    <li role="presentation" class="btn-info">Выручка: &nbsp; &nbsp;<span><?=number_format($today[0]['cost'])?></span> руб</li>
                    <li role="presentation" class="btn-info <?=compare_class($today[0]['profit'],30000)?>">Прибыль: &nbsp; &nbsp;<span><?=number_format($today[0]['profit'])?></span> руб</li>         
                    <li role="presentation" class="btn-info">Рентабельность: &nbsp; &nbsp;<span><?=$today[0]['rent']?></span>%</li>
                    <li role="presentation" class="btn-info <?=compare_class($ware[0]['ware_cost'],2450000)?>">Склад: &nbsp; &nbsp;<span><?=@number_format($ware[0]['ware_cost'])?></span> руб</li>
                    <li role="presentation" class="btn-primary">Средний чек: &nbsp; &nbsp;<span><?=round(average($ck))?></span> руб</li>
            </ul> 
        </div>
    </div>
   <div class="row">
       
        <div class="col-md-12">
            <div class="table-responsive">
            <table class="table table-bordered adm-level cl1">
                <caption class="text-left">Прогноз показателей на текущий месяц</caption>
                <thead>
                    <tr>
                        <th>Менеджер</th>
                        <th>Вал</th>
                        <th>Доля %</th>
                        <th>Фикс</th>
                        <th>Прогноз общей прибыли</th>
                        <th>Прогноз коэфф KPI</th>
                        <th>Прогноз ЗП</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$_SESSION['name']?></td>
                        <td><?=number_format($per['profit'])?> руб</td>
                        <td><?=$per['percent']*100?>%</td>
                        <td><?=$per['bonus']?> руб</td>
                        <td><?=number_format($revenue_forecast)?> руб</td>
                        <td><?=$per['rate']*100?> %</td>
                        <td><?=number_format($per['weges'])?> руб</td>
                    </tr>
                    
                </tbody>
            </table>
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
                            <td><input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="400" data-slider-max="3000" data-slider-step="50" data-slider-value="950"/></td>
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
    </div>
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
            <h2>Пример расчета зарплат</h2>
            Зарплата рассчитывается следующим образом: Доля участия в прибыли берется из текущего месяца. Двигая ползунок, вы меняете сумму общей прибыли компании. От общей прибыли компании зависят проценты начисляемые к окладу. Схема действует для 3 и менее сотрудников.
            <h5>Таблица расчета процентов от прибыли Коэффициэнт продуктвности(КП)</h5>
            <ul>
                <li>менее 950 тыс - <span class="red">6%</span></li>
                <!-- <li>от 850 до 950 тыс - <span class="red">6%</span></li> -->
                <li>от 950 до 1000 млн - <span class="red">7%</span></li>
                <li>от 1 млн до 1 350 тыс - <span class="red">8%</span></li>
                <li>от 1 350 тыс до 1 500 тыс - <span class="red">9%</span></li>
                <li>от 1 500 тыс  до 1700 тыс - <span class="red">11%</span></li>
                <li>от 1 700 тыс - <span class="red">13%</span></li>
            </ul>
            <h5>Формула расчета зарплаты</h5>
            <p>Зарплата = Оклад <span class="red">+</span> Личная прибыль за месяц <span class="red">x</span> КП</p>
            <p>Оклад расчитывается: Если сработали ниже точки безубыточности, то оклад считается 10000 тыс плюс оклад за дополнительную нагрузку.</p>
            <p>Если сработали в плюс, то 10000 тыс плюс оклад за допнагрузку плюс за выслугу лет, плюс бонус от руководителя(на его усмотрение)</p>
            <p>Руководитель дополнительно получает один процент от общей прибыли.</p>
            <div class="row">
            <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-bordered adm-level">
                   <caption class="text-left">Таблица фиксов</caption>
                    <thead>
                        <tr>
                            <th>Менеджер</th>
                            <th>Оклад</th>
                            <th>Доп нагрузка</th>
                            <th>Выслуга лет</th>
                            <th>Бонус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Олеся</td>
                            <td>10000</td>
                            <td>10000</td>
                            <td>8000</td>
                            <td>1%</td>
                        </tr>
                        <tr>
                            <td>Кирилл</td>
                            <td>10000</td>
                            <td>10000</td>
                            <td>5000</td>
                            <td>Бонус от руководителя</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div><!-- Col md 6 -->
            <div class="col-md-6">
                
            </div>
            </div>
            <p>Пример рассчета фиксированной части Кирилл:</p>
                <ol>
                    <li>Ниже точки безубыточности: 10000+10000 = 20000 тыс руб</li>
                    <li>Выше точки безубыточности: 10000+10000+5000+?5000 = 30000 тыс руб</li>
                </ol> 
        </div>
        <div class="col-md-2">
            
        </div>
    </div>
    
    <!-- Here must be hiden -->
    <!-- <div class="row">
        <div class="col-md-6">
            <div class="hidden-xs table-responsive">
            <table class="table table-bordered adm-level">
                <caption class="text-left">Результаты текущего года</caption>
                <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Выручка</th>
                        <th>Вал</th>
                        <th>Рент</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach($month as $mth):?>
                    <tr>
                        <td><?=date('Y F',strtotime($mth['val_date']))?></td>
                        <td><?=number_format($mth['val_cost'])?> руб</td>
                        <td><?=number_format($mth['val_profit'])?></td>
                        <td><?=round($mth['val_rent'],2)?>%</td>
                    </tr>
                    <?php endforeach?>
                    <tr class="info">
                        <td>Итого:</td>
                        <td><?=number_format($all[0]['total_revenue'])?></td>
                        <td><?=number_format($all[0]['total_profit'])?></td>
                        <td><?=$all[0]['av_rent']?>%</td>
                    </tr>
                </tbody>
            </table>
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
        <div class="col-md-6">       
            <table class="table table-bordered adm-level">
                <caption class="text-left">Результаты по машинам</caption>
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
                    <tr class="info">
                        <td>Итого:</td>
                        <td><?=number_format($viruchka)?> руб</td>
                        <td><?=number_format($valProf)?> руб</td>
                        <td><?=$all[0]['av_rent']?>%</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div> -->
</div>
</body>
<script>

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



</script>
</html>





