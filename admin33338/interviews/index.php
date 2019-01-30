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
$result = $obj->get_interview(1);

//p($result);

$count = $obj->count_resume();
//p($count);




?>

        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
         
<div class="container-fluid">
    <div class="row">
                <div class="col-md-1">
                    <?php include_once(__DIR__ . '/left.php');?>
                </div>
            <div class="col-md-11">
                
                <form >
                <div class="form-row padding-10-10">
                    <div class="col">
                    <input id="search_resume" class="form-control" type="search" placeholder="Поиск по Фамилии, Имени или номеру телефона" aria-label="Search">
                    </div>
                    <div class="col">
                    <p>Резюме в базе <span class="badge badge-pill badge-danger big-span"><?=$count['rows']?></span></p>
                    </div>
                </div>
                </form>
                <div class="row">
                    <div class="col">
                        <div id="result_resume"></div>
                    </div>
                </div>
                
                <table class="table table-bordered">
                    <thead>
                        <tr class="d-flex">
                            <th class="col-md-1">Вакансия</th> 
                            <th class="col-md-2">Имя</th>                            
                            <th class="col-md-1">Телефон</th>
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
                        <tr class="d-flex people-link-all">
                            <td class="col-md-1" style="color:#e84393;" ><b><?=$res['vacancy']?></b></td>
                            <td class="col-md-2"><a class="people-link" href="people_edit.php?people_id=<?=$res['id']?>" data-toggle="tooltip" data-placement="bottom" title="Изменить контакт"><b><?=$res['name']?></b></a></td>
                            <td class="col-md-1"><?=$res['tel']?></td>
                            <?php if(strtotime($task['task_timestamp']) < time()){
                                $color = 'style="color:#e84393;"';
                            }else{
                                $color = 'style="color:#00b894;"';
                            }?>
                            <td class="col-md-1" <?=$color?>><?= $task['task_timestamp'] ? date('d M H:i',strtotime($task['task_timestamp'])) : '' ?></td>
                            
                            
                            <td class="col-md-1 people-link" <?=$color?> >
                                <?php
                                    $all_tasks = $obj->get_tasks($res['id']);
                                    foreach($all_tasks as $tsk):
                                 // p($tsk);
                                     ?>   
                                 
                                <a <?=$color?> class="" href="edit_task_noajax.php?form_id=<?=$tsk['id'] ?>" data-toggle="tooltip" data-placement="bottom" title="Изменить задачу"><?=$tsk['task_name']?></a><br>
                                                                <?php endforeach ?>
                                
                                <div id="addtask" class="text-center"><a href="edit_task.php?people_id=<?=$res['id']?>"><i class="fas fa-plus-circle"></i></a></div>
                                
                            </td>
                            
                            
                            <td class="col-md-1" ><?=$obj->rus_month(date('Y-m-d', strtotime($res['invite_date'])))?></td>
                            <td class="col-md-2"><?=$res['interview_desc']?></td>
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
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#search_resume').keyup(function(){
            var txt = $(this).val();
            if(txt != ''){
               $('#result_resume').html('');
                $.ajax({
                    url: 'search_main.php',
                    method: 'post',
                    data: {search: txt},
                    dataType: 'text',
                    success: function(data){
                        $('#result_resume').html(data);
                    }
                }); 
            }else{
              console.log('empty');  
            }
        });
    });
</script>



 </body>
</html>