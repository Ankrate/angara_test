<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
//echo $_SESSION['type'];
if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin') {
    header('location: /admin33338/');
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/WegesPlan.php');
//require __DIR__ . '/../../config.php';



$object = new WegesPlan;
//$object->val = $all[0]['total_profit'];
@$wages = $object->get_all();
$da = $object->get_bonus_value('2017-03', 2, 'plan2', 16.4);
//p($da);
//var_dump($wages);
?>

<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
            <script type="text/javascript" src="/admin33338/slider/js/bootstrap-slider.js"></script>
    
  </head>
  <body>
    <!-- Pe chart revenue per manager -->
<div class="container-fluid">
    
    
    <div class="row">
        <div class="col-md-12">
            
            <div id="" class="red">В зарплате не учитывается демотивация при невыполнении плана мене 40%. Нужно считать вручную!</div>
            
            <?php foreach(@$wages as $key=> $w) : ?>
                
                <div class="table-responsive">
                <table class="table table-bordered adm-level">
                   <caption class="text-left"><?=$key?></caption>
                    <thead>
                        <tr>
                            
                            <th>Месяц</th>
                            <th>Прибыль общая</th>
                            <th>Прибыль личная</th>
                            <th>Прибыль личная портер</th>
                            <th>Прибыль личная не портер</th>
                            <th>Рентабельность</th>
                            <th>Выполнено портер %</th>
                            <th>Выполнено не портер %</th>
                            <th>Мотив Портер</th>
                            <th>Мотив не Портер</th>
                            <th>Оклад</th>
                            <th>ЗП</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if($w == FALSE) { continue;}?>
                        <?php foreach($w as $w2) : ?>
                             
                        <tr>
                            
                            <td><?=date('Y-M',strtotime($w2['date']))?></td>
                            <td><?=number_format($w2['total_all'])?> руб</td>
                            <td><?=number_format($w2['profit'])?> руб</td>
                            <td><?=number_format($w2['porter'])?> руб</td>
                            <td><?=number_format($w2['no_porter'])?> руб</td>
                            <td><?=$w2['rent']?>%</td>
                            <td class="<?php if($w2['dolya'] < 0.4 ){ echo 'red';}?>"><?=$w2['dolya']*100?> %</td>
                            <td class="<?php if($w2['dolya2'] < 0.4 ){ echo 'red';}?>"><?=$w2['dolya2']*100?> %</td>
                            <td><?=number_format($w2['bonus_porter'])?></td>
                            <td><?=number_format($w2['bonus_no_porter'])?></td>
                            <td><?=number_format($w2['oklad'])?> руб</td>
                            <td><?=number_format($w2['wage'])?> руб</td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                </div>
                <?php endforeach ?>
            </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            Зарплата рассчитывается следующим образом: Доля участия в прибыли берется из предыдущего месяца. Двигая ползунок, вы меняете сумму общей прибыли компании. От общей прибыли компании зависят проценты начисляемые к окладу. Схема действует для 3 и менее сотрудников.
            <h5>Таблица расчета процентов от прибыли Коэффициэнт продуктвности(КП)</h5>
            <ul>
                <li>менее 950 тыс - <span class="red">6%</span></li>
                <!-- <li>от 850 до 950 тыс - <span class="red">6%</span></li> -->
                <li>от 950 до 1000 млн - <span class="red">7%</span></li>
                <li>от 1 млн до 1 350 тыс - <span class="red">8%</span></li>
                <li>от 1 350 тыс до 1 500 тыс - <span class="red">9%</span></li>
                <li>от 1 500 тыс  до 1700 тыс - <span class="red">11%</span></li>
                <li>от 1 700 тыс - <span class="red">13%</span></li>
            </ul>
            <h5>Формула расчета зарплаты</h5>
            <p>Зарплата = Оклад <span class="red">+</span> Личная прибыль за месяц <span class="red">x</span> КП</p>
            <p>Оклад расчитывается: Если сработали ниже точки безубыточности, то оклад считается 10000 тыс плюс оклад за дополнительную нагрузку.</p>
            <p>Если сработали в плюс, то 10000 тыс плюс оклад за допнагрузку плюс за выслугу лет, плюс бонус от руководителя(на его усмотрение)</p>
            <p>Руководитель дополнительно получает один процент от общей прибыли.</p>
            <div class="row">
            <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-bordered adm-level">
                   <caption class="text-left">Таблица фиксов</caption>
                    <thead>
                        <tr>
                            <th>Менеджер</th>
                            <th>Оклад</th>
                            <th>Доп нагрузка</th>
                            <th>Выслуга лет</th>
                            <th>Бонус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Олеся</td>
                            <td>10000</td>
                            <td>10000</td>
                            <td>8000</td>
                            <td>1%</td>
                        </tr>
                        <tr>
                            <td>Кирилл</td>
                            <td>10000</td>
                            <td>10000</td>
                            <td>5000</td>
                            <td>Бонус от руководителя</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div><!-- Col md 6 -->
            <div class="col-md-6">
                
            </div>
            </div>
            <p>Пример рассчета фиксированной части Кирилл:</p>
                <ol>
                    <li>Ниже точки безубыточности: 10000+10000 = 20000 тыс руб</li>
                    <li>Выше точки безубыточности: 10000+10000+5000+?5000 = 30000 тыс руб</li>
                </ol> 
        </div>
    </div>
    
</div>
</body>
<script>

$(function(){
  $('#ex1').slider({
        formater: function(value) {
          return 'Current value: '+value;
        }
  }).on('slideStop', function(ev){
     var value = $('#ex1').val();
     console.log(value);
     $.ajax({url: "ajax-wage.php",dataType:"json", data:{total:value,id:'2',dolya:<?=$wages['Vostrikova Olesya'][0]['dolya']?>}, success: function(result){
        
                $("#div-dolya").html((result.dolya*100).toFixed(2) + ' ' + '%');
                $("#div1").html(result.wage + ' ' + 'руб');
                $("#div-bonus").html(result.bonus  + ' ' + 'руб');
                $("#div-rate").html((result.rate*100).toFixed(0)  + ' ' + '%');
                $("#div-profit").html(result.profit  + ' ' + 'руб');
    }});
  });
});

$(function(){
  $('#ex2').slider({
        formater: function(value) {
          return 'Current value: '+value;
        }
  }).on('slideStop', function(ev){
     var value = $('#ex2').val();
     console.log(value);
     $.ajax({url: "ajax-wage.php", dataType:"json", data:{total:value,id:'3',dolya:<?=$wages['Bogatyrev Kirill'][0]['dolya']?>}, success: function(result){
                $("#div-dolya2").html((result.dolya*100).toFixed(2) + ' ' + '%');
                $("#div2").html(result.wage + ' ' + 'руб');
                $("#div-bonus2").html(result.bonus  + ' ' + 'руб');
                $("#div-rate2").html((result.rate*100).toFixed(0)  + ' ' + '%');
                $("#div-profit2").html(result.profit  + ' ' + 'руб');
    }});
  });
});

</script>
</html>





