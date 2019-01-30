<?php
session_start();
//error_reporting(E_ALL); 
//ini_set("display_errors", 1);
include ($_SERVER['DOCUMENT_ROOT'].'/include/header1.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/core.php');
if (isset($_GET['cat_number'])) {$cat_number = htmlspecialchars($_GET['cat_number']);}
if (isset($_GET['id'])) {$id = htmlspecialchars($_GET['id']);}
if (isset($_SESSION['carname'])) {$carname = $_SESSION['carname'];}else{
    $carname = 1;
}
$cat_number = '8611043001';
$goods = get_goods(2156);
 
   
$subcats = get_subcat_name($goods[0]['parent']);
$cats = get_sub_name($subcats[0]['parent']);
$cars = get_car_name($carname);
$data5 = get_cheap_goods($cat_number, $goods[0]['price']);
//p($goods);
//p($subcats);
//p($cars);
//p($_SESSION['carname']);
$urc[1] = $carname;
$similar = get_similar_goods($cars[0]['engname'],$goods[0]['ang_name']);
//p($similar);

$url = $_SERVER['REQUEST_URI'];

$u = ('/porter-' . good_cat($goods[0]['cat']) . '-' . $goods[0]['1c_id']  . '/');
//echo $u;
//echo '<br>';
//echo $url;
if($url != $u){
    // die("<script>location.href = '/404.php'</script>");
} 
?>
    <title>Корзина ✰  интернет магазина Ангара ☎ <?=TELEPHONE1?></title>
    <meta name="description" content="Корзина angara77 ☎ <?=TELEPHONE1?> ">
    <meta name="keywords" content="<?=($goods[0]['ang_name'])?>, на <?=$cars[0]['fullname']?>">
    <meta name="robots" content="noindex">
<?php include ($_SERVER['DOCUMENT_ROOT'].'/include/header2.php');?>
            <!-- Header -->
            <?php //include 'include/header3.php';?>
            <!-- /Header -->
            <!-- Begin Body -->
            
<div class="container">
    <div class="no-gutter row">
        
            <!-- left side column -->
            <div class="hidden-xs hidden-sm">
            <?php include ($_SERVER['DOCUMENT_ROOT'].'/include/lefttd.php');?>
            </div>
            <!--/end left column-->
               
            <!--mid column-->
            
            <!-- right content column-->
            <div class="col-md-9" id="content">
                
                <div class="panel">
                <div class="panel-heading" style="background-color:#111;color:#fff;">Запчасти на <?=@$cars[0]['title']?></div>   
                <div class="panel-body">
                  <div class="row ">
                  <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                 <a href="<?=ANG_HTTP?>/" itemprop="url"><span itemprop="title">Главная</span></a>
                            </li>
                            
                             <li  class="active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                                  <a  itemprop="url" ></a><span itemprop="title">
