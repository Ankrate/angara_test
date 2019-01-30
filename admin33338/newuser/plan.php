<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin') {
    //if($_SESSION['type'] != 'manager'){
        header('location: /admin33338/');
    //}
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
                                    <th>Type</th>
                                    <th>Enabled</th>
                                    <th>Role</th>
                                    <th>Rolename</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                    <?php foreach($user[0] as $k=>$u):?>
                        
                        <td><input type="" class="form-control report" name="value[<?=$k?>]"   value="<?=$u?>"></td>
                        
                    <?php endforeach?>
                    <input type="hidden" class="form-control report" name="action"  value="update">
                    <input type="hidden" class="form-control report" name="user_id"  value="<?=$user[0]['id']?>">
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
                                    <th>Rolename</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                    <td><input type="" class="form-control report" name="value[user]"   value=""></td>
                                    <td><input type="" class="form-control report" name="value[pass]"   value=""></td>
                                    <td><input type="" class="form-control report" name="value[username]"   value=""></td>
                                    <td><select type="" class="form-control report" id="1" name="value[type]">
                                        <option>manager</option>
                                        <option>editor</option>
                                        <option>marketolog</option>
                                        </select>
                                    </td>
                                    <td><select type="" class="form-control report" id="enabled" name="value[enabled]">
                                        <option>1</option>
                                        <option>0</option>
                                        </select></td>
                                    <td><select type="" class="form-control report" id="role" name="value[role]">
                                        <option>stuff</option>
                                        <option>saleshead</option>
                                        <option>markethead</option>
                                        </select></td>
                                    <td><input type="" class="form-control report" name="value[rolename]"   value=""></td>
                                    <input type="hidden" class="form-control report" name="action"  value="done">
                        <td><button type="submit" class="btn btn-success">Сохранить</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>       
               </div> 
            </div>
            <?php endif?>
        </div>
            
            
    </body>
</html>