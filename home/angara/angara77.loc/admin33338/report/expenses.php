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
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Expenditures.php');

$obj = new Expenditures;

//p($mngs);

if(isset($_GET['month'])){
    //p($_GET);
    $obj->data = $_GET;
    $exp = $obj->get_data();
    
    //p($exp);
}
if(@$_GET['action'] == 'edit'){
    //p($_GET);
    $obj->data = $_GET;
    $obj->update_insert();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$date = date('Y-m-d');
//p($_GET);
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>

    
        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">
           <div class="row">
               <h2>Выбери год и месяц</h2>
               <div class="col-md-4">
                   <form  name="user" method="get" action="">
                       <!-- <select class="form-control" name="user_id">
                           <?php foreach($mngs as $m):?>
                           <option value="<?=$m['id']?>"><?=$m['username']?></option>
                           <?php endforeach?>
                       </select> -->
               </div>
               <div class="col-md-4">
                       <input class="form-control" type="date" name="month" value="<?=$date?>"/>
                       <input type="hidden" class="form-control" name="action"  value="get_month">
               </div>
            <div class="col-md-4">
                      <button type="submit" class="btn btn-success">Получить</button>
            </div>
                        </form>
           </div>
          
            <!-- add plans percentage -->
            <?php if(@$_GET['month'] == ''):?>
                <h2>Выбери месяц и год</h2>
            <?php endif?>
            
            
             <?php if(@$_GET['action'] == 'get_month'):?>
                
                
            <div class="row">
                <div class="col-md-3"></div>
               <div class="col-md-6">
                   
                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Расходы за <?=$_GET['month']?></caption>
                            <thead>
                                <tr>   
                                        <th>Расходы</th>
                                        <th>Значение</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                               <form action="" method="get">
                                        <tr>
                                            <?php foreach($exp as $k1=>$v1):?>
                                            <tr>
                                                <td><?=$v1['name']?></td>
                                                <td><input type="number" class="form-control" name="exps[val][]"   value="<?=$v1[0]['value']?>" placeholder="Расходы в рублях"></td>
                                                <input type="hidden" class="form-control" name="exps[id][]"   value="<?=$v1[0]['id']?>">
                                                <input type="hidden" class="form-control" name="exps[exp_id][]"   value="<?=$k1?>">
                                            </tr>
                                            <?php endforeach?>
                                            
                                            <input type="hidden" class="form-control" name="month"   value="<?=$_GET['month']?>">
                                </tr>
                                <tr>
                                    <td></td>
                                    <input type="hidden" class="form-control" name="action"   value="edit">
                                    <td><button type="submit" class="btn btn-primary">Сохранить</button></td>
                                </tr>
                                </form>
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-3"></div>
            </div>
            <?php endif?>
        </div>
        
            
            
    </body>
</html>