<?php
$message = <<<HTML
                            <!-- page-title start -->
                            <!-- ================ -->
                            <h1 style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#2C3E50;">Спасибо {$obj->manager} за Ваш отчет!</h1>
                            
                            <!-- page-title end -->
                            <h2 style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#2C3E50;">Количество звонков</h2>
                            <table width="800" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; border-collapse: collapse; color:#2C3E50;">
                                <thead>
                                    <tr style="background-color: #2C3E50; color: #fff;">
                                        <th style="padding:10px;">Задача </th>
                                        <th style="padding:10px;">Выполнено </th>
                                    </tr>
                                </thead>
                                <tbody style="border: 1px solid #ccc;">
HTML;
$total = 0;
$count = 0;
foreach($data_array as $key=>$value){
    $score_name = $obj->get_mkt_score_names2($key);
$message .= <<<HTML
<tr style="height:60px; border: 1px solid #ccc; background-color: #f1f1f1;">
                                        <td style="padding-left:20px;">{$score_name[0]['name']}</td>
                                        
                                        <td align="center">
                                            <div class="form-group">
                                                <span>{$value}</span>
                                            </div>                                          
                                        </td>
                                        
                                    </tr>
HTML;


}

$message .= <<<HTML

                                    
                                </tbody>
                            </table>
                            
                            
            
HTML;

