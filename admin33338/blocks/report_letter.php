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
                                        <th style="padding:10px;">Машина </th>
                                        <th style="padding:10px;">Звонков </th>
                                        <th style="padding:10px;">Продаж</th>
                                        
                                    </tr>
                                </thead>
                                <tbody style="border: 1px solid #ccc;">
HTML;
$total = 0;
$count = 0;
foreach($data_array as $key=>$cart){
    if($cart[0] == "" && $cart[1] == ""){
        continue;
    }
$message .= <<<HTML
<tr style="height:60px; border: 1px solid #ccc; background-color: #f1f1f1;">
                                        <td style="padding-left:20px;">{$key}</td>
                                        <td align="center">{$cart[0]} </td>
                                        <td align="center">
                                            <div class="form-group">
                                                <span>{$cart[1]}</span>
                                            </div>                                          
                                        </td>
                                        
                                    </tr>
HTML;

$total += $cart['1'];
$count += $cart['0'];
}

$message .= <<<HTML

                                    <tr style="height:60px; border: 1px solid #ccc; background-color: #e8e8e8;">
                                        <td  style="padding-left:20px;">Всего<span style="font-weight: bold;"></td>
                                        <td align="center" style="padding-left:20px;"><span style="font-weight: bold;">{$count} </span></td>
                                        <td align="center" ><span style="font-weight: bold;">{$total}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            
            
HTML;
$message .= <<<HTML
                            <h2 style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#2C3E50;">Продажи</h2>
                            <table width="800" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; border-collapse: collapse; color:#2C3E50;">
                                <thead>
                                    <tr style="background-color: #2C3E50; color: #fff;">
                                        <th style="padding:10px;">Менеджер</th>
                                        <th style="padding:10px;">Выручка</th>
                                        <th style="padding:10px;">Прибыль</th>
                                        <th style="padding:10px;">Рентабельность</th>
                                        
                                    </tr>
                                </thead>
                                <tbody style="border: 1px solid #ccc;">
                                <tr style="height:60px; border: 1px solid #ccc; background-color: #e8e8e8;">
                                        <td  style="padding-left:20px;"><span style="font-weight: bold;">{$manager_perfom[0]['val_manager']} </span></td>
                                        <td align="center" style="padding-left:20px;"><span style="font-weight: bold;">{$manager_perfom[0]['val_cost']} </span> руб</td>
                                        <td align="center" ><span style="font-weight: bold;">{$manager_perfom[0]['val_profit']}</span> руб</td>
                                        <td align="center" ><span style="font-weight: bold;">{$manager_perfom[0]['val_rent']}</span> %</td>
                                </tr>
                                </tbody>
                                </table>
                                <h5 style="font-size:25px; color:#2C3E50; margin-left: 50px;">Спасибо за труд!</h5>
HTML;
