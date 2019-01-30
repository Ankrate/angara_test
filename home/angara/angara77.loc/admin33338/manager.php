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
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/WegesPlan.php');
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
//Звонки менеджеров

$mng_calls = $obj->getCallsQuatityMng($user_id, HOW_MANY_DAYS);
//p($mng_calls);

//Вытягиваем зарплату за прошлые месяцы
$obj_last_salary = new WegesPlan;
$wages_last = $obj_last_salary->profit_by_month($user_id, 1);// Second parameter is limit months
//p($wages_last);

?>

<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
		<?php if($_SESSION['user_id'] == 32):?>
		<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/assistant.php');?>
		<?php else: ?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
        <?php endif ?>
    <!-- Pe chart revenue per manager -->
<div class="container-fluid">


    <h2>Результаты за <span class="red"><?=$obj->russian_month()?></span> <?=$_SESSION['name']?></h2>
   <div class="row">

        <div class="col-md-8">
            <div class="table-responsive">
            <table class="table table-bordered adm-level cl1">
                <thead>
                    <tr>

                        <th>Машины</th>
                        <th>План</th>
                        <th>Прибыли сделано</th>
                        <th>Прогноз прибыли</th>
                        <th>Выполнено фактически</th>
                        <th>Прогноз выполнения плана</th>
                        <th>Мотивация %</th>
                        <th>Мотивация на сегодня руб</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Портер</td>

                        <td><span class='plan'><?=number_format($per['plan'])?> руб</span></td>
                        <td><?=number_format($per['profit_porter'])?> руб</td>
                        <td><?=number_format($per['personal_forecast_porter'])?> руб</td>
                        <td><?=round($per['profit_porter']/$per['plan']*100)?>%</td>
                        <td><?=round($per['rate_porter']*100)?>%</td>
                        <td><?=$per['bonus_rate_porter']?>%</td>
                        <td><b><?=number_format($zp_porter = $per['profit_porter']*$per['bonus_rate_porter']/100)?> </b>руб</td>

                    </tr>
                    <tr>
                        <td>НЕ Портер</td>
                        <td><span class='plan'><?=number_format($per['plan2'])?> руб</span></td>
                        <td><?=number_format($per['profit_no_porter'])?> руб</td>
                        <td><?=number_format($per['personal_forecast_no_porter'])?> руб</td>
                        <td><?=round($per['profit_no_porter']/$per['plan2']*100)?>%</td>
                        <td><?=round($per['rate_no_porter']*100,2)?>%</td>
                        <td><?=$per['bonus_rate_no_porter']?>%</td>
                        <td><b><?=number_format($zp_no_porter = $per['profit_no_porter']*$per['bonus_rate_no_porter']/100)?></b> руб</td>

                    </tr>

                </tbody>
            </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="table-responsive">
            <table class="table table-bordered adm-level cl1">
                <thead>
                    <tr>
                        <th>Оклад</th>
                        <th>Рассчет</th>
                        <th>ЗП на Сегодня</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=number_format($per['bonus'])?> руб</td>
                        <td><?=number_format($per['bonus'])?>+<?=number_format($zp_porter)?>+<?=number_format($zp_no_porter)?></td>
                        <td><b><?=number_format($per['bonus']+$zp_porter+$zp_no_porter)?></b> руб</td>

                    </tr>
                </tbody>
            </table>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered adm-level cl1">
                <thead>
                    <tr>
                        <th>За Дней</th>
                        <th>Звонков</th>
                        <th>Средняя оценка</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=HOW_MANY_DAYS?></td>
                        <td><?=$mng_calls['calls']?></td>
                        <td><b><?=round($mng_calls['score'],2)?></b></td>

                    </tr>
                </tbody>
            </table>

            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">

        <div class="p-2">
            <div class="card text-primary border-primary" style="max-width: 80rem;">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="p-2"><span class="manager-pill">Сегодня заработал % </span></div>
                        <div class="p-2">
                            <span class="badge badge-pill badge-danger manager-pill"><?=$per['today_porter']*$per['bonus_rate_porter']/100 + $per['today_no_porter']*$per['bonus_rate_no_porter']/100?> руб</span>

                        </div>
                    </div>

                <table class="table manager-table">
                      <thead>
                        <tr>

                          <th scope="col">Маржа по Портер</th>
                          <th scope="col">Маржа по НЕ Портер</th>
                          <th scope="col">Расчет</th>
                          <th scope="col">Заработал сегодня % без оклада</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>

                          <td><?=number_format($per['today_porter'])?></td>
                          <td><?=number_format($per['today_no_porter'])?></td>
                          <td>(<?=$per['today_porter']?>*<?=$per['bonus_rate_porter']?>%) + (<?=number_format($per['today_no_porter'])?>*<?=$per['bonus_rate_no_porter']?> %)</td>
                          <td class="manager-sum"><span><?=$per['today_porter']*$per['bonus_rate_porter']/100 + $per['today_no_porter']*$per['bonus_rate_no_porter']/100?></span> руб</td>
                        </tr>

                      </tbody>
                    </table>
                </div>

                </div>
        </div>
    </div>

    <!-- Здесь секция с графиками прибыль по сотрудникам и Выручка по машинам -->

    <!-- <div class="row">
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

    </div> -->
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
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
<div class="col-md-12">
  <h4>Зарплата за прошлые месяцы</h4>
      <div class="table-responsive">
      <table class="table table-bordered adm-level">
          <thead>
              <tr>
                  <th>Месяц</th>
                  <th>Прибыль общая</th>
                  <th>Прибыль личная</th>
                  <th>Прибыль личная портер</th>
                  <th>Прибыль личная не портер</th>
                  <th>Рентабельность</th>
                  <th>Выполнено портер %</th>
                  <th>Выполнено не портер %</th>
                  <th>Мотив Портер</th>
                  <th>Мотив не Портер</th>
                  <th>Оклад</th>
                  <th>ЗП</th>
              </tr>
          </thead>
          <tbody>

              <?php foreach(@$wages_last as $w2) : ?>

              <tr>

                  <td><?=date('Y-M',strtotime($w2['date']))?></td>
                  <td><?=number_format($w2['total_all'])?> руб</td>
                  <td><?=number_format($w2['profit'])?> руб</td>
                  <td><?=number_format($w2['porter'])?> руб</td>
                  <td><?=number_format($w2['no_porter'])?> руб</td>
                  <td><?=$w2['rent']?>%</td>
                  <td class="<?php if($w2['dolya'] < 0.4 ){ echo 'red';}?>"><?=$w2['dolya']*100?> %</td>
                  <td class="<?php if($w2['dolya2'] < 0.4 ){ echo 'red';}?>"><?=$w2['dolya2']*100?> %</td>
                  <td><?=number_format($w2['bonus_porter'])?></td>
                  <td><?=number_format($w2['bonus_no_porter'])?></td>
                  <td><?=number_format($w2['oklad'])?> руб</td>
                  <td class="bold"><?=number_format($w2['wage'])?> руб</td>
              </tr>
              <?php endforeach ?>
          </tbody>
      </table>
      </div>
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
