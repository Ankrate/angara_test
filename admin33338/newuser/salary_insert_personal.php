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


//p($_GET);
//p($_POST);

if(isset($_GET['action']) AND $_GET['action'] == 'edit_sum'){
    
    $per_sal = $obj->get_personal_salary($_GET['manager_id'], $_GET['date']);
    $name = $obj->get_m($_GET['manager_id']);
    //p($per_sal);
    
    //header('Location:/admin33338/newuser/salary_insert.php');
    
}
if(isset($_POST['data1'])){
    $obj->data1 = $_POST['data1'];
    if($obj->updmng()){
         header('Location: '.$_SERVER['REQUEST_URI']);
    }
}



$total = 0;
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
        
    
        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <form action="" method="post">
                            <h6 class="text-left margin-bot-top">Зарплата сотрудника <?=$name[0]['username']?> за <?=$obj->russian_month($_GET['date'])?></h6>
                                <table class="table table-bordered adm-level">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <?php foreach($per_sal as $each): ?>
                                                <th><?=$each['date']?></th>
                                            <?php endforeach ?>
                                            <th>Всего</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <tr>
                                    <td><?=$name[0]['id']?></td> 
                                    <td><?=$name[0]['username']?></td>
                                  <?php foreach($per_sal as $each): ?>
                                                <td><input class="form-control" type="number" name="data1[<?=$each['id']?>]" value="<?=$each['value']?>" /></td>
                                                <?php $total += $each['value']; ?>
                                            <?php endforeach ?>
                                    <td><?=$total?></td>            
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