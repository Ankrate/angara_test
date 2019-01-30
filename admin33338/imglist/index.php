<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lock.php');
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include_once ($_SERVER['DOCUMENT_ROOT'] . '/init.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/lib/admmodel.php');
$object = new Admmodel();
if(isset($_GET['carid'])) {
    $carin = adm_car($_GET['carid']);
@$dat = $object->get_img_list($carin[0]['engname'], $_GET['sub']);
}
//$dat = $object->img();

//p($_POST);

if (isset($_GET['carid'])) {
    $carid =  $_GET['carid'];
    $carshow = adm_car($carid);

}
else{
    $carid = 9;
    $carshow[0]['fullname'] =  " Выбери машину";
}
$cars = left_side_car();
$sub = get_yandex_subcategory();
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
        <div class="admin_header">ANGARA Co.LTD., from 2001 year.</div>
    
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <h1>Фото которых нет</h1>
            <form method="get" action="" class="form-art">
                <div class='carshow'>Ты сейчас в категории &nbsp;&nbsp<span><?=$carshow[0]['fullname']?></span></div>
                    <label for="exampleInputEmail1">Выбрать машину</label>
                    <select name="carid" id="carid" class="form-control" onchange="this.form.submit()">
                    <!-- <option  value="<?=$carid?>" >Выбор машины</option> -->
                    <?php foreach($cars as $carchoise):?>
                    <option  value="<?=$carchoise['id']?>" ><?=$carchoise['fullname']?></option>
                <?php endforeach?>
                </select>
                <label for="exampleInputEmail1">Выбрать категорию (оставь пустым для выбора всего списка)</label>
                    <select name="sub" id="sub" class="form-control">
                    <option  value="nh" >Выбор категории</option>
                    <?php foreach($sub as $item):?>
                    <option  value="<?=$item['id']?>" ><?=$item['ang_subcat']?></option>
                <?php endforeach?>
                <input type="submit" class="btn btn-default" value="выбрать">
            </select>
            </form>
                
        </div>              
        <div class="col-md-8">
            <div><h1>Машина <?=$carshow[0]['fullname']?></h1></div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Машина</th>
                        <th>Название</th>
                        <th>Каталож номер</th>
                        <th>ID</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php if(isset($dat)) :?> 
                <?php foreach ($dat as $value) :?>
                <tr>
                    <td><?=strtoupper($carin[0]['engname'])?></td>
                    <td><?=$value['ang_name']?></td>
                    <td><?=$value['cat']?></td>
                    <td><?=$value['1c_id']?></td>
                </tr>
                <?php endforeach ?>
                <?php endif ?>
                </tbody>
            </table>
        </div>             
    </div>
</div>
</body>
<script type="text/javascript">
  document.getElementById('carid').value = "<?php echo $_GET['carid'];?>";
  document.getElementById('sub').value = "<?php echo $_GET['sub'];?>";
</script>
</html>