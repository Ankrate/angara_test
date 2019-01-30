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
//$result = $obj->get_interview(1);
if(isset($_GET['interview_date'])){
    $date = date('Y-m-d H:m',strtotime($_GET['interview_date']));
    }else{
$date = date('Y-m-d H:m');
}
    
$expierd = $obj->get_tasks_expired2();
$noexpired = $obj->get_tasks_not_expired();
    
//p($result);
//p($date);


?>

        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>

<div class="container-fluid">
    <div class="row">
                <div class="col-md-1">
                    <?php include_once(__DIR__ . '/left.php');?>                    
                </div>
            <div class="col-md-11">
                   <div class="row">
                       <div class="d-flex flex-column">
                           <!-- <h4>Просроченные</h4> -->
                           <?php foreach($expierd as $exp): ?>
                               <?php
                                    if(date('Y-m-d H:m',strtotime($exp['task_timestamp'])) <= date('Y-m-d H:m')){
                                        $task_background = 'task_background_red';
                                    }
                               ?>
                                <div id="<?=$exp['id']?>" class="card mycard <?=$task_background?>" >
                                    <div class="card-body">
                                        <div><?=date('d F H:i', strtotime($exp['task_timestamp']))?><a class="done-task" href="javascript:ajaxDone(<?=$exp['id']?>,<?=$exp['man_id']?>)"><span  class="float-md-right my-done" data-toggle="tooltip" data-placement="top" title="Завершить задачу"><i class="fas fa-check"></i></span></a></div>
                                            <div><a href="people_edit.php?people_id=<?=$exp['man_id']?>"><?=$exp['name']?></a></div>
                                        <div><?=$exp['task_name'] ?><a href="edit_task_noajax.php?form_id=<?=$exp['id']?>"><span  class="float-md-right"><i class="fas fa-pencil-alt"></i></span></a></div>
                                                                           </div>
                                </div>
                           <?php endforeach ?>
                       </div>
                       <div class="d-flex flex-column">
                           <!-- <h4>Предстоящие</h4> -->
                           <?php foreach($noexpired as $noexp): ?>
                               <?php
                                    if(date('Y-m-d H:m',strtotime($noexp['task_timestamp'])) >= date('Y-m-d H:m')){
                                        $task_background2 = 'task_background_green';
                                    }
                               ?>
                                <div id="<?=$noexp['id']?>" class="card mycard <?=$task_background2?>" >
                                    <div class="card-body">
                                        <div><?=date('d F H:i', strtotime($noexp['task_timestamp']))?><a class="done-task" href="javascript:ajaxDone(<?=$noexp['id']?>, <?=$noexp['man_id']?>)"><span  class="float-md-right my-done" data-toggle="tooltip" data-placement="top" title="Завершить задачу"><i class="fas fa-check"></i></span></a></div>
                                            <div><a href="people_edit.php?people_id=<?=$noexp['man_id']?>"><?=$noexp['name']?></a></div>
                                        <div><?=$noexp['task_name'] ?><a href="edit_task_noajax.php?form_id=<?=$noexp['id']?>"><span  class="float-md-right"><i class="fas fa-pencil-alt"></i></span></a></div>
                                    </div>
                                </div>
                           <?php endforeach ?>
                       </div>
                       <div class="d-flex flex-column"><!-- Форма редактирования задачи -->
                           <div class="row">
        <div class="col-md-12">
            <form name="setup_reminder" action="reminder_setup.php" method="post">
                <div class="jumbotron collapse" id="collapseExample2">
                    <div class="container">
                        <div class="row">
                    <h3>Задача</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Название задачи</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Название задачи" />
                                  </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                  <div class="form-group">
                                    <!-- <label for="exampleInputPassword1">Password</label> -->
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Описание" />
                                    <small id="emailHelp" class="form-text text-muted">Подробно опишите задачу</small>
                                  </div>
                              </div>
                               </div>
                               <div class="row">   
                                  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker2'>
                                        <input type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                               </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1"> Завершить задачу</label>
                                  </div>
                                  </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary margin-bot-top">Сохранить</button> 
                                    </div> 
                                  </div>
                         </div>   
                </div>
            </form>
        </div>
    </div>
                       </div>
                   </div>
                </div>
                
        </div>
    </div>
    
    
    
    <script>
    function ajaxCall(){
            $.ajax({
                type: "POST",
                url: "edit_task_done.php",
                data: "key=value",
                success: function(data,status){
                
                $('#result2').html(data)
                }
            });
        
        }
        
        function ajaxCall2(){
            $.ajax({
              type: "POST",
              url: "edit_task_done.php",
              data: $("#idForm").serialize(),
              success: function(data){
                $('#result2').html(data)
              }
            });
        }
        
        
        $("button").click(function(){
            
        ajaxDone('40',1);
        //console.log('yes');
        });
        
        function ajaxDone(id,people_id){
            $.ajax({
                type: "POST",
                url: "edit_task_done.php",
                data: "is_done=1&task_id="+id+"&people_id="+people_id,
                success: function(data,status){
                $('#result2').html(data)
                
                }
            });
            $("#"+id).toggleClass('mydisabled');
            
        
        }
        
        
       // $(document).ready(function(){
         //   $("a.").click(function(){
         //       $("p").css("color", "red");
         //   });
        //});
        
        </script>
    
    
    
 </body>
</html>