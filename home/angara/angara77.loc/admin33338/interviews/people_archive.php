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
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/interviews/InterviewClass.php');

$obj=new InterviewClass;
$obj -> table = 'admin_interviews_people';
$result = $obj->get_interview_archive();

//p($result);

?>

        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
         
<div class="container-fluid">
    <div class="row">
                <div class="col-md-1">
                    <?php include_once(__DIR__ . '/left.php');?>
                </div>
            <div class="col-md-10">
                <div class="padding-11">
                <form class="form-inline">
                <div class="form-row">
                    <input class="form-control mr-sm-4" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </div>
                </form>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr class="d-flex">
                            <th class="col-md-2">Имя</th>                            
                            <th class="col-md-2">Телефон</th>
                            <th class="col-md-1">Задача</th>
                            <th class="col-md-2">Задача</th>
                            <th class="col-md-1">Дата создания</th>
                            <th class="col-md-2">Примечание</th>
                            <th class="col-md-2">Заключение</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $res):?>
                            <?php
                            $obj->table = 'admin_interview_tasks';
                            @$task = $obj->get_tasks($res['id'])[0];
                            ?>
                        <tr class="d-flex">
                            <td class="col-md-2"><a href="people_edit.php?people_id=<?=$res['id']?>"><?=$res['name']?></a></td>
                            <td class="col-md-2"><?=$res['tel']?></td>
                            <td class="col-md-1"><?=$task['task_timestamp']?></td>
                            <td class="col-md-2"><?=$task['task_name']?></td>
                            <td class="col-md-1"><?=$obj->rus_month(date('Y-m-d', strtotime($res['invite_date'])))?></td>
                            <td class="col-md-2"><?=$res['interview_desc']?></td>
                            <td class="col-md-2"><?=$res['interview_conclusion']?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
 </body>
</html>