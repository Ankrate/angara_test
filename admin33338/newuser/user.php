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
if($_GET['action'] == 'edit'){
$obj->user_id = $_GET['user_id'];
}elseif($_GET['action'] == 'done'){
        $obj->data = $_GET['value'];
    if($obj->insert()){

    header('Location:/admin33338/newuser/');

    }
}elseif($_GET['action'] == 'delete'){
        $obj->user_id = $_GET['user_id'];
        if($obj->delete()){
            header('Location:/admin33338/newuser/');
        }

}elseif($_GET['action'] == 'update'){
        $obj->data = $_GET['value'];
        $obj->user_id = $_GET['user_id'];
        if($obj->update()){

            header('Location:/admin33338/newuser/');
        }

}elseif($_GET['action'] == 'planupdate'){
        $obj->data = $_GET;
        //p($_GET);
        if($obj->planupdate()){
        header('Location:/admin33338/newuser/');

        }

}elseif($_GET['action'] == 'addnewplan'){
        //$obj->data = $_GET;
        $salesmanagers = $obj->get_salesmanagers();
        //p($salesmanagers);
        //$plans = $obj->get_plans();
        //p($_GET);
}elseif($_GET['action'] == 'insertplan'){
        $obj->data = $_GET;
        //p($_GET);
        if($obj->planinsert()){
        header('Location:/admin33338/newuser/user.php?action=addnewplan');
        }
}elseif($_GET['action'] == 'addnewpercent'){
        $obj->data = $_GET;
        $obj->plan_name = $_GET['plan_name'][0];
        $percent1 = $obj->check_adm_stuff_percent_grade();
        $obj->plan_name = $_GET['plan_name'][1];
        $percent2 = $obj->check_adm_stuff_percent_grade();
        //p($_GET);
        //header('Location:/admin33338/newuser/user.php?action=addnewplan');
}elseif($_GET['action'] == 'insertpercent'){
            $obj->data = $_GET;
            //$obj->chk_table(7,'plan2');
        //p($_GET);
        if($obj->percentinsert()){
                header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

}elseif($_GET['action'] == 'copyinsert'){
           if( $obj->percentcopy($_GET['start_date'])){

               header('Location: ' . $_SERVER['HTTP_REFERER']);
           }
        }
$user = $obj->mng_select();
//p($user);
//$data = $obj->get_data();
//p($plan);
$date = date('Y-m-d H:i:s');
//p($_GET);
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
        <script>
            alert(document.getElementsById('al').innerHTML);
        </script>

        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">
            <?php if($_GET['action'] == 'edit'):?>
            <div class="row">
               <div class="col-md-12">
                   <form action="" method="get">
                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Изменить данные сотрудника </caption>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User</th>
                                    <th>Pass</th>
                                    <th>Userneame</th>
                                    <th>Tel</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Enabled</th>
                                    <th>Role</th>
                                    <th>Rolename</th>
                                    <th>Company_id</th>
                                    <th>Hire date</th>
                                    <th>Fire date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                    <?php foreach($user[0] as $k=>$u):?>
                        <td><input type="" class="form-control" name="value[<?=$k?>]"   value="<?=$u?>"></td>
                    <?php endforeach?>
                    <input type="hidden" class="form-control" name="action"  value="update">
                    <input type="hidden" class="form-control" name="user_id"  value="<?=$user[0]['id']?>">
                        <td><button type="submit" class="btn btn-success">Сохранить</button></td>


                                </tr>
                            </tbody>
                        </table>
                    </form>
               </div>
            </div>
            <?php endif?>
             <?php if($_GET['action'] == 'add'):?>
            <div class="row">
               <div class="col-md-12">
                   <form action="" method="get">
                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Добавить сотрудника</caption>
                            <thead>
                                <tr>

                                    <th>user</th>
                                    <th>Password</th>
                                    <th>Userneame</th>
                                    <th>Type</th>
                                    <th>Enabled</th>
                                    <th>Role</th>
                                    <th>Tel</th>
                                    <th>Email</th>
                                    <th>Rolename</th>
                                    <th>Hire Date</th>
                                    <th>Fire Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td><input type="" class="form-control" name="value[user]"   value=""></td>
                                    <td><input type="" class="form-control" name="value[pass]"   value=""></td>
                                    <td><input type="" class="form-control" name="value[username]"   value=""></td>
                                    <td><select type="" class="form-control" id="1" name="value[type]">
                                        <option>manager</option>
                                        <option>editor</option>
                                        <option>marketolog</option>
                                        </select>
                                    </td>
                                    <td><select type="" class="form-control" id="enabled" name="value[enabled]">
                                        <option>1</option>
                                        <option>0</option>
                                        </select></td>
                                    <td><select type="" class="form-control" id="role" name="value[role]">
                                        <option>stuff</option>
                                        <option>saleshead</option>
                                        <option>markethead</option>
                                        </select></td>
                                    <td><input type="text" class="form-control" name="value[tel]"   value=""></td>
                                    <td><input type="text" class="form-control" name="value[email]"   value=""></td>
                                    <td><input type="text" class="form-control" name="value[rolename]"   value=""></td>
                                    <td><input type="date" class="form-control" name="value[hire_date]"   value="<?=date('Y-m-d')?>"></td>
                                    <td><input type="date" class="form-control" name="value[fire_date]"   value="<?=date('Y-m-d', strtotime('+25 years'));?>"></td>
                                    <input type="hidden" class="form-control" name="action"  value="done">
                        <td class="newuser"><button type="submit" class="btn btn-success">Сохранить</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
               </div>
            </div>
            <?php endif?>
            <?php if($_GET['action'] == 'addnewplan'):?>
            <div class="row">
               <div class="col-md-12">

                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Добавить план сотруднику</caption>
                            <thead>
                                <tr>
                                    <?php for($i=1;$i<=12;$i++):?>
                                        <th>
                                        <?=date('Y')?>-<?=$i?>-01
                                        </th>
                                        <?php endfor?>
                                        <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($salesmanagers as $sal):?>
                                    <form action="" method="get">
                                        <tr>
                                            <tr>
                                            <td><?=$sal['username']?></td>
                                            </tr>
                                     <tr>

                                         <?php for($i=1;$i<=12;$i++):?>
                                            <?php
                                            $mydate = date('Y') . '-' . $i . '-01';
                                             $pla = $obj->get_plans2($sal['id'], $mydate);?>

                                        <td><input type="text" class="form-control" name="plan[<?=$mydate?>][plan1][]"   value="<?=$pla[0]['plan']?>" placeholder="План в рублях">
                                            <input type="text" class="form-control" name="plan[<?=$mydate?>][plan2][]"   value="<?=$pla[0]['plan2']?>" placeholder="План в рублях">
                                        </td>
                                        <?php endfor?>
                                    <input type="hidden" class="form-control" name="action"  value="insertplan">
                                    <input type="hidden" class="form-control" name="date"  value="<?=$mydate?>">
                                    <input type="hidden" class="form-control" name="user_id"  value="<?=$sal['id']?>">
                                    <td class="newuser"><button type="submit" class="btn btn-success">Сохранить</button></td>
                                     </tr>
                                </tr>
                                </form>
                                <?php endforeach?>
                            </tbody>
                        </table>

               </div>
            </div>
            <?php endif?>

            <!-- add plans percentage -->

            <?php if($_GET['action'] == 'addnewpercent'):?>
                <?php
                    $obj->user_id = $_GET['user_id'];
                    $sals = $obj->mng_select();
                    $date2 = $_GET['month'];

                ?>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-center"><span class="date-show">Мотивация на <?=date('Y F',strtotime($date2));?> <?=$sals[0]['username']?></span></div>
                    <div class="col-md-2"></div>
                </div>
            <div class="row">


               <div class="col-md-6">

                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Редактировать план на Портер</caption>

                            <!-- <div style="height:150px;width:250px;position:absolute;top:10%;left:80%;background-color:#f0ad4e;font:40px bold; z-index: 400 " class="text-center">Мотивация скопирована</div> -->
                            <thead>
                                <tr>
                                        <th>Date</th>
                                        <th>Plan</th>
                                        <th>KPI %</th>

                                </tr>
                            </thead>
                            <tbody>

                                    <form action="" method="get">
                                        <tr>
                                            <?php foreach($percent1 as $pp1=>$p1):?>
                                            <tr>
                                                <td><?=$obj->data['month']?></td>
                                                <td><?=$pp1?>%</td>
                                                <td><input type="float" class="form-control" name="pers[value][<?=$p1['p_id']?>]"   value="<?=$p1['adat']['value']?>" placeholder="Значение">
                                                    <input type="hidden" class="form-control" name="pers[id][<?=$p1['p_id']?>]"  value="<?=$p1['adat']['id']?>">
                                                </td>


                                            </tr>
                                            <?php endforeach?>
                                     <tr>
                                    <input type="hidden" class="form-control" name="date"  value="<?=$_GET['month']?>">
                                    <input type="hidden" class="form-control" name="action"  value="insertpercent">
                                    <input type="hidden" class="form-control" name="plan_name_id"  value="plan">
                                    <input type="hidden" class="form-control" name="plan"  value="<?=$pp1/10?>">
                                    <input type="hidden" class="form-control" name="user_id"  value="<?=$obj->data['user_id']?>">

                                    <td></td>
                                    <td></td>
                                    <td class="newuser"><button type="submit" class="btn btn-success" name="saveperscent">Сохранить</button></td>

                                     </tr>
                                </tr>
                                </form>
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-6">

                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Редактировать план на НЕ Портер</caption>
                            <thead>
                                <tr>
                                        <th>Date</th>
                                        <th>Plan</th>
                                        <th>KPI %</th>

                                </tr>
                            </thead>
                            <tbody>

                                    <form action="" method="get">
                                        <tr>
                                            <?php foreach($percent2 as $pp2=>$p2):?>
                                            <tr>
                                                <td><?=$obj->data['month']?></td>
                                                <td><?=$pp2?>%</td>
                                                <td><input type="float" class="form-control" name="pers[value][<?=$p2['p_id']?>]"   value="<?=$p2['adat']['value']?>" placeholder="Значение">
                                                    <input type="hidden" class="form-control" name="pers[id][<?=$p2['p_id']?>]"  value="<?=$p2['adat']['id']?>">
                                                </td>


                                            </tr>
                                            <?php endforeach?>
                                     <tr>
                                    <input type="hidden" class="form-control" name="date"  value="<?=$_GET['month']?>">
                                    <input type="hidden" class="form-control" name="action"  value="insertpercent">
                                    <input type="hidden" class="form-control" name="plan_name_id"  value="plan2">
                                    <input type="hidden" class="form-control" name="plan"  value="<?=$pp2/10?>">
                                    <input type="hidden" class="form-control" name="user_id"  value="<?=$obj->data['user_id']?>">

                                    <td></td>
                                    <td></td>
                                    <td class="newuser"><button type="submit" class="btn btn-success pull-right">Сохранить</button></td>
                                     </tr>
                                </tr>
                                </form>
                            </tbody>
                        </table>
                        </div>
            </div>
            <?php endif?>
        </div>


    </body>
</html>
