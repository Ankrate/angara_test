<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
//echo $_SESSION['type'];
if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin') {
    header('location: /admin33338/');
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Weges.php');
//require __DIR__ . '/../../config.php';

?>

<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
    <!-- Pe chart revenue per manager -->
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
            <div class="table-responsive">
            <table class="table table-bordered adm-level">
                <caption class="text-left">Добавление нового сотрудника</caption>
                <thead>
                    <tr>
                        <th>Менеджер</th>
                        <th>План прибыли</th>
                        <th>Прибыль</th>
                        <th>Рентабельность</th>
                        <th>Доля %</th>
                        <th>Прогноз прибыли за месяц</th>
                        <th>Прогноз коэфф KPI</th>
                        <th>Прогноз ЗП</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<=5; $i++):?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td> руб</td>
                        <td>%</td>
                        <td> %</td>
                        <td> руб</td>
                        <td> %</td>
                        <td> руб</td>
                    </tr>
                    <?php endfor ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>





