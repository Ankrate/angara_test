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
if(strlen($_POST['search'])>=3){
$result = $obj -> search_phone($_POST['search']);
}
if(!empty($result)):?>
<div class="attantion"><i class="fas fa-exclamation-triangle"></i> Внимание! Соискатель есть в базе!</div>
<table class="table table-striped ajax-table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Имя</th>
              <th scope="col">Оценка</th>
              <th scope="col">Итоговая оценка</th>
            </tr>
          </thead>
          <tbody>
          
    
    <?php foreach($result as $res):?>
            <tr>
              <td style="width:  5%"><?php $i=1; echo $i; $i++;?></td>
              <td style="width: 40%"><a href="people_edit.php?people_id=<?=$res['id']?>" ><?=$res['name']?></a></td>
              <td style="width: 5%"><?=$res['interview_score']?></td>
              <td style="width: 50%"><?=$res['interview_conclusion']?></td>
            </tr>
            
          
    
<?php endforeach;?>
        </tbody>
                </table>
<?php else:?> 
    <div class="attantion-green"><i class="fas fa-thumbs-up"></i> Соискателя нет в базе!</div>
<?php endif;?>
