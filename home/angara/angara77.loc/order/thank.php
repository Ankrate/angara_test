<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/core.php');
//echo 'Пример 2 - передача завершилась успешно.';
//Параметры: name = ' . $_POST['name'] . ', nickname= ' . $_POST['nickname'];
$a = $_POST['jsonData'];
$d = $_POST['data'];
//p($d);
//echo $a[0]->name;


//p($a);
    
    $to = $d[2];
    //p( $d);
   // echo $to;
    


function send_email($d,$a){
    $to      = strip_tags($d[2] . ', angara99@gmail.com, angara77@gmail.com, truck.angara@gmail.com');
    $name = mb_ucfirst(mb_strtolower($d[0], "UTF-8"));
    $name = preg_replace('#[^\w+\s]#u', '', $name);
    $subject = 'Заказ запчастей в Ангара';
    $phone =  preg_replace('#[^\d+\+]#u', '',$d[1]);
    $text = preg_replace('#[^\d+\w\.\,\-\s]#u', '',$d[3]);
    
    $message = <<<HTML
                            <!-- page-title start -->
                            <!-- ================ -->
                            <h1 style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#2C3E50;">Спасибо {$name} за Ваш заказ!</h1>
                            <h3>Менеджер свяжется с Вами в ближайшее время по телефону {$phone}.</h3>
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

foreach($a as $cart){
$message .= <<<HTML
<tr style="height:60px; border: 1px solid #ccc; background-color: #f1f1f1;">
                                        <td style="padding-left:20px;">{$cart['name']}</td>
                                        <td align="center">{$cart['price']} </td>
                                        <td align="center">
                                            <div class="form-group">
                                                <span>{$cart['count']}</span>
                                            </div>                                          
                                        </td>
                                        <td width="200" align="center">{$cart['total']} </td>
                                    </tr>
HTML;
$total += $cart['total'];
$count += $cart['count'];
}

$message .= <<<HTML

                                    <tr style="height:60px; border: 1px solid #ccc; background-color: #e8e8e8;">
                                        <td style="padding-left:20px;" class="total-quantity" colspan="3">Всего<span style="font-weight: bold;"> {$count} </span>позиций</td>
                                        <td class="total-amount">Сумма:<span style="font-weight: bold;"> {$total} рублей</span></td>
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
                            <h5>Текст сообщения</h5>
                            <div>{$text}</div>
            

            
HTML;
    $headers = "From: Ангара запчасти <noreply@angara77.com>" . "\r\n";
    $headers .= "Reply-To: angara77@gmail.com" . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
   


    if(mail($to, $subject, $message, $headers)){
        return true;
    }
}


if(!empty($a)){
    if(send_email($d,$a)){
       echo true; 
    } else {
        echo "Email has not sent!";
    }
}

