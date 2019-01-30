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

//p($_POST);

$obj = new InterviewClass;

$result = $obj -> edit_form_select($_GET['form_id']);
$obj -> table = 'admin_interview_tasks';
if(!empty($_POST)){
$res = $obj->task_insert($_POST);
    if($res){
header("Location: /admin33338/interviews/");
    }
//}
//}else{
//    if($obj->task_update($_POST)){
   // header('Location: /admin33338/interviews/edit_task_noajax.php?form_id='.$_POST['task_id']);
 //   }
}
$options = $obj->get_status();
//p($options);
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
				<div class="col-md-12">
					<form name="setup_reminder" action="" method="post">
						<div class="jumbotron" id="collapseExample2">
							<div class="container">
								<div class="row">
									<h3><?=$result['name'] ?></h3>

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
											<label for="exampleInputEmail1">Название задачи</label>
											<select type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Название задачи" value="<?=$result['task_name'] ?>" name="task_name" />
											    
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
						<input type="hidden" name="task_id" value="<?=$result['id'] ?>">
						<input type="hidden" name="people_id" value="<?=$result['people_id'] ?>">
					</form>
				</div>
			</div>
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
            defaultDate: '<?=$result['task_timestamp'] ?>',
				});
				});
</script>

</body>
</html>