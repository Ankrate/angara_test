<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include_once($_SERVER['DOCUMENT_ROOT'] ."/lib/core.php");
$graph_data = adm_graph_data();

//p($graph_data);









?>
<div class="row">
                               <div class="col-md-12">
                                   <div class="panel panel-primary">
                                      <div class="panel-heading">График развития</div>
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
                                              ['Year', 'Фото', 'Категории', 'Статьи'],
                                              <?php foreach($graph_data as $gd):?>
                                              
                                              ['<?=$gd['chart_date']?>',  <?=$gd['photos']?>, <?=$gd['subcats']?> , <?=$gd['articles']?>],
                                              //['2005',  1170,      460 , 500],
                                              //['2006',  660,       1120, 600],
                                              <?php endforeach ?>
                                            ]);
                                            
                                            var options = {
                                              title: 'Company Development',
                                              curveType: 'function',
                                              legend: { position: 'bottom' }
                                            };
                                    
                                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                                    
                                            chart.draw(data, options);
                                          }
                                        </script>
                                     
                                     
                                        <div id="curve_chart" style="width: 100%; height: 500px"></div>

                                        </div>
                                    </div>
                               </div>
                           </div>