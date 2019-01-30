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
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/NewUser.php');

$obj = new NewUser;
$mngs = $obj-> get_salesmanagers();
//p($mngs);

if(@$_GET['action'] == 'get_motivation'){
    
    $obj->plan_name = 'plan';
    $obj->data = $_GET;
    $plan = $obj->check_adm_stuff_percent_grade();
    $obj->plan_name = 'plan2';
    $plan2 = $obj->check_adm_stuff_percent_grade();
    
    $obj->user_id = $_GET['user_id'];
    $plan_month = $obj->plan_motiv();
    //p($plan_month);


}

$user = $obj->mng_select();
//p($user);
//$data = $obj->get_data();
//p($plan);
$date = date('Y-m-d');
//p($_GET);
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
        <!-- Pe chart revenue per manager -->
        <div class="container motiv-print">
           
            <!-- add plans percentage -->
            <?php if($_GET['user_id'] == ''):?>
                <h2>Выбери мереджера</h2>
            <?php endif?>
            <?php if($plan_month == false):?>
                <h2>Планы и мотивация на этот месяц не прописаны</h2>
                <?php die ?>
            <?php endif?>
            
            <?php if(@$_GET['action'] == 'get_motivation' AND $_GET['user_id']!= ''):?>
                <?php
                    $obj->user_id = $_GET['user_id'];
                    $sals = $obj->mng_select();
                ?>
                <div class="row">
                    <h5>ООО "Ангара" запчасти для грузовиков и автобусов</h5>
                    <h3 class="text-center">Приказ</h3>
                    <h5 class="text-center">О назначении плана и мотивации</h5>
                    <h5 class="text-center"> менеджера отдела продаж <span class="red"><?=$sals[0]['username']?></span> на <?=$obj->russian_month($plan_month[0]['date'])?></h5>
                </div> 
            <div class="row">
               <div class="col-md-12 p-b">
                   <div class="prikaz">
                   <h5 class="text-center">Приказываю:</h5>
                   <h6>1. Назначить план продаж на <?=$obj->russian_month($plan_month[0]['date'])?> по товарной группе Портеры, равным - <?=number_format($plan_month[0]['plan'])?> руб</h6>
                   <h6>2. План продаж на <?=$obj->russian_month($plan_month[0]['date'])?> по товарной группе ВСЕ остальное, кроме товарной группы Портер, равным - <?=number_format($plan_month[0]['plan2'])?> руб</h6>
                   <h6>3. Определить размер мотивации к окладу в процентах в таблицах:</h6>
                   <h6>4. <span class="red">Внимание!</span> При выполнении плана продаж менее чем на 40% по любой товарной группе, применяется демотивация в размере <span class="red"><?=$obj->demotivation?> руб.</span></h6>
                    </div>
                   
                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Мотивация на Портер</caption>
                            <thead>
                                <tr>
                                        <th>Date</th>
                                        <th>Plan</th>
                                        <th>KPI %</th>
                                        
                                </tr>
                            </thead>
                            <tbody>
                                        <tr>
                                            <?php foreach($plan as $k1=>$v1):?>
                                            <tr>
                                                <td><?=$v1['adat']['date']?></td>
                                                <td><?=$k1?>%</td>
                                                <td><?=$v1['adat']['value']?>%</td>
                                            </tr>
                                            <?php endforeach?>
                                     
                                </tr>
                                </form>
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-12">
                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Мотивация не Портер</caption>
                            <thead>
                                <tr>
                                        <th>Date</th>
                                        <th>Plan</th>
                                        <th>KPI %</th>
                                        
                                </tr>
                            </thead>
                            <tbody>
                                        <tr>
                                            <?php foreach($plan2 as $k2=>$v2):?>
                                            <tr>
                                                <td><?=$v2['adat']['date']?></td>
                                                <td><?=$k2?>%</td>
                                                <td><?=$v2['adat']['value']?>%</td>
                                            </tr>
                                            <?php endforeach?>
                                     
                                        </tr>
                                </form>
                            </tbody>
                        </table>
                        </div> 
            </div>
            <?php endif?>
            <div class="row prikaz">
                <div class="col-md-12">
                    <img class="img-responsive" height="" width="" src="/admin33338/img/pech_podp_text.png" />
                </div>
            </div>
            <div class="spacer"></div>
            <div class="row prikaz">
                <div class="col-md-6">
                    <h6>С приказом ознакомился __________________ <?=$sals[0]['username']?></h6>
                </div>
            </div>
            
            
            
    </body>
</html>