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
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/SalaryInsert.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Weges.php');

if(isset($_GET['date'])){
    $date = $_GET['date'];
}else{
    $date = date('Y-m-d');
}

$obj = new SalaryInsert;
$mngs = $obj->get_enabled_stuff();
//p($mngs);
$year_month = $obj->russian_month($date);

//$value = $obj->get_stuff_salary(1, $date);
$weges = new Weges;

//p($_POST);
if(isset($_POST['action']) AND $_POST['action'] == 'insert'){
    $obj->post = $_POST;
    if($obj->data_arr_insert()){
        header('Location:/admin33338/newuser/salary_insert.php');
    }

}
if(isset($_POST['action']) AND $_POST['action'] == 'edit_sum'){

}
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>


        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <form action="" method="get">
                            <div class="col-md-2 padding-10">

                                <div class="input-group mb-3">
                                  <input type="date" class="form-control" aria-describedby="basic-addon2" name="date" value="<?=$date?>">
                                  <div class="input-group-append">
                                    <button class="btn btn-outline-success" type="submit" >Выбрать</button>
                                  </div>
                                </div>
                            </div>
                        </form>
                        <form action="" method="post">
                            <h6 class="text-left">Зарплата сотрудников за <?=$year_month?></h6>
                                <table class="table table-bordered adm-level">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Сумма</th>
                                            <th>Выплата</th>
                                            <th>Дата выплаты</th>
                                            <th>Выдано</th>
                                            <th>Прогноз ЗП</th>
                                            <th>Осталось</th>
                                            <th>Выплаты с датами</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php $total_given = 0;
                                           $total_prognoz = 0;
                                     ?>
                                   <?php foreach($mngs as $manager):?>
                                       <?php if($manager['id'] == 18){ continue;} ?>

                                       <?php
                                            $value = $obj->get_stuff_salary($manager['id'], $date);
                                            if($manager['type'] == 'manager'){
                                                $oklad = $obj->get_stuff_oklad($manager['id']);
                                                $tmp = $weges->manager($manager['id']);

                                                $prognoz = $oklad['summa'];


                                                //p($tmp);
                                            }else{
                                            $oklad = $obj->get_stuff_oklad($manager['id']);
                                            $prognoz = $oklad['summa'];
                                            }
                                       ?>


                                                    <tr>
                                            <td><?=$manager['id']?></td>
                                            <td><?=$manager['username']?></td>
                                            <td><input class="form-control" type="text" name="data[<?=$manager['id']?>][value]" value="" /></td>
                                            <td><select class="custom-select" name="data[<?=$manager['id']?>][type]">
                                                <option selected>Аванс</option>
                                                <option>Зарплата</option>
                                            </select></td>
                                            <td><input class="form-control" type="date" name="data[<?=$manager['id']?>][date]" value="<?=date('Y-m-d')?>" /></td>

                                            <td><?=$value[0]['summa']?></td>
                                            <td><?=$prognoz?></td>
                                            <td><?=$prognoz - $value[0]['summa']?></td>
                                             <td><?php
                                                $array = $obj->get_stuff_sallary_dates($manager['id'],$date);
                                                //p($array);
                                                foreach($array as $arr){
                                                    echo '<a href="/admin33338/newuser/salary_insert_personal.php?action=edit_sum&id=' . $arr['id'] . '&manager_id=' . $manager['id'] . '&date=' . $date .  '">' .  $arr['date'] . '=>' . $arr['value']. '</a> | ';
                                                }
                                                 ?></td>

                                            <?php
                                            $total_given += $value[0]['summa'];
                                            $total_prognoz += $prognoz;

                                            ?>

                                            </tr>
                                            <input type="hidden" name="action" value="insert" />
                                                <?php endforeach?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><b><?=number_format($total_given)?></b></td>
                                                    <td><b><?=number_format($total_prognoz)?></b></td>
                                                    <td><b><?=number_format($total_prognoz - $total_given)?></b></td>
                                                    <td></td>
                                                </tr>


                                </tbody>
                        </table>
                        <button type="submit" class="btn btn-outline-success">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
