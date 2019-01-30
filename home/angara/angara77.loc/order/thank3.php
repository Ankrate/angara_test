<?php
include ($_SERVER['DOCUMENT_ROOT'].'/include/header1.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/core.php');






 $message = <<<HTML
                            <!-- page-title start -->
                            <!-- ================ -->
                            <h1 style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#2C3E50;">Ваш заказ</h1>
                            <h3 style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#2C3E50;">ООО «Ангара» - запчасти для грузовиков и автобусов</h3>
                            <div style="padding: 0 0 5px 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#2C3E50;">телефон: +7(495)6469953</div>
                            <div style="padding: 10px 0 10px 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#2C3E50;">http://angara77.com</div>
                            <!-- page-title end -->
                            <div class="space"></div>
                            <table width="800" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 16px; border-collapse: collapse; color:#2C3E50;">
                                <thead>
                                    <tr style="background-color: #2C3E50; color: #fff;">
                                        <th style="padding:10px;">Запчасти </th>
                                        <th style="padding:10px;">Цена </th>
                                        <th style="padding:10px;">Количество</th>
                                        <th style="padding:10px;">Сумма </th>
                                    </tr>
                                </thead>
                                <tbody style="border: 1px solid #ccc;">
HTML;


$message .= <<<HTML
<tr style="height:60px; border: 1px solid #ccc; background-color: #f1f1f1;">
                                        <td style="padding-left:20px;"><a href="http://angara77.com">Android 4.4 Smartphone</a> <small>4.7" Dual Core 1GB</small></td>
                                        <td align="center">$99.50 </td>
                                        <td align="center">
                                            <div class="form-group">
                                                <span>3</span>
                                            </div>                                          
                                        </td>
                                        <td align="center">$199.00 </td>
                                    </tr>
HTML;


$message .= <<<HTML

                                    <tr style="height:60px; border: 1px solid #ccc; background-color: #e8e8e8;">
                                        <td style="padding-left:20px;" class="total-quantity" colspan="3">Всего 20 позиций</td>
                                        <td class="total-amount">Сумма:<span style="font-weight: bold;"> 4000 рублей</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div style="font-size:14px; margin-top: 20px; color:#2C3E50;">
                            <div>Общество с ограниченной ответственностью  «Ангара»</div>
                                    <div>ИНН/КПП 7733607590/773301001</div>
                                    <div>ОКПО 80878490</div>
                                    <div>ОКАТО 45283555000</div>
                                    <div>ОГРН 5077746795418</div>
                                    <div>Юридический адрес: 125466, г. Москва, ул. Соколово-Мещерская, д.36</div>
                                    <div>Фактический адрес: 125466, г. Москва, ул. Соловьиная Роща, 8, корпус 2, офис 9</div>
                                    <div>E-mail: angara77@gmail.com</div>
                                    <div>Тел.: (495)646-99-53</div>
                                    <div>Банковские реквизиты:</div>
                                    <div>ОАО «Промсвязьбанк» г. Москва</div>
                                    <div>ИНН/КПП 7744000912/775001001</div>
                                    <div>Адрес банка: 109052, г. Москва, ул. Смирновская, д.10, стр.22</div>
                                    <div>Расчетный счет: 40702810170030424301</div>
                                    <div>к/с 30101810400000000555</div>
                                    <div>БИК 044525555</div>
                            </div>
            

            
HTML;

echo $message;

//include ($_SERVER['DOCUMENT_ROOT'].'/include/footerjq.php');