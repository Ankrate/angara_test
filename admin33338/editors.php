<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include_once ('lock.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
$count_car = count_items_car(); //count items in pricelist
$count_subcats = count_subcats();
$count_articles = count_articles();
$count_img = count_img();
//p($count_subcats);
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/LinksPlan.php');

$obj = new LinksPlan;
$links = $obj->show_expired();
foreach($count_car as $k => $a){
    $array = array($a);
    $arrays[$k] = $array;
}
foreach($count_subcats as $key=>$ar){
            
            array_push($arrays[$key] , $ar);
        }

foreach($count_articles as $kei=>$f){
            
            array_push($arrays[$kei] , $f);
        }
foreach($count_img as $kei1=>$f1){
            
            array_push($arrays[$kei1] , $f1);
        }

//p($arrays);

//p($img);
//p($_SESSION);
$graph_data = adm_graph_data();

?>




		
		<script src="/admin33338/cat.angarasolaris.com/js/jquery.validate.js"></script>
		<script src="/admin33338/cat.angarasolaris.com/js/jquery-ui.min.js"></script>
		<script src="/admin33338/cat.angarasolaris.com/js/jquery.imagemapster.js"></script>
		<script src="/admin33338/cat.angarasolaris.com/js/script.js"></script>
		<link rel="stylesheet" href="/admin33338/cat.angarasolaris.com/css/style.css">

    <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
		<!-- <div class="admin_header">ANGARA Co.LTD., from 2001 year.</div> -->
	       <div class="container-fluid">
			
			    <!-- <div class="row adm-butt">
			                            <div class="col-md-12">
			                                 <button type="button" class="btn btn-primary btn-xs"><a href="editsub.php">Текст подкатегорий</a></button>
			                                    <button type="button" class="btn btn-danger btn-xs"><a href="editor.php">Статьи</a></button>
			                                    <li><button type="button" class="btn btn-info btn-xs"><a href="cat.angarasolaris.com/">Работа с каталогом</a></button></li>
			                                    <button type="button" class="btn btn-danger btn-xs"><a href="/admin33338/linkbuilding/">Перелинковать</a></button>
			                                    <button type="button" class="btn btn-success btn-xs"><a href="/admin33338/elfinder/elfinder.html">Работа с картинками</a></button>
			                                    <li><button type="button" class="btn btn-primary btn-xs"><a href="editor_spec.php">Акции</a></button></li>
			                                    <li><button type="button" class="btn btn-warning btn-xs"><a href="editor_news.php">Новости</a></button></li>
			                                    <li><a href="/admin33338/insert/">Вставить прайс</a></li>
			                            </div>
			                        </div> -->
			    <?php if($_SESSION['type'] == 'marketolog' AND  $links == TRUE):?>                    
				<div class="row">
				    <div class="col-md-2">
				       <a href="/admin33338/linksplan/"><div class="alert alert-danger blink_me" role="alert">Паника! Просроченные ссылки! <i class="fa fa-ambulance" aria-hidden="true"></i></div></a> 
				    </div>
				</div>
				<?php endif?>
				<div class="row">
    				    
    				   <div class="col-md-10">
    				       <div class="row">
                               <div class="col-md-6">
                                   <div class="panel panel-primary">
                                      <div class="panel-heading">График развития текстов</div>
                                      <div class="panel-body">
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
                                              ['Year', 'Категории'],
                                              <?php foreach($graph_data as $gd):?>
                                              
                                              ['<?=$gd['chart_date']?>', <?=$gd['subcats']?> ],
                                              
                                              <?php endforeach ?>
                                            ]);
                                    
                                            var options = {
                                              title: 'Company Texts',
                                              //curveType: 'function',
                                              colors: ['#2c3e50', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
                                              legend: { position: 'bottom' }
                                            };
                                    
                                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                                    
                                            chart.draw(data, options);
                                          }
                                        </script>
                                     
                                     
                                        <div id="curve_chart" style="width: 100%; height: 200px"></div>

                                        </div>
                                    </div>
                               </div>
                           
                               <div class="col-md-6">
                                   <div class="panel panel-primary">
                                      <div class="panel-heading">График фото</div>
                                      <div class="panel-body">
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
                                              ['Year', 'Фото'],
                                              <?php foreach($graph_data as $gd):?>
                                              
                                              ['<?=$gd['chart_date']?>',  <?=$gd['photos']?>],
                                              
                                              <?php endforeach ?>
                                            ]);
                                    
                                            var options = {
                                              title: 'Company Photos',
                                              curveType: 'function',
                                              colors: ['#2c87f0'],
                                              legend: { position: 'bottom' }
                                            };
                                    
                                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));
                                    
                                            chart.draw(data, options);
                                          }
                                        </script>
                                        <div id="curve_chart2" style="width: 100%; height: 200px"></div>
                                        </div>
                                    </div>
                               </div>
                           </div>
    				       <div class="row">
    				           <div class="col-md-6">
    				               <table class="table table-bordered adm-table">
                                      <thead>
                                        <tr>
                                          <th width="25%">Машина</th>
                                          <th width="25%">Тексты категорий</th>
                                          <th width="25%">Статьи</th>
                                          <th width="25%">Фото</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          <?php foreach($arrays as $kluch => $data10):?>
                                        <tr>
                                            <?php $mashina = adm_car($kluch);?>
                                          <th scope="row"><?=$mashina[0]['fullname']?></th>
                                          <td><?=$data10[1]?> из 80<div class="progress">
                                              <div class="progress-bar" role="progressbar" aria-valuenow="<?=percent($data10[1],80)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=percent($data10[1],80)?>%;">
                                                <?=percent($data10[1],80)?>%
                                              </div>
                                              </div>
                                          </td>
                                          <td><?=$data10[2]?> из 100<div class="progress">
                                              <div class="progress-bar" role="progressbar" aria-valuenow="<?=percent($data10[2],100)?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=percent($data10[2],100)?>%;">
                                                <?=percent($data10[2],100)?>%
                                              </div>
                                              </div>
                                          </td>
                                          <td><?=$data10[3]?> из <?=$data10[0]?><div class="progress">
                                              <div class="progress-bar" role="progressbar" aria-valuenow="<?=percent($data10[3],$data10[0])?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=percent($data10[3],$data10[0])?>%;">
                                                <?=percent($data10[3],$data10[0])?>%
                                              </div>
                                            </div>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                      </tbody>
                                    </table>
    				           </div><!-- end of col texts table -->
    				           <div class="col-md-4">
    				               <div class="row">
    				               <div class="panel panel-primary">
                                      <div class="panel-heading">График развития статей</div>
                                      <div class="panel-body">
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
                                              ['Year', 'Статьи'],
                                              <?php foreach($graph_data as $gd):?>
                                              
                                              ['<?=$gd['chart_date']?>', <?=$gd['articles']?>],
                                              
                                              <?php endforeach ?>
                                            ]);
                                    
                                            var options = {
                                              title: 'Company Articles',
                                              curveType: 'function',
                                              colors: ['#e6693e'],
                                              legend: { position: 'bottom' }
                                            };
                                    
                                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart_articles'));
                                    
                                            chart.draw(data, options);
                                          }
                                        </script>
                                     
                                     
                                        <div id="curve_chart_articles" style="width: 100%; height: 200px"></div>

                                        </div>
                                    </div>
                                    <div class="panel panel-primary">
                                      <div class="panel-heading">Some future content</div>
                                      <div class="panel-body">
                                        <div id="curve_chart_articles" style="width: 100%; height: 200px">
                                            Some future content
                                        </div>
                                        </div>
                                    </div>
                                </div> <!-- row -->
    				           </div>
    				           <div class="col-md-2">
                                    <table class="table table-sripped sw">
                                        <thead>
                                        <tr>
                                            <th>Популярные</th>
                                            <th>В месяц</th>
                                        </tr>
                                        </thead>
                                        <tbody id="freq">
                                        
                                        </tbody>
                                    </table>
                       </div>
			         </div><!-- row2 -->
			      </div> <!-- md10 -->
			      <div class="col-md-2">
                            <table class="table table-sripped sw">
                                <thead>
                                <tr>
                                    <th>Запросы сейчас</th>
                                    <th>Дата</th>
                                </tr>
                                </thead>
                                <tbody id="queries">
                                
                                </tbody>
                            </table>
                       </div>
			   </div> <!-- 2 row -->
			   
			</div><!-- container -->
</body>
<script>

    setInterval(function() {
       $.ajax({
        type: "POST",
        url: "geo/ajaxsearch.php",
        data: '',
        dataType: "json", // Set the data type so jQuery can parse it for you
        success: function (data) {
            $('#send').html(data);
                var htmlStr = '';
                //var city = '';
                $.each(data, function(k, v){
                htmlStr += '<tr class="query-list"><td>' + v.search_q + '</td>'  + '<td>' + v.query_date  +  '</td></tr>';
             });
   $("#queries").html(htmlStr);
    }
});
     }, 1000 * 60 * 0.1); // where X is your every X minutes
     
     //Second ajax query for frequently queries
     $.ajax({
        type: "POST",
        url: "geo/aj2.php",
        data: '',
        dataType: "json", // Set the data type so jQuery can parse it for you
        success: function (data) {
            $('#freq').html(data);
                var htmlStr = '';
                //var city = '';
                $.each(data, function(k, v){
                htmlStr += '<tr class="query-list"><td>' + v.search_q + '</td>'  + '<td>' + v.count  +  '</td></tr>';
             });
   $("#freq").html(htmlStr);
    }
});
    

</script> 
</html>

