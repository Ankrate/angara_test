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
$mngs = $obj->mngs();
$mngs2 = $obj->mngs2();
//p($mngs);
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
                            <caption class="text-left">Все сотрудники которые когда то работали у нас </caption>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>ФИО</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Enabled</th>
                                    <th>Role</th>
                                    <th>Принят</th>
                                    <th>Уволен</th>
                                    <th>Edit</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($mngs as $day):?>
                                <tr>
                                    <td><?=$day['id']?></td>
                                    <td><a href='user.php?user_id=<?=$day["id"]?>&action=edit' ><?=$day['username']?></a></td>
                                    <td><?=$day['user']?></td>
                                    <td><?=$day['type']?></td>
                                    <td><?=$day['enabled']?></td>
                                    <td><?=$day['role']?></td>
                                    <td><?=$day['hire_date']?></td>
                                    <td><?=$day['fire_date']?></td>
                                    <td><a href='user.php?user_id=<?=$day["id"]?>&action=edit&fired=1' class="btn btn-outline-success">edit</a></td>
                                    <!-- <td><a href='user.php?user_id=<?=$day["id"]?>&action=delete' class="btn-xs btn-danger" onclick="return confirm('Вы собираетесь удалить пользователя. Уверены?');">delete</a></td> -->
                                </tr>
                                <?php endforeach?>
                                <tr>
                                    <td><a href='user.php?action=add' class="btn btn-outline-success">Добавить сотрудника</a></td>
                                </tr>
                            </tbody>
                    </table>
               </div> 
            </div>
            
            
            
    </body>
</html>