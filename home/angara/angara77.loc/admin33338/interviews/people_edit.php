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
$result = $obj -> get_interview_men($_GET['people_id']);

//p($result);
$obj -> table = 'admin_interview_tasks';
$tasks = $obj -> get_tasks($_GET['people_id']);
//p($tasks);
if(isset($_GET['new_people']) || @$_GET['new_people'] == 'yes'){
    header('Location: /admin33338/interviews/people_edit.php');
}

//p($_POST);
if(!empty($_POST)){
    
if($obj->insert_people($_POST)){
    header('Location: index.php');
}
}
$options = $obj->get_status();
$score = $obj->get_score();
//p($result);
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
            <div class="row">
                <div class="col-md-6">
                    <a href="people_edit.php">Занести соискателя</a>
            <!-- Работаю с формой записи чуваков в базу -->
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Вакансия</label>
                            <input type="text" class="form-control people-form" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Вакансия" name="vacancy" value="<?=trim($result[0]['vacancy']) ?>" >
                          </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Источник резюме</label>
                            <input type="text" class="form-control people-form" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Источник резюме" name="resume_sourse" value="<?=trim($result[0]['resume_sourse']) ?>" >
                          </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Кандидат</label>
                            <input type="text" class="form-control people-form" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Кандадат" name="people_name" value="<?=trim($result[0]['name']) ?>" >
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Телефон</label>
                            <input type="text" class="form-control people-form" id="search_phone" aria-describedby="emailHelp" placeholder="Телефон" name="people_tel" value="<?=trim($result[0]['tel']) ?>" >
                            
                          </div>
                      <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control people-form people-form" id="exampleFormControlInput1" placeholder="name@example.com" name="people_email" value="<?=trim($result[0]['email']) ?>">
                      </div>
                
                
                                        <?php if(isset($result[0]['interview_score'])):?>
                                        <script>
                                        $(document).ready(function(){
                                            
                                            $('#f'+<?=$result[0]['interview_score']?>).attr('selected','selected');
                                            console.log('pr');
                                        }); 
                                        </script>
                                        <?php endif ?>
                
                
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Предварительная оценка</label>
                        <select class="form-control people-form" id="exampleFormControlSelect1" name="people_score">
                            <?php foreach($score as $scor):?>
                                <option id="f<?=$scor['id']?>" value="<?=$scor['id']?>" ?><?=$scor['score']?></option>
                                <?php endforeach ?> 
                            
                          
                        </select>
                      </div>
                      
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" id="inlineCheckbox1" value="0" name="people_status" <?php if(!isset($result[0]['status']) OR  $result[0]['status'] == '0'): echo 'checked'; endif ?> >
                          <label class="form-check-label" for="inlineCheckbox1">В работе</label>
                    </div>
                    <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" id="inlineCheckbox2" value="1"  name="people_status" <?php if(isset($result[0]['status']) AND  $result[0]['status'] == '1'): echo 'checked';endif ?> >
                          <label class="form-check-label" for="inlineCheckbox2">В Архив</label>
                    </div>
                      
                      <!-- <div class="form-group">
                        <label for="exampleFormControlSelect1">Статус</label>
                        <select class="form-control people-form" id="exampleFormControlSelect1" name="people_status">
                            <?php if(isset($result[0]['status'])):?>
                          <option value="<?=$result[0]['status'] ?>" class="people-form">В работе</option>
                          <?php endif ?>
                          <option value="1" class="people-form">Убрать в Архив</option>
                        </select>
                      </div> -->
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Предварительные записи</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="people_desc" value="<?=$result[0]['interview_desc'] ?>"><?=$result[0]['interview_desc'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Резюме соискателя</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="people_resume" value=""><?=$result[0]['file_resume'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Заключение после собеседования</label>
                        <textarea class="form-control"  rows="3" name="people_conclusion" value="<?=$result[0]['interview_conclusion'] ?>"><?=$result[0]['interview_conclusion'] ?></textarea>
                      </div>
                      <?php if(isset($result[0]['id'])):?>
                      <input type="hidden" name="people_id" value="<?=$result[0]['id'] ?>" />
                      <?php endif ?>
                      <input type="hidden" name="action" value="edit_people" />
                      <input type="hidden" name="manager_id" value="<?=$_SESSION['user_id']?>" />
                      <button type="submit" class="btn btn-primary margin-bot-top">Сохранить</button>
                    </form>
            </div>
            <div class="col-md-6">
                
                    
            <div class="media my-media">
                
                <?php if(file_exists($_SERVER{'DOCUMENT_ROOT'} . '/admin33338/img/resume/' . $result[0]['id'] . 'small.jpg')):?>
              <img class="mr-3" src="/admin33338/img/resume/<?=$result[0]['id'] ?>small.jpg" alt="Generic placeholder image">
              <?php endif ?>
                <div class="media-body">
                    
                    <h4 class="mt-0"><?=$result[0]['name'] ?></h4>
                        
                            <h6><?=$result[0]['tel'] ?></h6>
                            <h6><?=$result[0]['email'] ?></h6>
                            <h6>Предварительная оценка: <?=$result[0]['interview_score'] ?></h6>
                            <hr>
                            <h6><?=$result[0]['interview_conclusion'] ?></h6>
                            <hr>
                            
                <?php foreach($tasks as $task):?>
                    <?php
                            if(date('Y-m-d H:m',strtotime($task['task_timestamp'])) > date('Y-m-d H:m')){
                                        $task_background = 'task_background_green';
                                    }else{
                                        $task_background = 'task_background_red';
                                    }
                               ?>
                    
                    <div id="<?=$task['id']?>" class="card mycard <?=$task_background?>" >
                    <div class="card-body">
                    <div><?=date('d F H:i', strtotime($task['task_timestamp']))?><a class="done-task" href="javascript:ajaxDone(<?=$task['id']?>,<?=$task['people_id']?>)"><span  class="float-md-right my-done" data-toggle="tooltip" data-placement="top" title="Завершить задачу"><i class="fas fa-check"></i></span></a></div>
                    <div><a href="people_edit.php?people_id=<?=$task['people_id']?>"><?=$task['name']?></a></div>
                    <div><?=$task['task_name'] ?><a href="edit_task_noajax.php?form_id=<?=$task['id']?>"><span  class="float-md-right"><i class="fas fa-pencil-alt"></i></span></a>
                        
                    </div>
                    </div>
                    </div>
                <?php endforeach ?>
                
                     <p>  
                      <a class="small" href="#"  data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                        <span><i class="fas fa-plus"></i> Добавить задачу</span>
                      </a>
                    </p>
                  <div id="result_search"></div>
                      </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form name="setup_reminder" action="save_task.php" method="post">
                        <div class="jumbotron collapse" id="collapseExample3">
                            <div class="container">
                                <div class="row">
                                    
                                    <h3><?=$result[0]['name'] ?></h3>

                                </div>
                                <div class="row">
                                    <?php if(isset($result['status_id'])):?>
                                
                                        <script>
                                        $(document).ready(function(){
                                            $('#s'+<?=$result['status_id']?>).attr('selected','selected');
                                        }); 
                                        </script>
                                        <?php endif ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Название задачи</label>
                                            <select type="text" class="form-control" id="exampleInputEmail3" aria-describedby="emailHelp" placeholder="Название задачи" value="<?=$result['task_name'] ?>" name="task_name" />
                                                <?php foreach($options as $opt):?>
                                                <option id="s<?=$opt['id']?>" value="<?=$opt['id']?>" ?><?=$opt['task_name']?></option>
                                                <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <!-- <label for="exampleInputPassword1">Password</label> -->
                                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Описание" value="<?=$result['task_decsription'] ?>" name="task_description"  />
                                            <small id="emailHelp" class="form-text text-muted">Подробно опишите задачу</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                                <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" name="task_timestamp"/>
                                                    <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_done">
                                            <label class="form-check-label" for="exampleCheck1"> Завершить задачу</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary margin-bot-top">
                                            Сохранить
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <input type="hidden" name="task_id" value=""> -->
                        <input type="hidden" name="people_id" value="<?=$result[0]['id'] ?>">
                    </form>
                </div>
            </div>
            
            </div>
            
    
    </div>
    
    <div class="row" style="padding:30px 0 30px 0">
        <div class="col-md-12">
        <p>
  
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Открыть резюме
          </button>
        </p>
            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                  
                <?=$result[0]['file_resume'] ?>
              </div>
            </div>
        
            </div>        
            </div>
    </div>
</div>
</div>
<?php if(!isset($_GET['people_id'])):?>
<script>
    $(document).ready(function(){
        $('#search_phone').keyup(function(){
            var txt = $(this).val();
            if(txt != ''){
               $('#result_search').html('');
                $.ajax({
                    url: 'search.php',
                    method: 'post',
                    data: {search: txt.replace(/[^0-9]/g,'')},
                    dataType: 'text',
                    success: function(data){
                        $('#result_search').html(data);
                    }
                }); 
            }else{
                
            }
        });
    });
</script>
<?php endif?>







<script type="text/javascript">
	$(function() {
		$('#datetimepicker2').datetimepicker({
			locale : 'ru',
			stepping : 30,
			collapse : false,
			sideBySide : true,
			defaultDate : 'moment',
		});
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
                            
                            </script>
 </body>
</html>