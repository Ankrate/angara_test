<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);
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
if(mb_strlen($_POST['search'],'UTF-8')>=3){
$result = $obj -> search_main($_POST['search']);
    
}
if(!empty($result)):?>
<div class="attantion-green"><i class="fas fa-exclamation-triangle"></i> Внимание! Соискатель есть в базе!</div>
<table class="table ajax-table">
                    <thead>
                        <tr class="d-flex">
                            <th class="col-md-2">Имя</th>                            
                            <th class="col-md-2">Телефон</th>
                            <th class="col-md-1">Задача</th>
                            <th class="col-md-1">Задача</th>
                            <th class="col-md-1">Дата создания</th>
                            <th class="col-md-2">Примечание</th>
                            <th class="col-md-2">Заключение</th>
                            <th class="col-md-1">Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $res):?>
                            <?php
                            $obj->table = 'admin_interview_tasks';
                            @$task = $obj->get_tasks($res['id'])[0];
                            ?>
                        <tr class="d-flex">
                            <td class="col-md-2"><a class="people-link" href="people_edit.php?people_id=<?=$res['id']?>" data-toggle="tooltip" data-placement="bottom" title="Изменить контакт"><?=$res['name']?></a></td>
                            <td class="col-md-1"><?=$res['tel']?></td>
                            <?php if(strtotime($task['task_timestamp']) < time()){
                                $color = 'style="color:#e84393;"';
                            }else{
                                $color = 'style="color:#00b894;"';
                            }?>
                            <td class="col-md-1" <?=$color?>><?=$task['task_timestamp']?></td>
                            <td class="col-md-2" <?=$color?>><a class="people-link" href="edit_task_noajax.php?form_id=<?=$task['id'] ?>" data-toggle="tooltip" data-placement="bottom" title="Изменить задачу"><?=$task['task_name']?></a></td>
                            
                            <td class="col-md-1" ><?=$obj->rus_month(date('Y-m-d', strtotime($res['invite_date'])))?></td>
                            <td class="col-md-2"><?=@$res['interview_desc']?></td>
                            <td class="col-md-2"><?=$res['interview_conclusion']?></td>
                            
                            <?php
                            if($res['sid'] <= 2) {
                                    $color_score = 'style="background-color:#e843935e"';
                                    
                            }elseif($res['sid'] == 3 ){
                                $color_score = 'style="background-color:#ffeaa7"';
                            }else{
                                $color_score = 'style="background-color:#55efc459"';
                            }
                            ?>
                            <td class="col-md-1" <?=$color_score?>><b><?=$res['score']?></b></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
<?php else:?> 
    <div class="attantion"><i class="fas fa-thumbs-up"></i> Соискателя нет в базе!</div>
<?php endif;?>
