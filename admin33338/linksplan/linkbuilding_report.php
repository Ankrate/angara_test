<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin'){
        if($_SESSION['type'] != 'marketolog') {
        header('location: /admin33338/');
        }
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/LinksPlan.php');

$obj = new LinksPlan;
$links = $obj->bought_project();
$links_by_month = $obj->links_by_month();
$links_expared = $obj->links_expired(); // Выбирает все просроченные ссылки из таблицы
$links_expared_chk = $obj->show_expired(); //Если есть просроченные ссылки, то показывает таблицу
//p($links_by_month);
$sum = $obj->links_by_month_sum();
//p($sum);
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Links'],
          <?php foreach ($sum as $w) :?>
                  ['<?=$w['date']?>',  <?=($w['count'])?> ],
                  <?php endforeach; ?> 
        ]);

        var options = {
          title: 'Всего получено ссылок по всем проекам',
          
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>

    
        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Кумулятивный прирост ссылок по всем проектам</div>
                            <div class="panel-body">
                                <div id="curve_chart" style="width: 100%; height: 100%; max-height: 500px"></div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
               <div class="col-md-3">
                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Ссылок получено всего</caption>
                            <thead>
                                <tr>
                                    <th>Проект</th>
                                    <th>Количество</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($links as $link):?>
                                    <tr>
                                    <td><?=$link['projname']?></td>
                                    <td><?=$link['count']?></td>
                                    </tr>
                                <?php endforeach?>
                                
                            </tbody>
                    </table>
               </div>
               <div class="col-md-3">
                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Ссылок получено по месяцам</caption>
                            <thead>
                                <tr>
                                    <th>Проект</th>
                                    <th>Дата</th>
                                    
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($links_by_month as $link_e):?>
                                    <td><?=$link_e['date']?></td>
                                    <td><?=$link_e['count']?></td>
                                </tr>
                                
                                <?php endforeach?>
                                
                            </tbody>
                    </table>
               </div>
               
           </div><!-- row -->
            
       </div><!-- Container -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    </body>
</html>