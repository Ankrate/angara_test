<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin') {
    if($_SESSION['type'] != 'assistant'){
        header('location: /admin33338/');
    }
}
$user_id = $_SESSION['user_id'];
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/CallsClass.php');

$obj = new CallsClass;
$limit = 10;
$data = $obj->ajaxScoreDayLimit($limit, 2);
$test = $obj->ScoreTable($limit);
//p($test);

?>

<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>



    <!-- Pe chart revenue per manager -->
<div class="container-fluid">
  <h5>Оценка звонков за последние <?=$limit?> дней.</h5>
  <div class="row">
    <?php foreach($test as $key=>$value):?>
    <div class="col-<?=count($test)?>">
      <h6><?=$key?></h6>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Дата</th>
            <th scope="col">Звонков</th>
            <th scope="col">Оценка</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($value as $val):?>
          <tr>
            <td><?=$val['date']?></td>
            <td class="bold"><?=$val['calls']?></td>
            <td class="bold"><?=$val['avg_score']?></td>
          </tr>
        <?php endforeach ?>
        </tbody>
      </table>
    </div>
  <?php endforeach?>
  </div>
</div>

</body>
</html>
