<?php
ob_start();
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include_once ('lock.php');
//print_r($_POST);
include_once($_SERVER['DOCUMENT_ROOT'] ."/lib/core.php");

if (isset($_GET['carid'])) {
    $carid =  $_GET['carid'];
    $carshow = adm_car($carid);

}
else{
    $carid = 9;
    $carshow[0]['fullname'] =  " Выбери машину";
}

$data = adm_data($carid);

$cars = left_side_car();
$description = adm_left_side_car($carid);
if(isset($_GET['id'])){
$text = adm_data_all($_GET['id']);
}
//p($data);
//p($carshow);

?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
        <div class="admin_header">ANGARA Co.LTD., from 2001 year.</div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                <div class='domoy'><a href="/admin33338/">В админку</a></div>
                <div class='domoy'><a href="../">На сайт</a></div>
                <div class='domoy'><a href="editor.php?carid=<?=$carid?>">Новая</a></div>
                <div class='carshow'>Ты сейчас в категории &nbsp;&nbsp<span> <?=@$carshow[0]['fullname']?></span></div>
                <ol>
                <?php foreach ($data as $line) {?>
                    <div class="row">
                    <div class="col-md-10">
                <li><a href="?id=<?=$line['id']?>&carid=<?=$line['car']?>"> <span  class="red"></span>&nbsp;&nbsp<?=$line['title']?></a> </li>
                </div>
                <div class="col-md-2"><a href="delete.php?carid=<?=$carid?>&table=data&id=<?=$line['id']?>&page=editor.php" onclick="return confirmDelete();"><span id="span-trush" data-id="<?=$line['id']?>"  class="red trush"><i class="fa fa-trash"></i></span></a></div>
                </div>
                <?php }?>
                </ol>
            </div>
            
            
             <?php
                if (isset($_POST['description'])) {
                    $result = adm_data_update($_POST);
                    header("Location: ".$_SERVER['REQUEST_URI']);
                }  
                    //$text = @adm_sub($_GET['id']);
                    //p($text);
                
                ?>
            
         
    <div class="col-md-8">
        <div id="my_editor">
        <form method="get" action="" class="form-art">
            <div class='carshow'>Ты сейчас в категории &nbsp;&nbsp<span><?=$carshow[0]['fullname']?></span></div>
            <label for="exampleInputEmail1">Выбрать машину</label>
                    <select name="carid" id="carid" class="form-control" onchange="this.form.submit()">
                    <!-- <option  value="<?=$carid?>" >Выбор машины</option> -->
                    <?php foreach($cars as $carchoise):?>
                    <option  value="<?=$carchoise['id']?>" ><?=$carchoise['fullname']?></option>
                <?php endforeach?>
                <!-- <input type="submit" class="btn btn-default" value="выбрать"> -->
            </select>
            </form>
            
            <form method="post" action="" id="text-form">
            <div id="main-form">
            <label for="exampleInputEmail1">Категория ID</label>
            <!-- <input class="form-control" name="cat_id"  placeholder="Категория ID" value="<?=@$text[0]['cat_id']?>"> -->
            <label for="exampleInputEmail1">Title</label>
            <input class="form-control" name="title"  placeholder="Заголовок" value="<?=@$text[0]['title']?>">
            <label for="exampleInputEmail1">Description</label>
            <input class="form-control" name="meta_d"  placeholder="Meta description" value="<?=@$text[0]['meta_d']?>">
            <label for="exampleInputEmail1">Keywords</label>
            <input class="form-control" name="meta_k"  placeholder="Meta keywords" value="<?=@$text[0]['meta_k']?>">
            <label for="exampleInputEmail1">H1</label>
            <input class="form-control" name="h1"  placeholder="H1" value="<?=@$text[0]['h1']?>">
            <label for="exampleInputEmail1">Image</label>
            <input class="form-control" name="img"  placeholder="Картинка" value="<?=@$text[0]['mini_img']?>">
            <!-- <label>Машина: 1-Портер, 2-HD, 3-Starex</label>
            <input class="form-control" name="car"  placeholder="Машина 1-Портер, 2-HD, 3-Starex" value="<?=@$text[0]['car']?>"> -->
            <!-- <input type="hidden" class="form-control" name="cat_id"  placeholder="Category Id" value="<?=@$_GET['id']?>"> -->
            <input type="hidden"  class="form-control" name="id" value="<?=@$text[0]['id']?>">
            <input type="hidden"  class="form-control" name="car" value="<?=@$carid?>">
            
            <textarea  class="text_area" name="description" id="editor1" rows="10" cols="80">
                
                <?=@$text[0]['text']?>
            </textarea>
            
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
                //config.height = '500px';
                
            </script>
            </div>
        </form>
        
            </div>      
            </div>
    </div>
        </div><!-- container -->
        <script src="ckeditor/ckeditor.js"></script>
</body>
</html>

<script type="text/javascript">
  document.getElementById('carid').value = "<?php echo $_GET['carid'];?>";
</script>
<script>
  
 function confirmDelete() {
    if (confirm("Вы подтверждаете удаление?")) {
        return true;
    } else {
        return false;
    }
}
</script>


