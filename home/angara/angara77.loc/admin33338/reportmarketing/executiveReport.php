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
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/ReportExecutive.php');

$obj = new ReportExtcutive;
$my = new MyDb;
$mng = $my->get_mngs();
$score = $obj->get_score();
//p($mng);
//p($_SESSION);

if(isset($_GET['score'])){
    $obj->data = @$_GET['score'];
    if(!$obj->check_report_insert()){
        
    //header ('Location: /admin33338/manager.php');
    $message = 'Отчет без ошибок? Отправить?';
    echo "<SCRIPT type='text/javascript'> //not showing me this
        confirm('$message');
        window.location.replace(\"/admin33338/\");
    </SCRIPT>";
}else{
    $message = 'Отчет сегодня уже отправлен!';
    echo "<SCRIPT type='text/javascript'> //not showing me this
        alert('$message');
        window.location.replace(\"/admin33338/\");
    </SCRIPT>";
}    
}    

?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">
            <div class="row"><!-- Big row -->
                <div class="col-md-12">
                    <div class="table-responsive">
                <table class="table table-bordered adm-level">
                   <caption class="text-left"> <?= $_SESSION['name']?></caption>
                    <thead>
                        <tr>
                            <th>Менеджер</th>
                            <?php foreach($score as $m):?>
                            <th><?=$m['score_name']?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="get" action="">
                            
                        <?php foreach($mng as $w) : ?>
                        <tr>
                            
                            <td><?=$w['username']?></td>
                            <?php foreach($score as $i):?>
                                
                               
                            <td><select type="number" class="form-control report input-sm" name="score[<?=$w['id']?>][<?=$i['id']?>]"  placeholder="Оценка" value="">
                                <option></option>
                                <option>1</option>
                                <option>0</option>
                                <option>-1</option>
                            </select>
                            </td>
                            
                            <!-- <input type="hidden" class="form-control report" name="user_id"value="<?=$i['id']?>">
                            
                            <input type="hidden" class="form-control report" name="score_id[score]" value="<?=$w['id']?>"> -->
                            <?php endforeach ?>
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