Корзина</span>
                             </li>
                        </ul>
                    </div>
               </div> 
                   <!--  Start tests -->
                    <div class="row min-height-600">
                        <div class="col-md-12">
                            <!-- page-title start -->
                            <!-- ================ -->
                            <h1 class="page-title margin-top-clear">Корзина</h1>
                            <!-- page-title end -->
                            <div class="space"></div>
                            <table class="table cart table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Запчасть </th>
                                        <th>Цена </th>
                                        <th>Количество</th>
                                        <th>Удалить </th>
                                        <th class="amount">Всего </th>
                                    </tr>
                                </thead>
                                <tbody class="show-cart">
                                    
                                    <tr>
                                        <td class="product"><a href="shop-product.html">Android 4.4 Smartphone</a> <small>4.7" Dual Core 1GB</small></td>
                                        <td class="price">$99.50 </td>
                                        <td class="quantity">2</td>
                                        <td class="remove"><a class="btn btn-remove btn-default">Remove</a></td>
                                        <td class="amount">$199.00 </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="total-quantity pull-right"  colspan="4">Всего <span class="count-cart"></span> наименований</div>
                                </div>
                            </div>    
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="total-amount pull-right">На сумму <span class="total-cart"></span> рублей</div>
                                    </div>
                            </div>
                            <div class="text-right order-buttons">    
                                <a href="#" class="btn btn-group btn-primary btn-sm clear-cart">Очистить корзину</a>
                                <!-- <a href="shop-checkout.html" class="btn btn-group btn-primary btn-sm">Отправить заказ</a> -->
                            </div>
                            <fieldset>
                                <legend>Заполните форму</legend>
                                <form role="form" class="form-horizontal" id="billing-information" method="post" action="">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <h3 class="title">Покупатель</h3>
                                        </div>
                                        <div class="col-lg-7 col-lg-offset-1">
                                            <div class="form-group">
                                                <label for="billingFirstName" class="col-md-2 control-label">Имя<small class="text-default">*</small></label>
                                                <div class="col-md-10">
                                                    <input name="imya" id="imya" type="text" class="form-control" id="billingFirstName" placeholder="Ваше имя" name="imya">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="billingTel" class="col-md-2 control-label">Телефон<small class="text-default">*</small></label>
                                                <div class="col-md-10">
                                                    <input name="phone" id="phone" type="text" class="form-control" id="billingTel" placeholder="Телефон">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="billingemail" class="col-md-2 control-label">Email<small class="text-default">*</small></label>
                                                <div class="col-md-10">
                                                    <input name="email" id="email" type="email" class="form-control" id="billingemail" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space"></div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <h3 class="title">Дополнительная информация</h3>
                                        </div>
                                        <div class="col-lg-7 col-lg-offset-1">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <textarea name="text" id="text" class="form-control" rows="4" placeholder="Адрес доставки и другие сообщения"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right order-buttons show-button">
                                        <a class="policy" href="../policy.php/">Отправляя заказ, я соглашаюсь с политикой конфиденциальности</a>
                                        <input class="btn btn-group btn-primary btn-sm" id="send-cart" type="button"  name="load" value="Отправить заказ" />
                                    </div>
                                </form>
                            </fieldset>
                   <div class="id-cart"></div>
                   
                   <!-- <div class="results">Ждем ответа</div> -->
                        </div>
                    </div>
                  </div><!--/panel-body-->
                </div><!--/panel-->
                <!--/end right column-->
        </div> 
    </div>
</div><!-- Ends body -->
<?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer_small.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footerjq.php';?>
 <?php include $_SERVER['DOCUMENT_ROOT'] .'/include/footer3.php';?>
        <script>
         function validateEmail($email) {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                return emailReg.test( $email );
            }
                //console.log(email);
                
                $("#send-cart").click(function(event){
                    event.preventDefault();
                        var form = [];
                        var imya = $('#imya').val();
                        var telefon = $('#phone').val();
                        var email = $('#email').val();
                        var text = $('#text').val();
                        var form = [imya, telefon, email, text];
                        
                        if( !validateEmail(email) || email =="" ) {
                            alert("Введите корректный email "+ email);
                            return;
                            }
                            if( !telefon || telefon =="" ) {
                            alert("Введите телефон "+ telefon);
                            return;
                            }
                         
                            
                  
                    //console.log(form);
                    $.post('thank.php', { jsonData: load, data: form}, function(data){
                        $('.results').html(data);
                        
                        
                        
                        if(data == true && load !=''){
                        alert("Заказ отправлен. Проверьте папку СПАМ. Спасибо за покупку!");
                        var output = "<div class='text-right order-buttons'><a href='http://angara77.com/' class='btn btn-group btn-primary btn-sm'> Вертуться на сайт</a></div>";
                        $(".show-button").html(output);
                        }else{
                            alert("Корзина напрочь пуста. Нечего отправлять  ☠ ");
                            return;
                        }
                        url = "/";
                        //$(location).attr("href", url);
                 });          
                     });  
                       
                   </script>
 