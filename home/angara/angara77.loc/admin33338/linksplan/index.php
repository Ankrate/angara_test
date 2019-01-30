<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if(!isset($_SESSION['name']) OR $_SESSION['type'] != 'admin') {
    if($_SESSION['type'] != 'marketolog'){
        header('location: /admin33338/');
    }
}
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');

include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/MyDb.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/LinksPlan.php');

$obj = new LinksPlan;
$links = $obj->links();
$links_expared = $obj->links_expired(); // Выбирает все просроченные ссылки из таблицы
$links_expared_chk = $obj->show_expired(); //Если есть просроченные ссылки, то показывает таблицу
if(isset($_GET['id']) ){
 $obj->data = $_GET;
       //p($_GET);
        if($obj->checked()){
header('Location:/admin33338/linksplan/');
        }
}

?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
    
        <!-- Pe chart revenue per manager -->
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                       <table class="table table-bordered adm-level">
                            <caption class="text-left">Ссылки в работу</caption>
                            <thead>
                                <tr>
                                    <th>Проект</th>
                                    <th>Дата</th>
                                    <th>Ключ</th>
                                    <th>Анкор</th>
                                    <th>URL страницы</th>
                                    <th>URL обзора</th>
                                    <th>Посещаемость сайта</th>
                                    <th>Платно/Бесплатно</th>
                                    <th>Стоимость ссылки</th>
                                    <th>Статус</th>
                                    <th>Сохранить</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($links as $link):?>
                                    <?php if($link['url_review'] == '') {$done = 'Не сделано';} else{$done = 'Сделано';}?>
                                    <?php if($done == 'Сделано'){$class = 'green';} else{$class = '';}?>
                                    <?php if($link['chargeble'] == 'Платно') {$charge = 'Бесплатно';} else{$charge = 'Платно';}?>
                                    <form id="f1" method="get" action="">
                                <tr class="<?=$class?>">
                                    <td><?=$link['projname']?></td>
                                    <td><?=$link['date']?></td>
                                    <td><?=$link['keywords']?></td>
                                    <td><?=$link['ancor']?></td>
                                    <td><?=$link['url']?></td>
                                    <td  class="obzor"><input type="" name="url_review" value="<?=$link['url_review']?>" " class="form-control  input-sm"/></td>
                                    <td  class=""><input type="" name="attendance" value="<?=$link['attendance']?>" " class="form-control report input-sm" /></td>
                                    <td><select name="chargeble" class="form-control report input-sm" >
                                        <option><?=$link['chargeble']?></option>
                                        <option><?=$charge?></option>
                                    </select></td>
                                    <td  class=""><input type="" name="cost" value="<?=$link['cost']?>" " class="form-control report input-sm" /></td>
                                    <td><?=$done?></td>
                                    
                                      <input type="hidden" name="id" value="<?=$link['id']?>"/>
                                   <td><button type="submit" class="btn btn-xs btn-success" ><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Save</button></td>
                                </tr>
                                </form>
                                <?php endforeach?>
                                
                            </tbody>
                    </table>
               </div> 
            </div>
            <?php if($links_expared_chk):?>
            <div class="row">
               <div class="col-md-12">
                       <table class="table table-bordered adm-level red">
                            <caption class="text-left">Ссылки просроченные</caption>
                            <thead>
                                <tr>
                                    <th>Проект</th>
                                    <th>Дата</th>
                                    <th>Ключ</th>
                                    <th>Анкор</th>
                                    <th>URL страницы</th>
                                    <th>URL обзора</th>
                                    <th>Посещаемость сайта</th>
                                    <th>Платно/Бесплатно</th>
                                    <th>Стоимость ссылки</th>
                                    <th>Статус</th>
                                    <th>Сохранить</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($links_expared as $link_e):?>
                                    <?php if($link_e['url_review'] == '') {$done1 = 'Не сделано';} else{$done1 = 'Сделано';}?>
                                    <?php if($done1 == 'Сделано'){$class = 'green';} else{$class = '';}?>
                                    <?php if($link_e['chargeble'] == 'Платно') {$charge1 = 'Бесплатно';} else{$charge1 = 'Платно';}?>
                                    <form id="f1" method="get" action="">
                                <tr>
                                    <td><?=$link_e['projname']?></td>
                                    <td><?=$link_e['date']?></td>
                                    <td><?=$link_e['keywords']?></td>
                                    <td><?=$link_e['ancor']?></td>
                                    <td><?=$link_e['url']?></td>
                                    <td class="obzor"><input type="" name="url_review" value="<?=$link_e['url_review']?>" /></td>
                                    <td  class=""><input type="" name="attendance" value="<?=$link_e['attendance']?>" " class="form-control report input-sm" /></td>
                                    <td><select name="chargeble" class="form-control report input-sm" >
                                        <option><?=$link_e['chargeble']?></option>
                                        <option><?=$charge1?></option>
                                    </select></td>
                                    <td  class=""><input type="" name="cost" value="<?=$link_e['cost']?>" " class="form-control report input-sm" /></td>
                                    <td><?=$done1?></td>
                                      <input type="hidden" name="id" value="<?=$link_e['id']?>"/>
                                   <td><button type="submit" class="btn btn-xs btn-success" ><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Save</button></td>
                                </tr>
                                </form>
                                <?php endforeach?>
                                
                            </tbody>
                    </table>
               </div> 
            </div>
            <?php endif?>
            
            
            
    </body>
</html>