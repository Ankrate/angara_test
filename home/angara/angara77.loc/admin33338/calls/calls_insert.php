<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//echo $_SESSION['type'];
if(!isset($_SESSION['name']) ) {
    header('location: /admin33338/');
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/CallsClass.php');
//include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
//include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/LinksPlan.php');

$obj = new CallsClass;
$mngs = $obj -> get_adm_all_managers();
//p($_GET);


if(isset($_GET['calls_date']) AND !empty($_GET['calls_date'])){
        $_SESSION['picked_calls_date'] = $_GET['calls_date'];
    }else{
        $_SESSION['picked_calls_date'] = date('Y-m-d H:i');
    }



if(isset($_GET) AND !empty($_GET)){
    
    $obj->do_job($_GET);
    //p($_SESSION);
    
}
?>

<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
    
    <!-- Pe chart revenue per manager -->
<div class="container-fluid">
    <div class="flexd-row">
        <div class="p-2">
            <form method="get" action="" id="ttmyForm">
                <div class="form-group row">
                    <div class="input-group date col-3" id="datetimepicker2" data-target-input="nearest">
                        <input id="dtpicker" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" name="calls_date"/>
                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <div class="col-9" ><h4><span id="show-date" class="badge badge-secondary">Date</span></h4></div>
                </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Менеджер</th>
                  <th scope="col">Кол-во звонков</th>
                  <th scope="col">Оценка</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach($mngs as $mng):?>
                <tr>
                  <th scope="row"><?=$mng['username']?></th>
                  <td><input id="q<?=$mng['id']?>"   class="form-control myinput" type="number" name="quantity[<?=$mng['id']?>]"  placeholder="Количество звонков"></td>
                  <td><input id="f<?=$mng['id']?>"  class="form-control myinput" type="number" step="0.01" name="score[<?=$mng['id']?>]"  placeholder="Оценка звонков"></td>
                </tr>
               <?php endforeach ?> 
              </tbody>
            </table>
            <button class="btn btn-outline-primary">Сохранить</button>
            </form>
            
            
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('#datetimepicker2').datetimepicker({
            locale : 'ru',
            stepping : 30,
            collapse : false,
            sideBySide : true,
            defaultDate : '<?=date('Y-m-d H:i', strtotime( $_SESSION['picked_calls_date']))?>',
        });
    });
                            
          function ajaxDone(da){
              var formData  = $('#myForm').serialize();
              console.log(formData);
            $.ajax({
                type: "POST",
                url: "edit_calls.php",
                async: true,
                data:  {'date' : da},
                success: function(data,status){
                //$('#result2').html(data)
                var o = JSON.parse(data);
                
                
                for(i=0;i<o.length;i++){
                    
                    //console.log(o[i].calls_score + ' condition');
                    
                    console.log(typeof(o));
                    if(typeof(o) == 'object'){
                        //console.log("Im in if true");
                        $('#f' + o[i].mng_id).val(o[i].calls_score);
                        $('#q' + o[i].mng_id).val(o[i].calls_quantity);
                    }                   
                }
                
                if(typeof(o) == 'string'){
                      // console.log('im in else');
                        //$('.myinput' + o[i].mng_id).val('444');
                        $('.myinput').val('0');
                   }
                
                }
            });
        }
        $("#datetimepicker2").on('change.datetimepicker', function(e){
            var da = e.date.format(e.date._f);
            moment.locale('ru');
            var dat = moment(da, 'L', 'ru').format('LL');
            $('#show-date').html(dat);
            
            ajaxDone(da);
        });
        
                            
</script>





</body>
</html>





