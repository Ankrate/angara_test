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
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/Weges.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/LinksPlan.php');

$object1 = new Weges;
$calls = $object1->get_all_calls();
$all_calls = $object1->calls_by_car();
$conversion_month = $object1->conversion_month();
$conversion = $object1->conversion();

$cars = $object1->select_all_cars();

$cal_tot = $object1->calls_total();
   

?>

<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
    <script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

    <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Дата', 'Звонков', 'Waterline'],
           <?php foreach ($cal_tot as $ct) :?>
          ['<?=$ct['date']?>',  <?=$ct['calls']?>, 20],
          
          <?php endforeach ?>
          
          
        ]);

        var options = {
          title: 'Суммрное количество звонков',
          //curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('callstot'));

        chart.draw(data, options);
      }
    </script>
    <!-- Pe chart revenue per manager -->
<div class="container-fluid">
    <div class="row"><!-- Big row -->
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Звонки по всем машинам</div>
                            <div class="panel-body">
                                <div id="callstot" style="width: 100%; height: 100%; max-height: 600px"></div>            
                            </div>
                    </div>
                </div>
                
    </div> <!-- Big row end -->
    <?php foreach($cars as $car):?>
        <?php $dat = $object1->calls_grafics($car['id']);?>
     <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Дата', 'Звонков', 'Waterline'],
           <?php foreach ($dat as $c) :?>
          ['<?=$c['date']?>',  <?=$c['calls']?>, 20],
          
          <?php endforeach ?>
          
          
        ]);

        var options = {
          title: '<?=$car["title"]?>',
          //curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('calls<?=$car["id"]?>'));

        chart.draw(data, options);
      }
    </script>
    <div class="row"><!-- Big row -->
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Звонки на <?=$car["title"]?></div>
                            <div class="panel-body">
                                <div id="calls<?=$car['id']?>" style="width: 100%; height: 100%; max-height: 600px"></div>            
                            </div>
                    </div>
                </div>
                
    </div> <!-- Big row end -->
    <?php endforeach ?>
    <div class="row">
        <div class="col-md-6 hidden-xs">
            <div class="table-responsive">
            <table class="table table-bordered adm-level">
                <caption class="text-left">Конверсия за текущий месяц</caption>
                <thead>
                    <tr>
                        <th>Машина</th>
                        <th>Звонков</th>
                        <th>Продаж</th>
                        <th>Конверсия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($conversion_month as $convm):?>
                    <tr>
                        <td><?=$convm['title']?></td>
                        <td><?=$convm['calls']?></td>
                        <td><?=$convm['sales']?></td>
                        <td><?=$convm['conversion']?></td>
                    </tr>
                   <?php endforeach ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="col-md-6 hidden-xs">
            <div class="table-responsive">
            <table class="table table-bordered adm-level">
                <caption class="text-left">Конверсия c 1 апреля 2016</caption>
                <thead>
                    <tr>
                        <th>Машина</th>
                        <th>Звонков</th>
                        <th>Продаж</th>
                        <th>Конверсия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($conversion as $conv):?>
                    
                    <tr>
                        <td><?=$conv['title']?></td>
                        <td><?=$conv['calls']?></td>
                        <td><?=$conv['sales']?></td>
                        <td><?=$conv['conversion']?></td>
                        
                    </tr>
                   <?php endforeach ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 hidden-xs">
            <div class="table-responsive">
                <?php foreach($calls as $ca):?>
                    <div class="col-md-3">
            <table class="table table-bordered adm-level">
                <caption class="text-left">Конверсия <?=$ca['username']?></caption>
                <thead>
                    <tr>
                        <th>Машина</th>
                        <th>Звонков</th>
                        <th>Продаж</th>
                        <th>Конверсия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ca['calls'] as $cal):?>
                    <tr>
                        <td><?=$cal['title']?></td>                        
                        <td><?=$cal['calls']?></td>
                        <td><?=$cal['sales']?></td>
                        <td><?=round($cal['sales']/$cal['calls'],2)?></td>
                    </tr>
                   <?php endforeach ?>
                </tbody>
            </table>
            </div>
           <?php endforeach ?> 
            </div>
        </div>
    </div>
</div>
</body>
</html>





