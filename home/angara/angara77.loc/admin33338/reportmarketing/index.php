<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin') {
    if($_SESSION['type'] != 'editor' OR $_SESSION['type'] != 'marketolog'){
        //header('location: /admin33338/');
    }
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
//function __autoload($class_name) {
//    include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/' . $class_name . '.php');
//}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Report.php');

$obj = new Report;
$obj->type = $_SESSION['type'];
$data = $obj->get_data_mkt();
//p($data);
$date = date('Y-m-d H:i:s');
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">
            <div class="row"><!-- Big row -->
                <div class="col-md-12">
                    <div class="table-responsive">
                <table class="table table-bordered adm-level">
                   <caption class="text-left"> Отчет за <?=$date . ' менеджер: ' . $_SESSION['name']?></caption>
                    <thead>
                        <tr>
                            <th>Задачи</th>
                            <th>Количество</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <form method="get" action="sendreport.php">
                        <?php foreach($data as $w) : ?>
                        <tr>
                            <td><?=$w['name']?></td>
                            <td><input type="number" class="form-control report" name="score[<?=$w['id']?>]"  placeholder="<?=$w['name']?>" value=""></td>
                            <!-- <td><input type="number" class="form-control report" name="sales[]"  placeholder="продаж" value=""></td>--> 
                            <input type="hidden" class="form-control report" name="score_arr[<?=$w['name']?>]"  placeholder="" value="">
                            <input type="hidden" class="form-control report" name="user"   value="<?=$_SESSION['user']?>">
                            <input type="hidden" class="form-control report" name="user_id"   value="<?=$_SESSION['user_id']?>">
                            <input type="hidden" class="form-control report" name="type"   value="<?=$_SESSION['type']?>">
                        </tr>
                        <?php endforeach ?>
                        <button type="submit" class="btn btn-success">Отправить отчет</button>
                        </form>
                    </tbody>
                </table>
                </div>
                </div>
                </div>
            </div><!-- Big row end -->
    </body>
</html>