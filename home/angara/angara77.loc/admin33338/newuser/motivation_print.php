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
    //p($_GET);
    $obj->plan_name = 'plan';
    $obj->data = $_GET;
    $plan = $obj->check_adm_stuff_percent_grade();
    $obj->plan_name = 'plan2';
    $plan2 = $obj->check_adm_stuff_percent_grade();
    //p($plan);
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
        <div class="container-fluid">
           <div class="row">
               <h2>Выбери менеджера, год и месяц, число 1</h2>
               <div class="col-md-4">
                   <form  name="user" method="get" action="">
                       <select class="form-control" name="user_id">
                           <?php foreach($mngs as $m):?>
                           <option value="<?=$m['id']?>"><?=$m['username']?></option>
                           <?php endforeach?>
                       </select>
               </div>
               <div class="col-md-4">
                       <input class="form-control" type="date" name="month" value="<?=$_GET['month']?>"/>
                       <input type="hidden" class="form-control" name="action"  value="get_motivation">
               </div>
            <div class="col-md-4">
                       <button type="submit" class="btn btn-success">Получить</button>
            </div>
                        </form>
           </div>
            <!-- add plans percentage -->
            <?php if(@$_GET['user_id'] == ''):?>
                <h2>Выбери мереджера</h2>
            <?php endif?>
            <?php if(@$plan_month == false):?>
                <h2>Планы и мотивация на этот месяц не прописаны</h2>
                <?php die ?>
            <?php endif?>
            
            <?php if(@$_GET['action'] == 'get_motivation' AND $_GET['user_id']!= ''):?>
                <?php
                    $obj->user_id = $_GET['user_id'];
                    $sals = $obj->mng_select();
                ?>
                <div class="row">
                    <h1 class="text-center">План и мотивация менеджера <span class="red"><?=$sals[0]['username']?></span> на <?=$obj->russian_month($plan_month[0]['date'])?></h1>
                </div> 
            <div class="row">
               <div class="col-md-6">
                   <div class="panel panel-primary">
                      <div class="panel-heading">План по Портер <?=$plan_month[0]['date']?></div>
                            <div class="panel-body text-center plan-big">
                                <?=$plan_month[0]['plan']?> руб
                            </div>
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
                                <?=$sals[0]['username']?>
                                    
                                        <tr>
                                            <?php foreach($plan as $k1=>$v1):?>
                                            <tr>
                                                <td><?=$v1['adat']['date']?></td>
                                                <td><?=$k1?>%</td>
                                                <td><?=$v1['adat']['value']?></td>
                                            </tr>
                                            <?php endforeach?>
                                     
                                </tr>
                                </form>
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                      <div class="panel-heading">План НЕ Портер <?=$plan_month[0]['date']?></div>
                            <div class="panel-body text-center plan-big">
                                <?=$plan_month[0]['plan2']?> руб
                            </div>
                    </div>
                   
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
                                <?=$sals[0]['username']?>
                                        <tr>
                                            <?php foreach($plan2 as $k2=>$v2):?>
                                            <tr>
                                                <td><?=$v2['adat']['date']?></td>
                                                <td><?=$k2?>%</td>
                                                <td><?=$v2['adat']['value']?></td>
                                            </tr>
                                            <?php endforeach?>
                                     
                                        </tr>
                                </form>
                            </tbody>
                        </table>
                        </div> 
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <h5><span class="red">Внимание!</span> При выполнении плана продаж менее чем на 40% по любой товарной группе, применяется демотивация в размере <span class="red"><?=$obj->demotivation?> руб.</span></h5>
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                <a class="btn btn-primary" href="/admin33338/newuser/motivation_print_print.php?<?php echo $_SERVER['QUERY_STRING']?>">Распечатать</a>
                </div>
                
            </div>
        </div>
        <?php endif?>
            
            
    </body>
</html>