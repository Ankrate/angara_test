<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//echo $_SESSION['type'];
if (!isset($_SESSION['name'])) {
    header('location: /admin33338/');
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/CallsClass.php');
//include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
//include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/LinksPlan.php');

$obj = new CallsClass;
$mngs = $obj -> get_adm_all_managers();
//p($_GET);

if (isset($_GET['calls_date']) and !empty($_GET['calls_date'])) {
    $_SESSION['picked_calls_date'] = $_GET['calls_date'];
} else {
    $_SESSION['picked_calls_date'] = date('Y-m-d H:i');
}
if (isset($_GET['mng_id']) and !empty($_GET['mng_id'])) {
    $_SESSION['mng_id'] = $_GET['mng_id'];

}else{
  $_SESSION["mng_id"] = 30;
}
//p($_SESSION);
$callsMonth = $obj -> getCallsByMonth($_SESSION['picked_calls_date']);
$callsNames = $obj->getCallsScoreNames();
//$managers = $obj->get_adm_all_managers();
$uniq = uniqid('u');
//echo $uniq;

$mydate = date('Y-m-d H:i', strtotime($_SESSION['picked_calls_date']));
//echo $mydate;
//p($_SESSION);
//echo $mydate;
//$testdate = $obj-> ajaxData('2018-06-25', 30);
//p($testdate);

?>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>

        <?php if (isset($_SESSION['mng_id'])):?>
        <script>
        $(document).ready(function(){
            $('#opt'+<?=$_SESSION['mng_id']?>).attr('selected','selected');
        });
        </script>
        <?php endif ?>

    <!-- Pe chart revenue per manager -->
<div class="container-fluid">
    <div class="flex-row">
        <div class="p-2">
            <form method="get" action="" id="ttmyForm">
                <div class="form-group row">
                    <div class="input-group date col-3" id="datetimepicker2" data-target-input="nearest">
                        <input id="dtpicker" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" name="calls_date"/>
                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <div class="col-1">
                      <button class="btn btn-outline-danger">Выбрать</button>
                    </div>
                    <div class="col-3" ><h4><span  class="badge badge-secondary bg-light-blue " ><?php echo($obj->rus_month_only(date("Y-m-d",strtotime($_SESSION['picked_calls_date']))))?></span></h4></div>
                </div>
              </form>
        </div>
        <!-- <div class="result2"></div> -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
             foreach($callsMonth as $cm):?>
             <?php $avg = 0;
                    $i = 0;
                    $calls = 0;
             ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Менеджер</th>
                        <th>Дата</th>
                        <th>Звонков</th>
                        <th>Оценка</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cm as $row):?>
                        <?php
                            $i++;
                            $avg += $row['avg_score'];
                            $calls += $row['calls'];
                        ?>
                    <tr>
                        <?php foreach ($row as $key => $val):?>

                        <td style="width: 25%">
                            <?=$val?>
                        </td>
                    <?php endforeach ?>
                    </tr>

                <?php endforeach?>
                <tr>
                    <td style="width: 25%">
                        <b>Итого:</b>
                    </td>
                    <td style="width: 25%">

                    </td>
                    <td style="width: 25%">
                        <b><?=$calls?></b>
                    </td>
                    <td style="width: 25%">
                        <?php if($i != 0):?>
                        <b>Общая средняя: <?=round($avg/$i,2)?></b>
                    <?php endif?>
                    </td>
                </tr>
                </tbody>
            </table>
            <?php endforeach?>
        </div>
    </div>
</div>


<script>

  var app = new Vue({
    el: '.container-fluid',
    data: {
      rows:[
        {
          score: '',
          quantity: ''
        }
      ]

    },
    methods:{
      addNewRow(){
        this.rows.push({
          score: '',
          quantity: ''
        })
      },
      deleteRow(index){
        this.rows.splice(index, 1);
      },
      showType(formId){
        if(formId === '111' || formId =='112'){
          return true;
                  }
                  else{
                    return false;
                  }
      },
      vueAjax(){
        let da = {'name_score_value' : event.target.value,
                  'score_id' : event.currentTarget.id,
                  'manager_id' : '<?=$_SESSION["mng_id"]?>',
                  'date' : '<?=date("Y-m-d", strtotime($_SESSION["picked_calls_date"]))?>'
                };
        $.ajax({
            type: "POST",
            url: "edit_calls2.php",
            async: true,
            data:  {'score' : da},
            success: function(data,status){
            $('.result2').html(data)

            }
        });
      }
    }
  })

//tooltip

</script>

<script type="text/javascript">
    $(function() {
        $('#datetimepicker2').datetimepicker({
            locale : 'ru',
            stepping : 30,
            collapse : false,
            sideBySide : true,
            defaultDate : '<?=$mydate?>',
        });
    });

          function ajaxDone(da){
              var formData  = $('#myForm').serialize();
            $.ajax({
                type: "POST",
                url: "ajaxGetInsertedScores.php",
                async: true,
                data:  {'date' : da, 'mng_id' : '<?=$_SESSION["mng_id"]?>'},
                success: function(data,status){
                let o = JSON.parse(data);
                //console.log(o);
                var content = "";
                for( var i=0;i<o.length; i++){
                  //console.log(o);
                  content += '<tr class="d-flex">';
                  content += '<td class="col-2">' + o[i][0].deal + '</td>';
                  content += '<td class="col-2">' + o[i][0].tel + '</td>';
                  for(var j=0; j<o[i].length; j++){
                    content += '<td class="col">' + o[i][j].score + '</td>';
                  }
                  var newid = o[i][0].score_uid + '-' + o[i][0].row_number;
                  content += '<td id="' + newid + '" class="del" ><i class="fas fa-trash pink"></i></td>';
                  content += '</tr>';

                    if(typeof(o) == 'object'){
                    }
                }
                $('.ajaxtable').html(content);
                if(typeof(o) == 'string'){
                   }

                }
            });
        }
        function ajaxDelete(id){
          $.ajax({
              type: "POST",
              url: "ajaxDeleteScores.php",
              async: true,
              data: {
              'id': id,
              'date': '<?=$mydate?>',
              'mng_id': '<?=$_SESSION['mng_id']?>'

              },
              success: function(data,status){
                //console.log(data);
            }
        });
      }
      //функция подсчета среднего значения оценки менеджера за выиранный день
      function ajaxScoreDay(ScoreDate){
        $.ajax({
            type: "POST",
            url: "ajaxScoreDay.php",
            async: true,
            data: {
            'date': ScoreDate,
            'mng_id': '<?=$_SESSION['mng_id']?>'

            },
            success: function(data,status){
              //console.log(data);
              let sc = JSON.parse(data);
              $('#ajaxScoreDay1').html(sc[0].calls);
              $('#ajaxScoreDay2').html(sc[0].avg_score);
              //console.log(sc[0].avg_score);
          }
      });
    }

        $("#datetimepicker2").on('change.datetimepicker', function(e){
            var da = e.date.format(e.date._f);
            moment.locale('ru');
            var dat = moment(da, 'L', 'ru').format('LL');
            $('.show-date').html(dat);
            ajaxDone(da);
            ajaxScoreDay(da);

            //ajaxDone(da);
        });
        $('#button-bottom').click(function(){
          var da = '<?=$mydate?>';
          ajaxDone(da);
        });
        $(document).ready(function(){
        $('table').on('click', 'td.del', function(){

          var uid = $(this).attr('id');
          //console.log(uid);
          ajaxDelete(uid);
          $(this).parent().remove();
        });
      });

</script>

</body>
</html>
