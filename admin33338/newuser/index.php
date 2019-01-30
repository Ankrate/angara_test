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
$mngs = $obj->mngs_yes();
$mngs2 = $obj->mngs2();
//p($mngs2);
$plan = $obj->plan();
$managers = $obj->get_managers_user();
//p($managers);
$bonname = $obj->bonname();

if(isset($_GET['bonus']) && $_GET['action'] = 'bonusedit'){

     $obj->data = $_GET;
        //p($_GET);
        if($obj->bonusinsert()){
       header('Location:/admin33338/newuser/');
        }
}
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>


        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Сотрудники </caption>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>ФИО</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Enabled</th>
                                    <th>Role</th>
                                    <th>Rolename</th>
                                    <th>Принят</th>
                                    <th>Уволен</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($mngs as $day):?>
                                    <?php if($day['id'] == 18){
                                        continue;
                                    }
                                    ?>
                                <tr>
                                    <td><?=$day['id']?></td>
                                    <td><a href='user.php?user_id=<?=$day["id"]?>&action=edit' ><?=$day['username']?></a></td>
                                    <td><?=$day['user']?></td>
                                    <td><?=$day['type']?></td>
                                    <td><?=$day['enabled']?></td>
                                    <td><?=$day['role']?></td>
                                    <td><?=$day['rolename']?></td>
                                    <td><?=$day['hire_date']?></td>
                                    <td><?=$day['fire_date']?></td>
                                    <td><a href='user.php?user_id=<?=$day["id"]?>&action=edit' class="btn btn-outline-success">edit</a></td>
                                    <td><a href='user.php?user_id=<?=$day["id"]?>&action=delete' class="btn btn-outline-danger" onclick="return confirm('Вы собираетесь удалить пользователя. Уверены?');">delete</a></td>
                                </tr>
                                <?php endforeach?>
                                <tr>
                                    <td><a href='user.php?action=add' class="btn btn-outline-success">Добавить сотрудника</a></td>
                                </tr>
                            </tbody>
                    </table>
               </div>
            </div>
            <div class="row"><!-- Big row -->
                <div class="col-md-6">
                    <div class="table-responsive">
                <table class="table table-bordered adm-level">
                   <caption class="text-left"> Финансовая часть</caption>
                    <thead>
                        <tr>

                            <th>Наименование</th>
                            <?php foreach($bonname as $ole) : ?>
                            <th><?=$ole['name']?></th>
                            <?php endforeach ?>
                            <th>Save</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach(@$mngs2 as $bon) : ?>
                            <form action="" method="get">
                        <tr>

                            <td><?=$bon['username']?></td>
                               <?php foreach($bonname as $b) : ?>
                                   <?php  $pln = $obj->bon($bon['id'],$b['id']);?>
                            <td><input type="number" class="form-control" name="bonus[<?=$b['id']?>]]"   value="<?=$pln['bonus_value']?>" placeholder="Значение в рублях"></td>
                            <input type="hidden" class="form-control" name="table_id"  value="<?=$pln['id']?>">

                            <?php endforeach ?>
                            <input type="hidden" class="form-control" name="action"  value="bonusedit">

                                    <input type="hidden" class="form-control" name="user_id"  value="<?=$bon['id']?>">
                                    <td class="newuser"><button type="submit" class="btn btn-outline-success">Сохранить</button></td>

                        </tr>
                         </form>
                        <?php endforeach ?>


                    </tbody>
                </table>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                <table class="table table-bordered adm-level">
                   <caption class="text-left">Индивидуальный план продаж менеджеров по продажам</caption>
                    <thead>
                        <tr>
                            <th>Менеджер</th>
                            <th>Дата</th>
                            <th>План Потрер</th>
                            <th>План Не Потрер</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($managers as $w) : ?>
                            <form method="get" action="user.php">

                        <tr>
                            <td><?=$w['username']?></td>
                            <td><input type="date" class="form-control" placeholder="Месяц" name="month" value="<?=$w['date']?>"></td>
                            <td><input type="hidden" class="form-control" name="plan_name[]"  value="plan"><?=$w['plan']?></td>
                            <td><input type="hidden" class="form-control" name="plan_name[]"  value="plan2"><?=$w['plan2']?></td>
                            <input type="hidden" class="form-control" name="user_id"  value="<?=$w['user_id']?>">
                            <input type="hidden" class="form-control" name="action"  value="addnewpercent">
                            <td class="newuser"><button type="submit" class="btn btn-outline-success">Редактировать</button></td>
                        </tr>

                        </form>
                        <?php endforeach ?>
                        <tr>
                            <td><a href='user.php?action=addnewplan' class="btn btn-outline-success">Редактироать планы</a></td>
                        </tr>

                    </tbody>
                </table>
                </div>
                </div>
            </div><!-- Big row end -->


    </body>
</html>
