<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin') {
    if($_SESSION['type'] != 'manager'){
        header('location: /admin33338/');
    }
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
//function __autoload($class_name) {
//    include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/' . $class_name . '.php');
//}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Report.php');

$obj = new Report;
$data = $obj->get_data();
//p($data);
$date = date('Y-m-d H:i:s');
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>

    </head>
    <body>
        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">
            <div class="row"><!-- Big row -->
                <div class="col-md-12">
                    <div class="table-responsive">
                <table class="table table-bordered adm-level report-table">
                   <caption class="text-left"> Отчет за <?=$date . ' менеджер: ' . $_SESSION['name']?></caption>
                    <thead>
                        <tr>
                            <th>Машина</th>
                            <th>Количество звонков</th>
                            <th>Количество продаж</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="get" action="sendreport.php">
                        <?php foreach($data as $w) : ?>
                        <tr>
                            
                            <td><?=$w['fullname']?></td>
                            <td><input type="number" class="form-control report" name="calls[]"  placeholder="звонков" value=""></td>
                            <td><input type="number" class="form-control report" name="sales[]"  placeholder="продаж" value=""></td>
                            <input type="hidden" class="form-control report" name="car_id[]"  placeholder="продаж" value="<?=$w['id']?>">
                            <input type="hidden" class="form-control report" name="user"  placeholder="продаж" value="<?=$_SESSION['user']?>">
                            <input type="hidden" class="form-control report" name="user_id"  placeholder="продаж" value="<?=$_SESSION['user_id']?>">
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