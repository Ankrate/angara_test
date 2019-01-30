<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);
session_start();
if (!isset($_SESSION['name'])) {
    if ($_SESSION['user'] != 'Olesya' OR $_SESSION['user'] != 'admin') {
        header('location: /admin33338/');
    }
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/interviews/InterviewClass.php');

$obj = new InterviewClass;
$obj -> table = 'admin_interviews_people';
//$result = $obj->get_interview(1);
if (isset($_GET['interview_date'])) {
    $date = date('Y-m-d H:m', strtotime($_GET['interview_date']));
} else {
    $date = date('Y-m-d H:m');
}
//p($result);
//p($date);
?>

        <?php
    include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');
?>
        <?php
            include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/' . $_SESSION['type'] . '.php');
        ?>

<div class="container-fluid">
    <div class="row">
                <div class="col-md-1">
                    <?php
                    include_once (__DIR__ . '/left.php');
                ?>                    
                </div>
            <div class="col-md-11">
                <form class="form" action="" method="get" >
                <div class="row padding-top-10">
                    <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" name="interview_date"/>
                                                    <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        <script type="text/javascript">
                                            											$(function () {
                                                $('#datetimepicker2').datetimepicker({
                                                    locale: 'ru',
                                                    stepping: 30,
                                                    collapse: false,
                                                    sideBySide: true,
                                                    defaultDate: '<?=$date ?>
														',
														});
														});
                                        </script>
                   </div>
                   <div class="col-md-3">
                       <button class="btn btn-outline-info" type="submit">Выбрать</button>
                   </div>
                   <div class="col-md-3">
                       <p><a href="schedule.php?interview_date=<?=$today=date('Y-m-d') ?>">Cегодня</a></p>
                   </div>
                   <div class="col-md-3">
                       <p><a href="schedule.php?interview_date=<?=date('Y-m-d', strtotime($today . '+1 day')) ?>">Завтра</a></p>
                   </div>
                   
                </div>
            </form>
                <div class="row">
                    
                <div class="col-md">
                <table class="table">
                    <thead>
                        <tr class="d-flex">
                            <th class="col-md-1">Время</th>                            
                            <th class="col-md-11">Задачи</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $start_time = strtotime('9:00');
                        $end_time = strtotime('20:00');
                         for($i=$start_time;$i<=$end_time;$i+=3600):?>
                         <?php
                        $start = date('Y-m-d', strtotime($date)) . ' ' . date('H:i', $i);
                        $end = date('Y-m-d', strtotime($date)) . ' ' . date('H:i', $i + 3599);
                        $obj -> table = 'admin_interview_tasks';
                        $task_card = $obj -> get_tasks_schedule($start, $end);
                        //p($task_card);
                        if (empty($task_card)) {
                            $style = 'background-color: rgba(85, 239, 196, 0.09);';

                        } else {
                            $style = 'background-color: rgba(253, 121, 168, 0.09);';
                        }
                         ?>
                         
                        <tr class="d-flex" style="<?=$style ?>">
                            <th class="col-md-1" scope="row"><?=date('H:i', $i) ?></th>
                            <td class="col-md-11">
                                <div class="row">
                                <?php
                                
                                
                                foreach($task_card as $card):
                                    $obj2 = new InterviewClass;
                                    $obj2->table = 'admin_interviews_people';
                                    $man = $obj2->get_interview_men($card['people_id']);
                                    //p($man);
                                ?>
                                
                                <div class="card mycard d-inline" style="width: 18rem; margin: 0 1px 0 10px;" >
                                  <div class="card-body">
                                        <div><?=date('H:i', strtotime($card['task_timestamp'])) ?></div>
                                        <div class="blue"><?=$man[0]['vacancy']?></div>
                                        <div><a href="people_edit.php?people_id=<?=$man[0]['id'] ?>"><?=$man[0]['name'] ?></a></div>
                                        <div><?=$card['task_name'] ?></div>
                               </div>
                                </div>
                                <?php endforeach ?>
                                </div>
                            </td>
                            
                        </tr>
                        <?php endfor ?>
                    </tbody>
                </table>
                </div>
               </div> 
                
        </div>
    </div>
</div>

 </body>
</html>