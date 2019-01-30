<?php
ob_start();
session_start();
error_reporting(E_ALL); 
ini_set("display_errors", 1);
include_once ('lock.php');
//print_r($_POST);
include_once($_SERVER['DOCUMENT_ROOT'] ."/lib/core.php");
if(isset($_GET['carid'])) {$carid =  $_GET['carid'];
$data = adm_sub($carid);
}
if (isset($_GET['id'])) {$id =  $_GET['id'];}
else $id = 1;
if (isset($_POST['carid'])) {
    $carid =  $_POST['carid'];
    $data = adm_sub($carid);
}
else{
    //$carid = 1;
}

$text = adm_sub_all($id);
@$carunit = adm_car($carid);
$cars = left_side_car();
$description = @adm_left_side_car($carid);
p($_SESSION);
p($text);
p($carunit);

?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/header.php');?>
        <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/admin33338/blocks/'.$_SESSION['type'] . '.php');?>
        <div class="admin_header"><a href="index.php"><span>ANGARA Co.LTD., from 2001 year.</span></a></div>
    
            <div class="square">
                <div class='domoy'><a href="/admin33338/">В админку</a></div>
                <div class='domoy'><a href="editsub.php">Выбор машины</a></div>
                <div class='domoy'><a href="editsub2.php">Новая</a></div>
                <ol>
               <?php 
               if(isset($data)){
               foreach ($data as $line) {?>
                <li><a href="editsub2.php?id=<?=$line['id']?>&carid=<?=$line['car']?>"> <span class="red"><?=$line['cat_id']?></span>&nbsp;&nbsp<?=$line['title']?></a></li>
                <?php }
                }?> 
                </ol>
            </div>
            
            <?php 
            
            
            if (isset($_POST['description'])) {
               
                $result = adm_sub_update($_POST);
                header("Location: ".$_SERVER['REQUEST_URI']);
                
         }  
                //$text = @adm_sub($_GET['id']);
                //p($text);
                
                ?>
                
    <div class="side_bar">
        <div id="my_editor">
            
            
              
        <form method="post" class="form-art">
            <label for="exampleInputEmail1">Выбрать машину</label>
                    <select  name="carid" id="carid" class="form-control">
                        <?php if(!isset($carid)):?>
                    <?php foreach($cars as $carchoise):?>
                    <option selected="selected"  value="<?=$carchoise['id']?>" ><?=$carchoise['fullname']?></option>
                <?php endforeach?>
                <?php else:?>
                    <option selected="selected"  value="<?=$carunit[0]['id']?>" ><?=$carunit[0]['fullname']?></option>
                    <?php endif ?> 
                
            </select>
            <label for="exampleInputEmail1">Категория ID</label>
            <input class="form-control" name="cat_id"  placeholder="Категория ID" value="<?=@$text[0]['cat_id']?>">
            <label for="exampleInputEmail1">Title</label>
            <input class="form-control" name="title"  placeholder="Заголовок" value="<?=@$text[0]['title']?>">
            <label for="exampleInputEmail1">Description</label>
            <input class="form-control" name="meta_d"  placeholder="Meta description" value="<?=@$text[0]['meta_d']?>">
            <label for="exampleInputEmail1">Keywords</label>
            <input class="form-control" name="meta_k"  placeholder="Meta keywords" value="<?=@$text[0]['meta_k']?>">
            <label for="exampleInputEmail1">H1</label>
            <input class="form-control" name="h1"  placeholder="H1" value="<?=@$text[0]['h1']?>">
            <label for="exampleInputEmail1">Image</label>
            <input class="form-control" name="img"  placeholder="Картинка" value="<?=@$text[0]['img']?>">
            <!-- <label>Машина: 1-Портер, 2-HD, 3-Starex</label>
            <input class="form-control" name="car"  placeholder="Машина 1-Портер, 2-HD, 3-Starex" value="<?=@$text[0]['car']?>"> -->
            
                
            
            
            
            
            
            <!-- <input type="hidden" class="form-control" name="cat_id"  placeholder="Category Id" value="<?=@$_GET['id']?>"> -->
            <input type="hidden"  class="form-control" name="id" value="<?=@$text[0]['id']?>">
            
            <textarea  class="text_area" name="description" id="editor1" rows="10" cols="80">
                
                <?=@$text[0]['description']?>
            </textarea>
            
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
                //config.height = '500px';
                
            </script>
        </form>
            </div>      
            </div>
</body>
</html>

<script type="text/javascript">
  document.getElementById('carid').value = "<?php echo $_SESSION['carid'];?>";
</script>
